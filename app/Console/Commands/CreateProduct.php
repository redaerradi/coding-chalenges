<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CategoryRepository;
use App\Product;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create{name}{discription}{price}{image}{categorie}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command can create a new product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $discription = $this->argument('discription');
        $price = $this->argument('price');
        $image = $this->argument('image');
        $categories = $this->argument('categorie');

        if(trim($name) != "" && trim($discription)!= "" && is_numeric($price) && trim($image) && is_numeric($categories)) {
            $cat = $this->category->get($categories);
            if($cat){
                $product = new Product;
                $product->name = $name;
                $product->discription = $discription;
                $product->price = $price;
                $product->image = $image;
                $product->categorie = $categories;
                $product->save();
                echo "product is added with succefuly";
                return;
            }
            else{
                echo "category undefined";
                return;
            }

        }
    }
}
