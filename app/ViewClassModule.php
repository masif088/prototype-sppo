<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $class_module_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property ClassModule $classModule
 * @property User $user
 */
class ViewClassModule extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['class_module_id', 'user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classModule()
    {
        return $this->belongsTo('App\ClassModule');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
