<?php
namespace App\Repositories;
use App\Category;


class CategoryRepository  implements CategoryInterface {

    public function get($id){

        return Category::find($id);

    }

}

