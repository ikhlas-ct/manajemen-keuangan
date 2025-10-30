<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * User boleh akses menu admin?
     */
    public function aksesAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * User boleh akses menu manajer?
     */
    public function aksesManajer(User $user): bool
    {
        return $user->role === 'manajer';
    }

   
}
