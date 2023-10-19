<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Eloquent
 */
class Program extends Model
{
    protected $table = 'programs';
    protected $guarded = ['id'];
    protected $casts = ['department' => Department::class];
}
