<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $age
 * @property string $village
 * @property string $district
 * @property boolean $tkd
 * @property string $created_at
 * @property string $updated_at
 * @property IcAnswer[] $icAnswers
 */
class StudentTalents extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'age', 'village', 'district', 'tkd', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function icAnswers()
    {
        return $this->hasMany('App\IcAnswer', 'student_id');
    }
}
