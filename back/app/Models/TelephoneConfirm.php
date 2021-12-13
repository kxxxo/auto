<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TelephoneConfirm
 *
 * @property integer $id
 * @property string $telephone
 * @property string $code
 * @property int $attempts
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @method static Builder|TelephoneConfirm newModelQuery()
 * @method static Builder|TelephoneConfirm newQuery()
 * @method static Builder|TelephoneConfirm query()
 * @method static Builder|TelephoneConfirm whereAttempts($value)
 * @method static Builder|TelephoneConfirm whereCode($value)
 * @method static Builder|TelephoneConfirm whereCreatedAt($value)
 * @method static Builder|TelephoneConfirm whereDeletedAt($value)
 * @method static Builder|TelephoneConfirm whereId($value)
 * @method static Builder|TelephoneConfirm whereTelephone($value)
 * @method static Builder|TelephoneConfirm whereUpdatedAt($value)
 * @mixin Eloquent
 */
class TelephoneConfirm extends Model
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
    protected $fillable = ['telephone', 'code', 'attempts', 'created_at', 'updated_at', 'deleted_at'];
}
