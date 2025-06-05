<?php
use PHPUnit\Framework\TestCase;
use AcmeWidget\Basket;
use AcmeWidget\ProductCatalogue;
use AcmeWidget\DeliveryFeeRule;
use AcmeWidget\Offer;

class BasketTest extends TestCase
{
    private function basket()
    {
        return new Basket( 
            new ProductCatalogue(), 
            new DeliveryFeeRule(), 
            new Offer()
        );
    }
    public function test_total_under_50()
    {
        $basket =$this->basket();
        $basket->add('B01'); 
        $basket->add('G01');
        
        $this->assertEquals(37.85, $basket->total());
    }

    public function test_total_under_90()
    {
        $basket =$this->basket();
        $basket->add('R01'); 
        $basket->add('G01');
        
        $this->assertEquals(60.85, $basket->total());
    }

    public function test_total_greater_than_90()
    {
        $basket =$this->basket();
        $basket->add('R01'); 
        $basket->add('G01');
        $basket->add('G01');
        $basket->add('G01');

        $this->assertEquals(107.8, $basket->total());
    }

    public function test_RO1_half_price_offer()
    {
        $basket =$this->basket();
        $basket->add('R01'); 
        $basket->add('R01');
        
        $this->assertEquals(54.37, $basket->total());
    }

    public function test_multiple_items()
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
