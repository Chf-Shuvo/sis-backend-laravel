<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Department extends Model
{
    protected $table = 'departments';
    protected $guarded = ['id'];
    protected $casts = ['faculty' => Faculty::class];
}
