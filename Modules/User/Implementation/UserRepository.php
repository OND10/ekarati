<?php

namespace Modules\User\Implementation;

use Modules\User\Contracts\UserRepositoryInterface;
use Modules\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function activate($id)
    {
        $user = $this->getById($id);

        if (!$user) {
            return null;
        }

        $user->is_active = true;
        $user->save();
        return $user;
    }

    public function deactivate($id)
    {
        $user = $this->getById($id);

        if (!$user) {
            return null;
        }

        $user->is_active = false;
        $user->save();
        return $user;
    }

    public function activeNowCount()
    {
        return User::where('is_active', true)->count();
    }

    public function activeLastHourCount()
    {
        return User::where('is_active', true)
            ->where('last_activity', '>=', now()->subHour())
            ->count();
    }
}
