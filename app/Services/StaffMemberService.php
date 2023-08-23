<?php

namespace App\Services;

use App\Enums\RoleName;
use App\Models\Shop;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ShopStaffInvitation;
use Illuminate\Support\Facades\DB;

class StaffMemberService
{
    public function createMember(Shop $shop, array $attributes): User
    {
        $member = DB::transaction(function () use ($attributes, $shop) {
            $user = $shop->staff()->create([
                'name'     => $attributes['name'],
                'email'    => $attributes['email'],
                'password' => '',
            ]);

            $user->roles()->sync(Role::where('name', RoleName::STAFF->value)->first());

            return $user;
        });

        $member->notify(new ShopStaffInvitation($shop->name));

        return $member;
    }

    public function deleteMember(Shop $shop, $staffMemberId): bool
    {
        $member = $shop->staff()->find($staffMemberId);

        if ($member === null) {
            return false;
        }

        $member->roles()->sync([]);
        $member->delete();

        return true;
    }
}
