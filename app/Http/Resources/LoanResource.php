<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'holder' => $this->holder->name,
            'id' => $this->id,
            'uuid' => $this->uuid,
            'total_amount' => $this->total_amount,
            'remaining_amount' => $this->remaining_amount,
            'monthly_installment' => $this->monthly_installment,
            'deadline' => $this->deadline
        ];
    }
}
