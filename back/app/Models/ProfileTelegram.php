<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\Types\Static_;

/**
 * App\Models\ProfileTelegram
 *
 * @property integer $id
 * @property string $external_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $photo_url
 * @property string $created_at
 * @property string $updated_at
 * @property bool $is_enable
 * @property Profile $profile
 * @method static Builder|ProfileTelegram newModelQuery()
 * @method static Builder|ProfileTelegram newQuery()
 * @method static Builder|ProfileTelegram query()
 * @method static Builder|ProfileTelegram whereCreatedAt($value)
 * @method static Builder|ProfileTelegram whereExternalId($value)
 * @method static Builder|ProfileTelegram whereId($value)
 * @method static Builder|ProfileTelegram whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|ProfileTelegram whereFirstName($value)
 * @method static Builder|ProfileTelegram whereLastName($value)
 * @method static Builder|ProfileTelegram wherePhotoUrl($value)
 * @method static Builder|ProfileTelegram whereUsername($value)
 * @method static Builder|ProfileTelegram whereIsEnable($value)
 */
class ProfileTelegram extends Model
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
    protected $fillable = ['external_id', 'created_at', 'updated_at', 'last_name', 'first_name', 'username',
        'photo_url', 'is_enable'];

    /**
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne('App\Models\Profile', 'profile_telegram_id');
    }
}
