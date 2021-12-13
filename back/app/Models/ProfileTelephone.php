<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\ProfileTelephone
 *
 * @property integer $id
 * @property string $external_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $is_enable
 * @property Profile $profile
 * @method static Builder|ProfileTelephone newModelQuery()
 * @method static Builder|ProfileTelephone newQuery()
 * @method static Builder|ProfileTelephone query()
 * @method static Builder|ProfileTelephone whereCreatedAt($value)
 * @method static Builder|ProfileTelephone whereExternalId($value)
 * @method static Builder|ProfileTelephone whereId($value)
 * @method static Builder|ProfileTelephone whereUpdatedAt($value)
 * @method static Builder|ProfileTelephone whereIsEnable($value)
 * @mixin Eloquent
 */
class ProfileTelephone extends Model
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
    protected $fillable = ['external_id', 'created_at', 'updated_at', 'is_enable'];

    /**
     * @return HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne('App\Models\Profile', 'profile_telephone_id');
    }
}
