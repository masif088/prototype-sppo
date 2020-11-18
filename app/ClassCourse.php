<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $class_id
 * @property int $course_id
 * @property string $created_at
 * @property string $updated_at
 * @property ManagerClass $managerClass
 * @property Course $course
 * @property ClassModule[] $classModules
 * @property Mission[] $missions
 * @property TeacherClassCourse[] $teacherClassCourses
 */
class ClassCourse extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['class_id', 'course_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function managerClass()
    {
        return $this->belongsTo('App\ManagerClass', 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classModules()
    {
        return $this->hasMany('App\ClassModule');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function missions()
    {
        return $this->hasMany('App\Mission');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacherClassCourses()
    {
        return $this->hasMany('App\TeacherClassCourse');
    }
}
