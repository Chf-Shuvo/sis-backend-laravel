<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OTP
 *
 * @property int $id
 * @property string $user_type
 * @property int $user_id
 * @property int $otp
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OTP newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OTP newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OTP query()
 * @method static \Illuminate\Database\Eloquent\Builder|OTP whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OTP whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OTP whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OTP whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OTP whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OTP whereUserType($value)
 * @mixin \Eloquent
 */
class OTP extends Model
{
    protected $table = 'otps';
    protected $guarded = ['id'];
    protected $casts = ['otp' => 'integer'];
}
