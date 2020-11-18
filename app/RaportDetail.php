<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $raport_id
 * @property string $title
 * @property int $score
 * @property string $created_at
 * @property string $updated_at
 * @property Raport $raport
 */
class RaportDetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['raport_id', 'title', 'score', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function raport()
    {
        return $this->belongsTo('App\Raport');
    }
}
