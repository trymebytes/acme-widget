<?php
namespace AcmeWidget;

class DeliveryFeeRule {
    /** @var array<int, array{max_total: float, fee: float}> */
    private array $delivery_fee_rules = [
        ['max_total' => 90, 'fee' => 2.95],
        ['max_total' => 50, 'fee' => 4.95],

    ];
    
    /**
     * Apply delivery fee based on total amount.
     *
     * @param float $total The total cost of items in the basket.
     * @return float The total cost including delivery fee.
     */
    public function apply_delivery_fee(float $total): float {
        $rules = $this->delivery_fee_rules;
        // Sort rules by max_total in ascending order
        usort($rules, fn($a, $b) => $a['max_total'] <=> $b['max_total']);

        foreach ($rules as $rule) {
            if ($total < $rule['max_total']) {
                return $total + $rule['fee'];
            }
        }
        return $total;
    }
}