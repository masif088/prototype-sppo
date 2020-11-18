<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $class_course_id
 * @property int $user_id
 * @property ClassCourse $classCourse
 * @property User $user
 */
class TeacherClassCourse extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['class_course_id', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classCourse()
    {
        return $this->belongsTo('App\ClassCourse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
