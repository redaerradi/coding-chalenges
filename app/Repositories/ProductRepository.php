<?php
namespace App\Repositories;

use App\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository  implements ProductInterface {

    public function get($id){

        return Product::find($id);

    }

}

