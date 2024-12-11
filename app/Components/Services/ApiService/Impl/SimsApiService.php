<?php 

namespace App\Components\Services\ApiService\Impl;

use App\Components\Services\ApiService\ISimsApiService; 
use App\Traits\Connector\ClientGuzzle; 
use GuzzleHttp\Client;
use Exception;


class SimsApiService implements ISimsApiService
{ 
    use ClientGuzzle;
  
    private $_base_url;

    public function __construct()
    {  
        $this->_base_url = config("api_service.base_url") . "/api/SIMS/";

        $this->_headers = [ 
            'User-Agent'    =>  'browser/1.0',
        ];

        $this->_client = new Client([
            'headers' => $this->_headers,
            'timeout' => 30
        ]);

        $this->_query = [ 
            'companyKey'    => config("api_service.company_key"),
            'apikey'        => config("api_service.api_key")
        ];
    } 

    // GET api/SIMS/GetStockCodes?companyKey={companyKey}
    public function GetStockCodes() 
    {
        $endpoint = $this->_base_url . "GetStockCodes"; 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
    }

    // GET api/SIMS/GetStockDetail?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    public function GetStockDetail($stock_codes) 
    {
        $endpoint = $this->_base_url . "GetStockDetail";
        $i=0;
        foreach($stock_codes as $code) {
            $this->_query["stockcodes[$i]"] = trim($code);
            $i++; 
        } 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
    }
 
    // GET api/SIMS/GetStockDetailByStyle?style={style}&companyKey={companyKey}
    public function GetStockDetailByStyle($code) 
    {
        $endpoint = $this->_base_url . "GetStockDetailByStyle";

        $this->_query['style'] = $code; 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
    }
 
     // GET api/SIMS/GetStockDetailByReplicationId?replicationId={replicationId}&companyKey={companyKey}
     public function GetStockDetailByReplicationId($replication_id) 
     {
        $endpoint = $this->_base_url . "GetStockDetailByReplicationId";
        
        $this->_query['replicationId'] = $replication_id; 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
     }
 
     // GET api/SIMS/GetStockImages?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
     public function GetStockImages($stock_codes) 
     {
        $endpoint = $this->_base_url . "GetStockImages";
        
        $i=0;
        foreach($stock_codes as $code) {
            $this->_query["stockcodes[$i]"] = trim($code);
            $i++; 
        } 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
     }
 
     // GET api/SIMS/GetStockLocationInfo?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
     public function GetStockLocationInfo($stock_codes) 
     {
        $endpoint = $this->_base_url . "GetStockLocationInfo";
        
        $i=0;
        foreach($stock_codes as $code) {
            $this->_query["stockcodes[$i]"] = trim($code);
            $i++; 
        } 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
     }
 
      // POST api/SIMS/ImportSalesOrder?companyKey={companyKey}
      public function ImportSalesOrder($payload) 
      {
            $endpoint = $this->_base_url . "ImportSalesOrder";

            $endpoint .= "?" . http_build_query($this->_query);

            try {
                return $this->sendRequest( $endpoint, $payload);
            } catch (Exception $e) {
                throw($e);
            } 
      }
 
     // POST api/SIMS/ImportTransactions?companyKey={companyKey}
      public function ImportTransactions($payload) 
      {
            $endpoint = $this->_base_url . "ImportTransactions";

            $endpoint .= "?" . http_build_query($this->_query);

            try {
                return $this->sendRequest( $endpoint, $payload);
            } catch (Exception $e) {
                throw($e);
            } 
      }
 
 
 
     // GET api/SIMS/GetStockCategories?categoryCodes[0]={categoryCodes[0]}&categoryCodes[1]={categoryCodes[1]}&companyKey={companyKey}
     public function GetStockCategories($category_codes = []) 
     {
        $endpoint = $this->_base_url . "GetStockCategories";
        $i=0;
        foreach($category_codes as $code) {
            $this->_query["categoryCodes[$i]"] = trim($code);
            $i++; 
        } 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
     }
  
     // GET api/SIMS/GetStockDetailByBarcode?barcode={barcode}&companyKey={companyKey}
     public function GetStockDetailByBarcode($barcode) 
     {
        $endpoint = $this->_base_url . "GetStockDetailByBarcode";

        $this->_query['barcode'] = $barcode; 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
     }
 
     //  GET api/SIMS/GetStockBarcodes?stockCode={stockCode}&companyKey={companyKey} 	 
     public function GetStockBarcodes($stock_code) 
     {
        $endpoint = $this->_base_url . "GetStockBarcodes"; 
        
        $this->_query['stockCode'] = $stock_code; 

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
     }
 
     // GET api/SIMS/GetLatestReplicId?companyKey={companyKey}
     public function GetLatestReplicId() 
     {
        $endpoint = $this->_base_url . "GetLatestReplicId";   

        try {
            return $this->getRequest( $endpoint, $this->_query);
        } catch (Exception $e) {
            throw($e);
        } 
     }
 
     // GET api/SIMS/GetResourcesByStockCodes?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    //  public function GetResourcesByStockCodes($stock_codes) //not working
    //  {
    //     $endpoint = $this->_base_url . "GetResourcesByStockCodes";
    //     $i=0;
    //     foreach($stock_codes as $code) {
    //         $this->_query["stockCodes[$i]"] = trim($code);
    //         $i++; 
    //     } 

    //     try {
    //         return $this->getRequest( $endpoint, $this->_query);
    //     } catch (Exception $e) {
    //         throw($e);
    //     } 
    //  }

    
}