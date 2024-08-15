<?php

namespace App\Http\Resources;

use app\Http\Helpers\Timestamps;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceiptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => (new Carbon($this->date))->format('F d, Y'),
            'service_charge_rate' => $this->service_charge_rate,
            ...timestampResource($this),
        ];
    }
}
