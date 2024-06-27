<?php

namespace App\Managers;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class UserManager extends BaseManager
{
    protected string $diskName = 'public';

    public function create(array $data)
    {
        $arr = [
            'agency_id' => $data['agency_id'],
            'role' => $data['role'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ];

        if (isset($data['password'])) {
            $arr['password'] = bcrypt($data['password']);
        }

        return User::query()->create($arr);
    }

    public function update(User $user, array $data)
    {
        $arr = [
            'agency_id' => $data['agency_id'] ?? $user->agency_id,
            'role' => $data['role'] ?? $user->role,
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone
        ];

        if (isset($data['password'])) {
            $arr['password'] = bcrypt($data['password']);
        }

        $user->update($arr);

        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

    public function uploadAvatar(User $user, UploadedFile $file): void
    {
        if ($user->hasAvatar() && $this->disk()->exists($user->getRawOriginal('avatar'))) {
            $this->disk()->delete($user->getRawOriginal('avatar'));
        }

        $path = $file->store('users', $this->diskName);

        $user->update(['avatar' => $path]);
    }
}
