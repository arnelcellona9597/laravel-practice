<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Components\Services\Woocommerce\Impl\WCClientService;
use App\Components\Services\Woocommerce\Impl\WCCustomerService;
use App\Components\Services\Woocommerce\Impl\WCOrderService;
use App\Components\Services\Woocommerce\Impl\WCProductAttributeService;
use App\Components\Services\Woocommerce\Impl\WCProductAttributeTermService;
use App\Components\Services\Woocommerce\Impl\WCProductCategoryService;
use App\Components\Services\Woocommerce\Impl\WCProductService;
use App\Components\Services\Woocommerce\Impl\WCProductVariationService;
use App\Components\Services\Woocommerce\IWCClientService;
use App\Components\Services\Woocommerce\IWCCustomerService;
use App\Components\Services\Woocommerce\IWCOrderService;
use App\Components\Services\Woocommerce\IWCProductAttributeService;
use App\Components\Services\Woocommerce\IWCProductAttributeTermService;
use App\Components\Services\Woocommerce\IWCProductCategoryService;
use App\Components\Services\Woocommerce\IWCProductService;
use App\Components\Services\Woocommerce\IWCProductVariationService; 
use App\Components\Services\ApiService\Impl\SimsApiService;
use App\Components\Services\ApiService\ISimsApiService;

use App\Components\Services\Arnel\IArnelService;
use App\Components\Services\Arnel\Impl\ArnelService;
use App\Components\Services\Arnel\IProductService;
use App\Components\Services\Arnel\Impl\ProductService;

use App\Components\Services\WooOrder\IWooOrderService;
use App\Components\Services\WooOrder\Impl\WooOrderService;

use App\Components\Repository\ProductRepository;
use App\Components\Repository\WooOrderRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(IProductService::class, ProductService::class);
        // $this->app->bind(IArnelService::class, ArnelService::class);
    }

    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        $this->app->singleton(IWooOrderService::class, function ($app) {
            return new WooOrderService($app->make(WooOrderRepository::class));
        });

        $this->app->singleton(IArnelService::class, function ($app) {
            return new ArnelService;
        }); 

        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepository::class));
        });
        
        $this->app->singleton(IProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepository::class));
        });

        $this->app->singleton(ISimsApiService::class, function ($app) {
            return new SimsApiService;
        });   

        // SERVICES
        $this->app->singleton(IWCClientService::class, function ($app)
        {
            return new WCClientService;
        });
        
        $this->app->singleton(IWCProductService::class, function ($app)
        {
            return new WCProductService(
                $app->make(IWCClientService::class),
            );
        });

        $this->app->singleton(IWCProductCategoryService::class, function ($app)
        {
            return new WCProductCategoryService(
                $app->make(IWCClientService::class),
            );
        });

        $this->app->singleton(IWCCustomerService::class, function ($app)
        {
            return new WCCustomerService(
                $app->make(IWCClientService::class),
            );
        });

        $this->app->singleton(IWCOrderService::class, function ($app)
        {
            return new WCOrderService(
                $app->make(IWCClientService::class),
            );
        });

        $this->app->singleton(IWCProductAttributeService::class, function ($app)
        {
            return new WCProductAttributeService(
                $app->make(IWCClientService::class),
            );
        });

        $this->app->singleton(IWCProductAttributeTermService::class, function ($app)
        {
            return new WCProductAttributeTermService(
                $app->make(IWCClientService::class),
            );
        });
        
        $this->app->singleton(IWCProductVariationService::class, function ($app)
        {
            return new WCProductVariationService(
                $app->make(IWCClientService::class),
            );
        });

    }
}
