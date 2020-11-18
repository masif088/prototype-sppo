<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $level
 * @property string $year
 * @property boolean $status
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property ClassCourse[] $classCourses
 * @property StudentInfo[] $studentInfos
 */
class ManagerClass extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'year', 'status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classCourses()
    {
        return $this->hasMany('App\ClassCourse', 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentInfos()
    {
        return $this->hasMany('App\StudentInfo', 'class_id');
    }

    public function raports()
    {
        return $this->hasMany('App\Raport');
    }
}
