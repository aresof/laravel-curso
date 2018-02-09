<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App
 * @property integer id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string name
 * @property string address
 * @property string nif
 * @property string phone1
 * @property string phone2
 * @property string mobile
 * @property string fax
 * @property boolean is_company
 * @property integer iva
 * @mixin \Eloquent
 */

class Client extends Model
{
    public function setPhone1Attribute($value)
    {
        $this->attributes['phone1'] = trim(str_replace('+34','',
            str_replace('-', '',
            str_replace(' ','',$value))));
    }

    public function setPhone2Attribute($value)
    {
        $this->attributes['phone2'] = trim(str_replace('+34','',
            str_replace('-', '',
                str_replace(' ','',$value))));
    }
}
