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
 * @property boolean $tkd_2
 * @property boolean $tkd_3
 * @property boolean $tkd_4
 * @property string $created_at
 * @property string $updated_at
 * @property IcAnswer[] $icAnswers
 */
class StudentTalent extends Model
{
    protected $table='student_talents';
    /**
     * @var array
     */
    protected $fillable = ['name', 'age', 'village', 'district', 'tkd', 'tkd_2', 'tkd_3', 'tkd_4', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function icAnswers()
    {
        return $this->hasMany('App\IcAnswer', 'student_id');
    }
}
