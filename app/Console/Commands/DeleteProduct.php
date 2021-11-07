<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ProductRepository;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command can delete product';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->product = $product;
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('id');
        $product = $this->product->get($id);
        if ($product) {
            $product->delete();
            echo "product deleted with succefuly";
        } else {
            echo "product undefined";
            return;
        }
    }
}
