<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\CategoryRepository;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command can delete category';

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
        $id = $this->argument('id');
        $category = $this->category->get($id);
        if ($category) {
            $category->delete();
            echo "category deleted with succefuly";
        } else {
            echo "category undefined";
            return;
        }
    }
}
