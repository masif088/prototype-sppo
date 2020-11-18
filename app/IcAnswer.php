<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $student_id
 * @property int $ic_id
 * @property int $answer
 * @property string $created_at
 * @property string $updated_at
 * @property StudentTalent $studentTalent
 * @property IcQuest $icQuest
 */
class IcAnswer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['student_id', 'ic_id', 'answer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function studentTalent()
    {
        return $this->belongsTo('App\StudentTalent', 'student_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function icQuest()
    {
        return $this->belongsTo('App\IcQuest', 'ic_id');
    }
}
