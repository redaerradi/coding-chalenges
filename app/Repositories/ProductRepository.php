<?php
namespace App\Repositories;

use App\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository  implements ProductInterface {

    public function get($id){

        return Product::find($id);

    }

    public function all($data){

        return Product::where(function ($query) use ($data) {
            if ($data->categories_search) {
                $query->where('categorie', $data->categories_search );
            }

        })->orderBy("price",$data->sortPrice??"asc")
        ->orderBy("name",$data->sortName??"asc")
        ->get();

    }
    public function store(array $data){

        return Product::create($data);

    }
    public function update($id , array $data){

        return Product::find($id)->update($data);

    }
    public function delete($id){
        return Product::destroy($id);

    }

    public function uploadImage($id){

        $file = request()->file('image');
        if($file->isValid()){
            $destinationPath = 'productImage/';
            $image = $id . '_' . request()->get('name') . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath,$image);
             DB::table('products')->where('id', $id)->update(['image' => $image]);
        }
    }

}

