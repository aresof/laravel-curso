<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * @package App
 * @property int id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property int client_id
 * @property boolean paid
 * @property Carbon date_paid
 * @property enum mode
 * @property float base
 * @property float tax
 * @property float ret
 * @property float total
 */

class Invoice extends Model
{
    public function invoice_lines()
    {
        return $this->hasMany('App\InvoiceLine');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }


}
