<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class RoutineNames
 * @package App\Models
 * @mixin Builder
 */
class RoutineNames extends Model
{
    protected $table = 'RoutineNames';


    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];



}