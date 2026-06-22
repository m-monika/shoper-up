<?php

declare(strict_types=1);

namespace App\Task28;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Task28\ShippingMethod;
use App\Task28\Order;

class Courier extends ShippingMethod 

{
    public function __construct (int $baseCost) {

        parent::__construct($baseCost);
    }
    
    public function calculateCost(Order $order): int 
    {
        $orderWeight = $order->getWeight();
        $overflow = $orderWeight - 10000;
        
        if($overflow > 0) {
            $overflow = $orderWeight - 10000;
            $overflow = $overflow / 1000;
            $overflow = ceil($overflow);
            $cost = $overflow * 500 + $this->baseCost;
            return (int) $cost;
        } else {
            return $this->baseCost;
        }
    }
}
