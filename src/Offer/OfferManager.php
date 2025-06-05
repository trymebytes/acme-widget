<?php
namespace AcmeWidget\Offer;

class OfferManager {
    /** @var OfferInterface[] */
    private array $offers = [];

    public function __construct(array $offers = []) {
        $this->offers = $offers;
    }

    public function apply_offers(float $total, array $basket_items): float {
        foreach ($this->offers as $offer) {
            $total = $offer->apply($total, $basket_items);
        }
        return $total;
    }
}
