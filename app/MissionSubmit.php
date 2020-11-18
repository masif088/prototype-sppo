<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $mission_detail_id
 * @property int $user_id
 * @property int $number
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 * @property MissionDetail $missionDetail
 * @property User $user
 */
class MissionSubmit extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['mission_detail_id', 'user_id', 'number', 'answer', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function missionDetail()
    {
        return $this->belongsTo('App\MissionDetail');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
