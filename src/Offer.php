<?php
namespace AcmeWidget;

use AcmeWidget\ProductCatalogue;

class Offer {
    private float $total;
    private ProductCatalogue $product_catalogue;
    public function __construct() {
        $this->product_catalogue = new ProductCatalogue();
    }

    public function apply_offer(float $total, array $basket_items): float {
        $this->total = $total;

        // Buy 2 Red Widgets, get second at half price
        if (isset($basket_items['R01']) && $basket_items['R01'] >= 2) {
            $product = $this->product_catalogue->getProduct('R01');
            $this->total -= ($product['price'] / 2);
        }
        return $this->total;
    }
}