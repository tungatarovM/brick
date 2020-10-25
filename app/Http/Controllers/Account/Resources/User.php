<?php

namespace App\Http\Controllers\Account\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'organizationId' => $this->organization->getId(),
            'organizationName' => $this->organization->getName(),
            'role' => $this->getRole(),
            'avatar' => asset($this->profile->getAvatar()),
            'shift' => $this->profile->getShift(),
            'breaks' => $this->profile->getBreaks(),
        ];
    }
}
