<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

use App\Components\Services\ApiService\ISimsApiService;  

class SimsController extends BaseController {

	private $_sims_api_service;

	public function __construct(  ISimsApiService $sims_api_service ) 
	{     
        $this->_sims_api_service = $sims_api_service;  
    }  

	public function GetStockCodes() 
	{
		return $this->_sims_api_service->GetStockCodes();
	}

 	public function GetStockDetail(Request $request)
	{
		$stock_codes = $request->stock_codes ?? [];
		return $this->_sims_api_service->GetStockDetail($stock_codes);
	}

    // GET api/SIMS/GetStockDetailByStyle?style={style}&companyKey={companyKey}
    public function GetStockDetailByStyle(Request $request)
	{
		$code = $request->code ?? null;
		return $this->_sims_api_service->GetStockDetailByStyle($code);
	}

    // GET api/SIMS/GetStockDetailByReplicationId?replicationId={replicationId}&companyKey={companyKey}
    public function GetStockDetailByReplicationId(Request $request) 
	{
		$replication_id = $request->replication_id ?? null;
		return $this->_sims_api_service->GetStockDetailByReplicationId($replication_id);
	}
    // GET api/SIMS/GetStockImages?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    public function GetStockImages(Request $request) 
	{
		$stock_codes = $request->stock_codes ?? [];
		return $this->_sims_api_service->GetStockImages($stock_codes);
	}

    // GET api/SIMS/GetStockLocationInfo?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    public function GetStockLocationInfo(Request $request) 
	{
		$stock_codes = $request->stock_codes ?? [];
		return $this->_sims_api_service->GetStockLocationInfo($stock_codes);
	}

     // POST api/SIMS/ImportSalesOrder?companyKey={companyKey}
     public function ImportSalesOrder(Request $request) 
	 {
		$payload = $request->payload ?? null;
		return $this->_sims_api_service->ImportSalesOrder($payload);
	 }

     // POST api/SIMS/ImportTransactions?companyKey={companyKey}
     public function ImportTransactions(Request $request) 
	 {
		$payload = $request->payload ?? null;
		return $this->_sims_api_service->ImportTransactions($payload);
	 }
 
 
    // GET api/SIMS/GetStockCategories?categoryCodes[0]={categoryCodes[0]}&categoryCodes[1]={categoryCodes[1]}&companyKey={companyKey}
    public function GetStockCategories(Request $request) 
	{
		$category_codes = $request->category_codes ?? [];
		return $this->_sims_api_service->GetStockCategories($category_codes);
	}
 
    // GET api/SIMS/GetStockDetailByBarcode?barcode={barcode}&companyKey={companyKey}
    public function GetStockDetailByBarcode(Request $request) 
	{
		$barcode = $request->barcode ?? null;
		return $this->_sims_api_service->GetStockDetailByBarcode($barcode);
	}

    // GET api/SIMS/GetStockBarcodes?
    public function GetStockBarcodes(Request $request) 
	{
		$code = $request->code ?? null;
		return $this->_sims_api_service->GetStockBarcodes($code);
	}

    // GET api/SIMS/GetLatestReplicId?companyKey={companyKey}
    public function GetLatestReplicId()
	{
		return $this->_sims_api_service->GetLatestReplicId();
	}
}