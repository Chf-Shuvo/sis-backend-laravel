<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 */
class Session extends Model
{
    protected $table = 'sessions';
    protected $guarded = ['id'];
    protected $casts = ['from' => 'date', 'to' => 'date'];
}
