<?php
namespace App\Repositories;

interface ProductInterface {
    public function get($id);
    public function all($data);
    public function store(array $data);
    public function update($id , array $data);
    public function delete($id);
    public function uploadImage($id);



}
