<?php
namespace AcmeWidget;

use AcmeWidget\ProductCatalogue;
use AcmeWidget\DeliveryFeeRule;
use AcmeWidget\Offer\OfferManager;
use Exception;

class Basket {
    /** @var array<string, int> Map of product codes to quantities */
    private array $basket_items = [];
    private ProductCatalogue $product_catalogue;
    private DeliveryFeeRule $delivery_rule;
    private OfferManager $offer_manager;

    public function __construct(
        ProductCatalogue $product_catalogue,
        DeliveryFeeRule $delivery_rule,
        OfferManager $offer_manager
        ) {
        $this->product_catalogue = $product_catalogue;
        $this->delivery_rule = $delivery_rule;
        $this->offer_manager = $offer_manager;
    }

    /**
     * Add a product to the basket.
     *
     * @param string $product_code The product code to add.
     * @throws Exception If the product is not found in the catalogue.
     */
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

    /**
     * Get the total cost of the items in the basket, including any applicable offers and delivery fees.
     *
     * @return float The total cost of the basket.
     */
    public function total(): float {
        $sub_total = 0;
        foreach($this->basket_items as $product_code => $quantity) {
            $product = $this->product_catalogue->getProduct($product_code);
            if ($product) {
                $sub_total += $product['price'] * $quantity;
            }
        }
        $after_offer = $this->offer_manager->apply_offers($sub_total, $this->basket_items);
        $total = $this->delivery_rule->apply_delivery_fee($after_offer);

        return floor($total * 100) / 100;
    }
    
}