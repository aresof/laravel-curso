<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property int product_id
 * @property text description
 * @property int quantity
 * @property int note_id
 */

class NoteLine extends Model
{
    public function note()
    {
        return $this->belongsTo('App\Note');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}