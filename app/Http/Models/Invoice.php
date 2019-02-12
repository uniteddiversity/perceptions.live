<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $table = 'invoices';

    protected $hidden = [];

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'type', 'invoice_element', 'amount', 'status'];
}
