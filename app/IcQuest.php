<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $a
 * @property string $b
 * @property string $c
 * @property string $d
 * @property int $v_a
 * @property int $v_b
 * @property int $v_c
 * @property int $v_d
 * @property string $created_at
 * @property string $updated_at
 * @property IcAnswer[] $icAnswers
 */
class IcQuest extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['a', 'b', 'c', 'd', 'v_a', 'v_b', 'v_c', 'v_d', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function icAnswers()
    {
        return $this->hasMany('App\IcAnswer', 'ic_id');
    }
}
