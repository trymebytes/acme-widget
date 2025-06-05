<?php
namespace AcmeWidget\Offer;
interface OfferInterface {
    /**
     * Apply the offer to calculate a new total
     *
     * @param float $current_total The current total before applying this offer
     * @param array<string, int> $basket_items Map of product codes to quantities
     * @return float The new total after applying this offer
    */
    public function apply(float $current_total, array $basket_items): float;
}
