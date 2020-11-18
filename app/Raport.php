<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $class_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property ManagerClass $managerClass
 * @property RaportDetail[] $raportDetails
 */
class Raport extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['class_id', 'user_id', 'created_at', 'updated_at'];

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
    public function managerClass()
    {
        return $this->belongsTo('App\ManagerClass', 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function raportDetails()
    {
        return $this->hasMany('App\RaportDetail');
    }
}
