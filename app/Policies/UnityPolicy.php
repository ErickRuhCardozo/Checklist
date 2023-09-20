<?php

namespace App\Policies;

use App\Models\Unity;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Auth\Access\Response;

class UnityPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Unity $unity): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $unity->id === $user->unity_id)
            return true;

        return false;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::ADMIN;
    }

    public function update(User $user, Unity $unity): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $unity->id === $user->unity_id)
            return true;

        return false;
    }

    public function delete(User $user, Unity $unity): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $unity->id === $user->unity_id)
            return true;

        return false;

    }

    public function restore(User $user, Unity $unity): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $unity->id === $user->unity_id)
            return true;

        return false;

    }

    public function forceDelete(User $user, Unity $unity): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $unity->id === $user->unity_id)
            return true;

        return false;
    }
}
