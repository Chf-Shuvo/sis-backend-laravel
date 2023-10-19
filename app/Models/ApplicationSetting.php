<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $admission_session
 * @property int active_session
 * @property int previous_session
 * @property int teacher_evaluation_session
 * @mixin Eloquent
 */
class ApplicationSetting extends Model
{
    protected $table = 'application_settings';
    protected $guarded = ['id'];
    protected $casts = ['inauguration_date' => "date:Y-m-d", 'admission_session' => 'integer', 'active_session' => 'integer', 'previous_session' => 'integer', 'teacher_evaluation_session' => 'integer'];
    protected $appends = ['admission_session_title', 'active_session_title', 'previous_session_title', 'teacher_evaluation_session_title'];

    public function getAdmissionSessionTitleAttribute()
    {
        return Session::find($this->admission_session)->title;
    }

    public function getActiveSessionTitleAttribute()
    {
        return Session::find($this->active_session)->title;
    }

    public function getPreviousSessionTitleAttribute()
    {
        return Session::find($this->previous_session)->title;
    }

    public function getTeacherEvaluationSessionTitleAttribute()
    {
        return Session::find($this->teacher_evaluation_session)->title;
    }
}
