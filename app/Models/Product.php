<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public $primaryKey = "id_product";
    protected $guarded  = ['id_product'];
    // protected $fillable  = ['nama_product','harga_product','berat_product','stok','foto'];

    static function getProduct()
    {
       $data = DB::table('products')
        ->join('categories', 'products.id_category', '=', 'categories.id_category');
        return $data;
    }

}
