<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $quest
 * @property int $number
 * @property string $created_at
 * @property string $updated_at
 */
class TkdQuest extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['quest', 'number', 'created_at', 'updated_at'];

}
