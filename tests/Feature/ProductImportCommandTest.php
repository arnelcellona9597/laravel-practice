<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductImportCommandTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * @test
     */
    public function test_correct_product_import(): void
    {
        $this->artisan('woocommerce:product-import')
        ->assertExitCode(0);

    }

    //  /**
    //  * @test
    //  */
    // public function test_wrong_product_import(): void
    // {
    //     $this->artisan('woocommerce:product-import')
    //     ->assertExitCode(1); 
    // }
}
