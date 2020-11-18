<?php

namespace App;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property boolean $role
 * @property string $remember_token
 * @property string $email_verified_at
 * @property string $created_at
 * @property string $updated_at
 * @property Class[] $classes
 * @property MissionSubmit[] $missionSubmits
 * @property StudentInfo[] $studentInfos
 * @property TeacherClassCourse[] $teacherClassCourses
 * @property TeacherInfo[] $teacherInfos
 * @property ViewClassModule[] $viewClassModules
 */

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'created_at', 'updated_at'];

    public function getNextId()
    {
        $statement = DB::select("show table status like 'users'");
        return $statement[0]->Auto_increment;
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes()
    {
        return $this->hasMany('App\ManagerClass');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function missionSubmits()
    {
        return $this->hasMany('App\MissionSubmit');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentInfos()
    {
        return $this->hasMany('App\StudentInfo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacherClassCourses()
    {
        return $this->hasMany('App\TeacherClassCourse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacherInfos()
    {
        return $this->hasMany('App\TeacherInfo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function viewClassModules()
    {
        return $this->hasMany('App\ViewClassModule');
    }
    public function raports()
    {
        return $this->hasMany('App\Raport');
    }
}
