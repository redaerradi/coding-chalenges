<?php
namespace App\Repositories;
use App\Category;


class CategoryRepository  implements CategoryInterface {

    public function get($id){

        return Category::find($id);

    }
    public function all(){

        return Category::get();

    }
    public function store(array $data){

        return Category::create($data);

    }
    public function update($id , array $data){

        return Category::find($id)->update($data);

    }
    public function delete($id){
        return Category::destroy($id);

    }

}

