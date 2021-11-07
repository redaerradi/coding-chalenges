<?php

namespace App\Console\Commands;

use App\Category;

use Illuminate\Console\Command;
use App\Repositories\CategoryRepository;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create{name}{parent?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command can create a new category';

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
        $parent = $this->argument('parent');

        if (trim($name) != "") {
            // verif is parent exists
            if($parent){
                 $cat = $this->category->get($parent);

                if ($cat) {
                    $cat_id = $cat->id;
                }else{
                    echo "category undefined";
                    return;
                }
            }else{
                $cat_id = null;

            }
            // add new category (name,parent)
            $category = new Category;
            $category->name = $name;
            $category->categorie = $cat_id;
            $category->save();
            //                       -if category added give it a message(echo "category added succesfuly";return;)
            echo "category added succesfuly";
            return;
        }
        echo ("your parameters isn't correct");
    }
}
