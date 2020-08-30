<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'invoice' => $this->invoice_number,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'user' => $this->user,
            'book' => $this->books,
            'status' => $this->status
        ];
    }

    public function with($request)
    {
        return ['status'=>'success'];
    }
}
