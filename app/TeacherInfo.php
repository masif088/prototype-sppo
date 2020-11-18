<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $nip
 * @property string $birth_place
 * @property string $birth_date
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class TeacherInfo extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'nip', 'birth_place', 'birth_date', 'address', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
