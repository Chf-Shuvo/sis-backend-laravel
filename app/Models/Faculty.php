<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Faculty extends Model
{
    protected $table = 'faculties';
    protected $guarded = ['id'];
}
