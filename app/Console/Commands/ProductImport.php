<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log; 


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

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::debug("xxxxx");
    }
}
