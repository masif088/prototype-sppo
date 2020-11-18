<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $parent_id
 * @property int $class_id
 * @property string $full_name
 * @property string $nis
 * @property string $nisn
 * @property string $birth_place
 * @property string $birth_date
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property ManagerClass $managerClass
 * @property User $parent
 */
class StudentInfo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'parent_id', 'class_id', 'full_name', 'nis', 'nisn', 'birth_place', 'birth_date', 'address', 'created_at', 'updated_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\User', 'parent_id');
    }
}
