<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $short_description
 * @property string $contents
 * @property string $watermark
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property ClassModule[] $classModules
 */
class Module extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'short_description', 'contents', 'watermark', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classModules()
    {
        return $this->hasMany('App\ClassModule');
    }
}
