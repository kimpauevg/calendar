<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserRoutines
 * @package App\Models
 * @mixin Builder
 */
class UserRoutines extends Model
{
    protected $table = 'UserRoutines';

    public $timestamps = false;

    protected $fillable = [
        'routine_ids', 'routines_time','date'
    ];
}