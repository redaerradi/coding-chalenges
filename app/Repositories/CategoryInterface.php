<?php
namespace App\Repositories;

interface CategoryInterface {
    public function get($id);
    public function all();
    public function store(array $data);
    public function update($id , array $data);
    public function delete($id);


}
