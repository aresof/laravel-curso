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
 * @property int total
 * @property float price
 * @property int invoice_id
 */
class InvoiceLine extends Model
{
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
