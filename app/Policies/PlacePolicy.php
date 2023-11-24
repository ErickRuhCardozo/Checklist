<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Auth\Access\Response;

class PlacePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->type === UserType::ADMIN || $user->type === UserType::COORDINATOR;
    }

    public function view(User $user, Place $place): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $place->unity_id === $user->unity_id)
            return true;

        return false;
    }

    public function create(User $user): bool
    {
        return $user->type === UserType::ADMIN || $user->type === UserType::COORDINATOR;
    }

    public function update(User $user, Place $place): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $place->unity_id === $user->unity_id)
            return true;

        return false;
    }

    public function delete(User $user, Place $place): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $place->unity_id === $user->unity_id)
            return true;

        return false;
    }

    public function restore(User $user, Place $place): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $place->unity_id === $user->unity_id)
            return true;

        return false;
    }

    public function forceDelete(User $user, Place $place): bool
    {
        if ($user->type === UserType::ADMIN)
            return true;
        else if ($user->type === UserType::COORDINATOR && $place->unity_id === $user->unity_id)
            return true;

        return false;
    }

    public function batchCreate(User $user)
    {
        return $user->type === UserType::ADMIN || $user->type === UserType::COORDINATOR;
    }
}
