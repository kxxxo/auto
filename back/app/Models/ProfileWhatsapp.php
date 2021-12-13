<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\ProfileWhatsapp
 *
 * @property integer $id
 * @property string $external_id
 * @property string $created_at
 * @property string $updated_at
 * @property bool $is_enable
 * @property Profile $profile
 * @method static Builder|ProfileWhatsapp newModelQuery()
 * @method static Builder|ProfileWhatsapp newQuery()
 * @method static Builder|ProfileWhatsapp query()
 * @method static Builder|ProfileWhatsapp whereCreatedAt($value)
 * @method static Builder|ProfileWhatsapp whereExternalId($value)
 * @method static Builder|ProfileWhatsapp whereId($value)
 * @method static Builder|ProfileWhatsapp whereUpdatedAt($value)
 * @method static Builder|ProfileWhatsapp whereIsEnable($value)
 * @mixin Eloquent
 */
class ProfileWhatsapp extends Model
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
        return $this->hasOne('App\Models\Profile', 'profile_whatsapp_id');
    }
}
