<?php
namespace AcmeWidget\Offer;

use AcmeWidget\ProductCatalogue;
use AcmeWidget\Offer\OfferInterface;


/**
 * This class implements an offer where if two Red Widgets are purchased,
 * the second one is at half price.
 */
class BuyRedGetSecondHalfPriceOffer implements OfferInterface
{
    private ProductCatalogue $product_catalogue;

    public function __construct(ProductCatalogue $product_catalogue)
    {
        $this->product_catalogue = $product_catalogue;
    }

    public function apply(float $total, array $basket_items): float
    {
        if (isset($basket_items['R01']) && $basket_items['R01'] >= 2) {
            $product = $this->product_catalogue->getProduct('R01');
            if($product) {
                $total -= ($product['price'] / 2);
            }
        }
        return $total;
       
    }
}