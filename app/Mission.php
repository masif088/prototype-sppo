<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $class_course_id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $created_at
 * @property string $updated_at
 * @property ClassCourse $classCourse
 * @property MissionDetail[] $missionDetails
 */
class Mission extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['class_course_id', 'title', 'start', 'end', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classCourse()
    {
        return $this->belongsTo('App\ClassCourse');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function missionDetails()
    {
        return $this->hasMany('App\MissionDetail');
    }
}
