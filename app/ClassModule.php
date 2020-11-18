<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $class_course_id
 * @property int $module_id
 * @property string $created_at
 * @property string $updated_at
 * @property ClassCourse $classCourse
 * @property Module $module
 * @property ViewClassModule[] $viewClassModules
 */
class ClassModule extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['class_course_id', 'module_id', 'created_at', 'updated_at'];

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
    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function viewClassModules()
    {
        return $this->hasMany('App\ViewClassModule');
    }
}
