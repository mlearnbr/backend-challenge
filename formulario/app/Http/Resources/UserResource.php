<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'msisdn' => $this->msisdn,
            'access_level' => $this->access_level,
            'name' => $this->name,
            'external_id' => $this->external_id,
            'password' => $this->password,
            'mlearn_id' => $this->mlearn_id
        ];
    }
}
