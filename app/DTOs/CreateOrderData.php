<?php

namespace App\DTOs;

class CreateOrderData
{
    public function __construct(
        public int $amount,
        public string $currency = 'INR',
        public ?string $receipt = null,
        public array $notes = []
    ) {}
}