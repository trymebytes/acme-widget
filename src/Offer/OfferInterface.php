<?php
namespace AcmeWidget\Offer;

interface OfferInterface {
    public function apply(float $current_total, array $basket_items): float;
}
