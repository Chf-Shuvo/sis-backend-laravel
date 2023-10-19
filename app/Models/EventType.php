<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent
 */
class EventType extends Model
{
    protected $table = 'event_types';
    protected $guarded = ['id'];
}
