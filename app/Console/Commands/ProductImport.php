<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log; 
use App\Components\Services\Woocommerce\IWCProductService;
use App\Models\Product;


class ProductImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'woocommerce:product-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will import products from woocommerce.';

    private $_wc_product_service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( 
        IWCProductService $wc_product_service 
    ) 
    {
        parent::__construct(); 
        $this->_wc_product_service = $wc_product_service;  
    }
    /**
     * Execute the console command.
     */
    public function handle()
    { 
        $max_page = 1;
        $page=1;

        do { 
            $wc_batch_products = $this->_wc_product_service->getProducts(["page" => $page, "per_page"=> 100]);

            foreach($wc_batch_products as $product) { 
                Product::create([
                    'sku' => $product->sku,
                    'name' => $product->name,
                    'quantity' => $product->stock_quantity,
                    'price' => $product->price
                ]);
            } 
            
            if($page==1) {
                $max_page = $this->_wc_product_service->getMaxPage();
                Utilities::message("Maxpage: ".$max_page);
            }
            if($page==$max_page) 
                Utilities::message("last page: ".$page);

            ++$page;
            
        } while($page <= $max_page); 
    }
}
