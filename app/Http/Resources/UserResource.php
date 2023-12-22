<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\RankResource;

use App\Models\Company;
use App\Models\Rank;

use App\Http\Resources\CompanyResource;
use App\Http\Resources\SecurityLevelResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $entry = date('d.m.Y', strtotime($this->entry));
        return [
            'id' => $this->id,
            'type' => 'Beamter',
            'identification' => $this->identification,
            'isActive' => $this->isActive,
            'restrictionClass' => $this->restrictionClass,
            'email' => $this->email,
            'name' => $this->name,
            //'password' => $this->password,
            'entry' => $entry,
            'discord' => $this->discord,
            'rank_id' => $this->rank_id,
            'rank' => new RankResource($this->rank),
            'department' => $this->department,
            'permissions' => [
                'permission_register' => $this->permission_register == 1 ? true : false,
                'permission_creator' => $this->permission_creator == 1 ? true : false,
                'permission_recruiter' => $this->permission_recruiter == 1 ? true : false,
                'permission_broadcaster' => $this->permission_broadcaster == 1 ? true : false,
                'permission_admin' => $this->permission_admin == 1 ? true : false,
                'permission_superadmin' => $this->permission_superadmin == 1 ? true : false,
                'permission_allchat' => $this->permission_allchat == 1 ? true : false,
            ],
            'company' => $this->company_id != null ? new CompanyResource(Company::find($this->company_id)) : null,
        ];
    }
}
