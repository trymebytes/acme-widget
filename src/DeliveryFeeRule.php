<?php
namespace AcmeWidget;

class DeliveryFeeRule {
    public function apply_delivery_fee(float $total): float {
        if ($total < 50) {
            return $total + 4.95;
        } elseif ($total < 90) {
            return $total + 2.95;
        } else {
            return $total;
        }
    }
}