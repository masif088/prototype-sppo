<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $mission_id
 * @property boolean $type
 * @property string $quest
 * @property string $a
 * @property string $b
 * @property string $c
 * @property string $d
 * @property string $e
 * @property int $answer
 * @property string $created_at
 * @property string $updated_at
 * @property Mission $mission
 * @property MissionSubmit[] $missionSubmits
 */
class MissionDetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['mission_id', 'type', 'quest', 'a', 'b', 'c', 'd', 'e', 'answers', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mission()
    {
        return $this->belongsTo('App\Mission');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function missionSubmits()
    {
        return $this->hasMany('App\MissionSubmit');
    }
}
