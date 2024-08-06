<?php

namespace App\Models;

// use Illuminate\Contracts\auth\MustVerifyEmail;
use App\Enums\ApplicationStatusEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPER_ADMIN = 'super.admin';

    const ROLE_ADMIN = 'admin';

    const ROLE_AGENCY = 'agency';

    const ROLE_STUDENT = 'student';

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static array $roles = [
        self::ROLE_SUPER_ADMIN => 'Super Admin',
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_AGENCY => 'Agency',
        self::ROLE_STUDENT => 'Student',
    ];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function getRole(): string
    {
        return self::$roles[$this->role] ?? '';
    }

    public static function getRoles(): Collection
    {
        return collect(self::$roles);
    }

    public function isActive(): bool
    {
        return $this->status === UserStatusEnum::ACTIVE->value;
    }

    /**
     * Super admin, admin ve acenteler icin gecerli
     *
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->isAllAdmin() || $this->isAgency();
    }

    public function haveAlreadyApplication(): bool
    {
        return $this->isStudent() && $this->applications()
                ->where('status', '!=', ApplicationStatusEnum::REJECTED->value)
                ->exists();
    }

    /**
     * Super admin ve adminler icin gecerli
     *
     * @return bool
     */
    public function isAllAdmin(): bool
    {
        return $this->isSuperAdmin() || $this->isAdmin();
    }

    /**
     * Sadece super adminler icin gecerli
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole(self::ROLE_SUPER_ADMIN);
    }

    /**
     * Sadece adminler icin gecerli
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    /**
     * Sadece acenteler icin gecerli
     *
     * @return bool
     */
    public function isAgency(): bool
    {
        return $this->hasRole(self::ROLE_AGENCY);
    }

    /**
     * Sadece ogrenciler icin gecerli
     *
     * @return bool
     */
    public function isStudent(): bool
    {
        return $this->hasRole(self::ROLE_STUDENT);
    }

    public function hasRole($role): bool
    {
        return $this->role == $role;
    }

    public function hasAvatar(): bool
    {
        return ! is_null($this->getRawOriginal('avatar'));
    }

    public function getAvatarAttribute($value): string
    {
        return Storage::disk('public')->url($value);
    }

    public function profileImage(): string
    {
        if (is_null($this->getRawOriginal('avatar'))) {
            return asset('backend/my-image/no-image.svg');
        }

        return $this->avatar;
    }
}
