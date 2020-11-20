<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImportBill extends Model
{
    protected $table = "product_import_bill";
    protected $fillable = [
        'product_id', 'import_bill_id','quantity','price',
    ];
}
