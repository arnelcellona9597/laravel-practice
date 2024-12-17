<?php 

namespace App\Components\Services\ApiService;

interface ISimsApiService
{
    // GET api/SIMS/GetStockCodes?companyKey={companyKey}
    public function GetStockCodes();

    // GET api/SIMS/GetStockDetail?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    public function GetStockDetail($stock_codes);

    // GET api/SIMS/GetStockDetailByStyle?style={style}&companyKey={companyKey}
    public function GetStockDetailByStyle($code);

    // GET api/SIMS/GetStockDetailByReplicationId?replicationId={replicationId}&companyKey={companyKey}
    public function GetStockDetailByReplicationId($replication_id);

    // GET api/SIMS/GetStockImages?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    public function GetStockImages($stock_codes);

    // GET api/SIMS/GetStockLocationInfo?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    public function GetStockLocationInfo($stock_codes);

     // POST api/SIMS/ImportSalesOrder?companyKey={companyKey}
     public function ImportSalesOrder($payload);

     // POST api/SIMS/ImportTransactions?companyKey={companyKey}
     public function ImportTransactions($payload);



    // GET api/SIMS/GetStockCategories?categoryCodes[0]={categoryCodes[0]}&categoryCodes[1]={categoryCodes[1]}&companyKey={companyKey}
    public function GetStockCategories($code = []);
 
    // GET api/SIMS/GetStockDetailByBarcode?barcode={barcode}&companyKey={companyKey}
    public function GetStockDetailByBarcode($code);

    // GET api/SIMS/GetStockBarcodes?
    public function GetStockBarcodes($code);

    // GET api/SIMS/GetLatestReplicId?companyKey={companyKey}
    public function GetLatestReplicId();

    // GET api/SIMS/GetResourcesByStockCodes?stockCodes[0]={stockCodes[0]}&stockCodes[1]={stockCodes[1]}&companyKey={companyKey}
    // public function GetResourcesByStockCodes($stock_codes); //not working 
   
} 
 