<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App
 *
 * @property int id
 * @property string name
 * @property double price
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }
    public function note_lines()
    {
        return $this->hasMany('App\NoteLine');
    }
}
