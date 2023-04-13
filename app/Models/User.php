<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
// Models
use App\Models\Profile;
// Traits
use App\Traits\ModelHelpers;
use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

use function Illuminate\Events\queueable;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use Billable;
    use HasFactory;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;
    use ModelHelpers;
    use HasAuthor;

    const DEFAULT = 1;
    const MODERATOR = 2;
    const WRITER = 3;
    const ADMIN = 4;
    const SUPERADMIN = 5;

    const TABLE = 'users';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'line1',
        'line2',
        'city',
        'state',
        'country',
        'postal_code'
    ];

    protected $with = [
        'subscriptions',
        'profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
                    ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
                    : $this->defaultProfilePhotoUrl();
    }

    // Attributes

    public function id(): int{
        return $this->id;
    }

    public function name(): ?string{
        return $this->name;
    }

    public function emailAddress(): ?string{
        return $this->email;
    }

    public function lineOne(): ?string{
        return $this->line1;
    }

    public function lineTwo(): ?string{
        return $this->line2;
    }

    public function city(): ?string{
        return $this->city;
    }

    public function country(): ?string{
        return $this->country;
    }

    public function state(): ?string{
        return $this->state;
    }

    public function postalCode(): ?string{
        return $this->postal_code;
    }

    // Social
    public function bioProfile()
    {
        return $this->profile->bio();
    }

    public function bioProfileExcerpt($limit = 80)
    {
        return Str::limit($this->bioProfile(), $limit);
    }

    public function facebookProfile()
    {
        return $this->profile->facebook();
    }

    public function twitterProfile()
    {
        return $this->profile->twitter();
    }

    public function instagramProfile()
    {
        return $this->profile->instagram();
    }

    public function linkedinProfile()
    {
        return $this->profile->linkedin();
    }

    // Roles

    public function type(): int{
        return (int) $this->type;
    }

    public function isDefault(): int{
        return $this->type === self::DEFAULT;
    }

    public function isModerator(): bool{
        return $this->type === self::MODERATOR;
    }

    public function isWriter(): bool{
        return $this->type === self::WRITER;
    }

    public function isAdmin(): bool{
        return $this->type === self::ADMIN;
    }

    public function isSuperAdmin(): bool{
        return $this->type === self::SUPERADMIN;
    }

    // Relations

    public function profile(): HasOne{
        return $this->hasOne(Profile::class);
    }

    public function joinedDate(){
        return $this->created_at->format('d/m/y');
    }

    public function posts(){
        return $this->postRelation;
    }

    public function postsRelation(): HasMany{
        return $this->hasMany(Post::class, 'author_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updated(queueable(function ($customer) {
            $customer->syncStripeCustomerDetails();
        }));
    }

    public function stripeAddress()
    {
        return [
            'line1'         => $this->lineOne(),
            'line2'         => $this->lineTwo(),
            'city'          => $this->city(),
            'country'       => $this->country(),
            'postal_code'   => $this->postalCode(),
            'state'         => $this->state(),
        ];
    }
}
