<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * @package App
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon close_date
 * @property Carbon delivery_date
 * @property int user_id
 * @property int client_id
 * @property int invoice_id
 * @property float weight
 * @property float price
 * @property boolean signed
 * @property boolean invoiced
 * @property boolean paid
 */

class Note extends Model
{

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function note_lines()
    {
        return $this->hasMany('App\NoteLine');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
