<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\ProfileMail
 *
 * @property integer $id
 * @property string $external_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $is_enable
 * @property Profile $profile
 * @method static Builder|ProfileMail newModelQuery()
 * @method static Builder|ProfileMail newQuery()
 * @method static Builder|ProfileMail query()
 * @method static Builder|ProfileMail whereCreatedAt($value)
 * @method static Builder|ProfileMail whereExternalId($value)
 * @method static Builder|ProfileMail whereId($value)
 * @method static Builder|ProfileMail whereUpdatedAt($value)
 * @method static Builder|ProfileMail whereIsEnable($value)
 * @mixin Eloquent
 */
class ProfileMail extends Model
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
        return $this->hasOne('App\Models\Profile', 'profile_email_id');
    }
}
