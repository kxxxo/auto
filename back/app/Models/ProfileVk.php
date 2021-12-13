<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\ProfileVk
 *
 * @property integer $id
 * @property string $external_id
 * @property string $access_token
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property bool $is_enable
 * @property Profile $profile
 * @method static Builder|ProfileVk newModelQuery()
 * @method static Builder|ProfileVk newQuery()
 * @method static Builder|ProfileVk query()
 * @method static Builder|ProfileVk whereAccessToken($value)
 * @method static Builder|ProfileVk whereEmail($value)
 * @method static Builder|ProfileVk whereCreatedAt($value)
 * @method static Builder|ProfileVk whereExternalId($value)
 * @method static Builder|ProfileVk whereId($value)
 * @method static Builder|ProfileVk whereUpdatedAt($value)
 * @method static Builder|ProfileVk whereIsEnable($value)
 * @mixin Eloquent
 */
class ProfileVk extends Model
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
    protected $fillable = ['external_id', 'access_token', 'created_at', 'updated_at', 'email', 'is_enable'];

    /**
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne('App\Models\Profile', 'profile_vk_id');
    }
}
