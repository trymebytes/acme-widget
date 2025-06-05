<?php
namespace AcmeWidget\Offer;

class OfferManager {
    /** @var OfferInterface[] */
    private array $offers = [];

    /**
     * @param array<int, OfferInterface> $offers Array of offer objects
     */
    public function __construct(array $offers = []) {
        $this->offers = $offers;
    }

     /**
     * Apply all offers to the basket
     * 
     * @param float $total The current total before applying offers
     * @param array<string, int> $basket_items Map of product codes to quantities
     * @return float The new total after applying all offers
     */
    public function apply_offers(float $total, array $basket_items): float {
        foreach ($this->offers as $offer) {
            $total = $offer->apply($total, $basket_items);
        }
        return $total;
    }
}
