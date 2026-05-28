<?php

declare(strict_types=1);

namespace App\Task5;

class Order
{
    private array $items = [];
    
    public function __construct(private string $number){}

    public function addItem(OrderItem $item): void
    {
    	$this->items[]= $item;
    }

    public function getShippingCost(): int
    {
    	if ($this->calculateItemsTotal() >= 15000){
    		return 0;
    	}else{
    		return 1500;
    	}
        
    }

    public function calculateItemsTotal(): int
    {
    	$itemCost= 0;
        foreach ($this->items as $item){
        	$itemCost += $item->getTotalPrice();
        }
        return $itemCost;
    }

    public function calculateGrandTotal(): int
    {
        return $this->calculateItemsTotal() + $this->getShippingCost();
    }
}

