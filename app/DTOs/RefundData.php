<?php

namespace App\DTOs;

class RefundData
{
    public function __construct(
        public string $paymentId,
        public ?int $amount = null,
        public array $notes = []
    ) {}
}