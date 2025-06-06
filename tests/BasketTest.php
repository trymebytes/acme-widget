<?php
use PHPUnit\Framework\TestCase;
use AcmeWidget\Basket;
use AcmeWidget\ProductCatalogue;
use AcmeWidget\DeliveryFeeRule;
use AcmeWidget\Offer\OfferManager;
use AcmeWidget\Offer\BuyRedGetSecondHalfPriceOffer;


class BasketTest extends TestCase
{
    private function basket(): Basket
    {
        return new Basket( 
            new ProductCatalogue(), 
            new DeliveryFeeRule(), 
            new OfferManager(
                [
                    new BuyRedGetSecondHalfPriceOffer( new ProductCatalogue() ),
                ]
            )
        );
    }
    public function test_total_under_50(): void
    {
        $basket =$this->basket();
        $basket->add('B01'); 
        $basket->add('G01');
        
        $this->assertEquals(37.85, $basket->total());
    }

    public function test_total_under_90(): void
    {
        $basket =$this->basket();
        $basket->add('R01'); 
        $basket->add('G01');
        
        $this->assertEquals(60.85, $basket->total());
    }

    public function test_total_greater_than_90(): void
    {
        $basket =$this->basket();
        $basket->add('R01'); 
        $basket->add('G01');
        $basket->add('G01');
        $basket->add('G01');

        $this->assertEquals(107.8, $basket->total());
    }

    public function test_RO1_half_price_offer(): void
    {
        $basket =$this->basket();
        $basket->add('R01'); 
        $basket->add('R01');
        
        $this->assertEquals(54.37, $basket->total());
    }

    public function test_multiple_items(): void
    {
        $basket =$this->basket();
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        
        $this->assertEquals(98.27, $basket->total());
    }
}
