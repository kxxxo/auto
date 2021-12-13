<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmailCodeConfirm
 *
 * @property integer $id
 * @property string $email
 * @property string $code
 * @property int $attempts
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @method static Builder|EmailConfirm newModelQuery()
 * @method static Builder|EmailConfirm newQuery()
 * @method static Builder|EmailConfirm query()
 * @method static Builder|EmailConfirm whereAttempts($value)
 * @method static Builder|EmailConfirm whereCode($value)
 * @method static Builder|EmailConfirm whereCreatedAt($value)
 * @method static Builder|EmailConfirm whereDeletedAt($value)
 * @method static Builder|EmailConfirm whereEmail($value)
 * @method static Builder|EmailConfirm whereId($value)
 * @method static Builder|EmailConfirm whereUpdatedAt($value)
 * @mixin Eloquent
 */
class EmailConfirm extends Model
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
    protected $fillable = ['email', 'code', 'attempts', 'created_at', 'updated_at', 'deleted_at'];
}
