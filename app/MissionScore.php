<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $mission_id
 * @property int $score
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Mission $mission
 */
class MissionScore extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'mission_id', 'score', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mission()
    {
        return $this->belongsTo('App\Mission');
    }
}
