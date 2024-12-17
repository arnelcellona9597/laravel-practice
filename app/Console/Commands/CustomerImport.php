<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Components\Services\Woocommerce\IWCCustomerService;
use App\Models\Customer;
use App\Components\Passive\Utilities;

class CustomerImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'woocommerce:customer-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will import customers from woocommerce';

    private $_wc_customer_service;

    public function __construct( 
        IWCCustomerService $wc_customer_service 
    ) 
    {
        parent::__construct(); 
        $this->_wc_customer_service = $wc_customer_service;  
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $max_page = 1;
        $page=1;

        do { 
            $wc_batch_customer = $this->_wc_customer_service->getCustomers(["page" => $page, "per_page"=> 100]);

            foreach($wc_batch_customer as $customer) { 
                Customer::updateOrCreate([
                    'customer_id' => $customer->id
                ],[
                    'first_name' => $customer->first_name,
                    'last_name' => $customer->last_name,
                    'email' =>  $customer->email
                ]);
            } 
            
            if($page==1) {
                $max_page = $this->_wc_customer_service->getMaxPage();
                Utilities::message("Maxpage: ".$max_page);
            }
            if($page==$max_page) 
                Utilities::message("last page: ".$page);

            ++$page;
            
        } while($page <= $max_page); 
    }
}
