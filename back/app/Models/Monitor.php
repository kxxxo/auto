<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
/**
 * App\Models\Profile
 *
 * @property integer $id
 * @property float $cpu
 * @property float $free_disk
 * @property float $max_disk
 * @property string $created_at
 * @property string $updated_at
 * @method static Builder|Profile newModelQuery()
 * @method static Builder|Profile newQuery()
 * @method static Builder|Profile query()
 * @method static Builder|Profile whereCreatedAt($value)
 * @method static Builder|Profile whereId($value)
 * @method static Builder|Profile wherePassword($value)
 * @method static Builder|Profile whereUpdatedAt($value)
 * @property-read User $user
 * @mixin Eloquent
 */
class Monitor extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'cpu',
        'free_disk',
        'max_disk'
    ];

}
