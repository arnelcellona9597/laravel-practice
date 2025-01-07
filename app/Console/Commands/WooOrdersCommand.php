<?php 
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Automattic\WooCommerce\Client;
use App\Components\Services\WooOrder\IWooOrderService;

class WooOrdersCommand extends Command
{
    protected $signature = 'woocommerce:sync-orders';  // Define your custom Artisan command
    protected $description = 'Sync orders from WooCommerce to Laravel database';

    private $wooOrderService;

    public function __construct(IWooOrderService $wooOrderService)
    {
        parent::__construct();
        $this->wooOrderService = $wooOrderService;
    }
    
    public function handle()
    {
        $this->info('Starting order sync from WooCommerce...');

        $woocommerce = new Client(
            env('WC_URL'),
            env('WC_CONSUMER_KEY'),
            env('WC_CONSUMER_SECRET'),
            [
                'version' => 'wc/v3',
                'verify_ssl' => false,
            ]
        );

        $orders = $woocommerce->get('orders', ['per_page' => 10]);

        foreach ($orders as $order) {
            $existingOrder = $this->wooOrderService->getOrderByOrderID($order->id);

            if (!$existingOrder) {
                $data = [
                    'order_id' => $order->id,
                    'customer_name' => $order->billing->first_name . ' ' . $order->billing->last_name,
                    'customer_email' => $order->billing->email,
                    'total' => $order->total,
                    'status' => $order->status,
                    'created_at' => $order->date_created,
                    'updated_at' => $order->date_modified,
                ];

                $this->wooOrderService->addOrder($data);
                $this->info('Order ' . $order->id . ' synced successfully.');
            } else {
                $this->info('Order ' . $order->id . ' already exists.');
            }
        }

        $this->info('Order sync complete!');
    }
}
