<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * App\Models\Profile
 *
 * @property integer $id
 * @property int $profile_vk_id
 * @property int $profile_telegram_id
 * @property int $profile_telephone_id
 * @property int $profile_whatsapp_id
 * @property int $profile_email_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $password
 * @property ProfileVk $profileVk
 * @property ProfileTelegram $profileTelegram
 * @property ProfileTelephone $profileTelephone
 * @property ProfileWhatsapp $profileWhatsapp
 * @property ProfileMail $profileMail
 * @method static Builder|Profile newModelQuery()
 * @method static Builder|Profile newQuery()
 * @method static Builder|Profile query()
 * @method static Builder|Profile whereCreatedAt($value)
 * @method static Builder|Profile whereId($value)
 * @method static Builder|Profile whereProfileEmailId($value)
 * @method static Builder|Profile whereProfileTelegramId($value)
 * @method static Builder|Profile whereProfileTelephoneId($value)
 * @method static Builder|Profile whereProfileVkId($value)
 * @method static Builder|Profile wherePassword($value)
 * @method static Builder|Profile whereProfileWhatsappId($value)
 * @method static Builder|Profile whereUpdatedAt($value)
 * @method static Builder|Profile whereUserId($value)
 * @property-read User $user
 * @mixin Eloquent
 */
class Profile extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'profile_vk_id',
        'profile_telegram_id',
        'profile_telephone_id',
        'profile_whatsapp_id',
        'profile_email_id',
        'user_id',
        'created_at',
        'updated_at',
        'password'
    ];

    /**
     * @return HasOne
     */
    public function profileVk(): HasOne
    {
        return $this->hasOne('App\Models\ProfileVk', 'id', 'profile_vk_id');
    }

    /**
     * @return HasOne
     */
    public function profileTelegram(): HasOne
    {
        return $this->hasOne('App\Models\ProfileTelegram', 'id', 'profile_telegram_id');
    }

    /**
     * @return HasOne
     */
    public function profileTelephone(): HasOne
    {
        return $this->hasOne('App\Models\ProfileTelephone', 'id', 'profile_telephone_id');
    }

    /**
     * @return HasOne
     */
    public function profileWhatsapp(): HasOne
    {
        return $this->hasOne('App\Models\ProfileWhatsapp', 'id', 'profile_whatsapp_id');
    }

    /**
     * @return HasOne
     */
    public function profileMail(): HasOne
    {
        return $this->hasOne('App\Models\ProfileMail', 'id', 'profile_email_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('App\Models\User', 'id');
    }
}
