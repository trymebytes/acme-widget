<?php
namespace AcmeWidget;

use AcmeWidget\ProductCatalogue;
use AcmeWidget\DeliveryFeeRule;
use Exception;

class Basket {
    private array $basket_items = [];
    private ProductCatalogue $product_catalogue;
    private DeliveryFeeRule $delivery_rule;
    private Offer $offer;

    public function __construct(
        ProductCatalogue $product_catalogue,
        DeliveryFeeRule $delivery_rule,
        Offer $offer
        ) {
        $this->product_catalogue = $product_catalogue;
        $this->delivery_rule = $delivery_rule;
        $this->offer = $offer;
    }

    public function add( string $product_code): void {
        if (! $this->product_catalogue->getProduct($product_code) ) {
            throw new Exception("Product not found in catalogue.");
        }
        if (isset($this->basket_items[$product_code])) {
            $this->basket_items[$product_code]++;
        } else {
            $this->basket_items[$product_code] = 1;
        }
    }

    public function total(): float {
        $sub_total = 0;
        foreach($this->basket_items as $product_code => $quantity) {
            $product = $this->product_catalogue->getProduct($product_code);
            $sub_total += $product['price'] * $quantity;
        }
        $after_offer = $this->offer->apply_offer($sub_total, $this->basket_items);
        $total = $this->delivery_rule->apply_delivery_fee($after_offer);

        return floor($total * 100) / 100;
    }
    
}