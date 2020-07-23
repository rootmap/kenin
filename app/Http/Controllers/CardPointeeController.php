<?php

namespace App\Http\Controllers;

use App\CardPointee;
use App\CardPointeeProfile;
use App\CardpointeStoreSetting;
use Session;
use DB;
use Illuminate\Http\Request;
class CardPointeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    private function makeRefund($auth_retref=''){

        $storeMerchantSetCount=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->count();
        if($storeMerchantSetCount==0){

            $merchant_id = '496160873888';
            $user        = 'testing';
            $pass        = 'testing123';
            $server      = 'https://fts.cardconnect.com:6443';

        }else{

            $storeMerchantSet=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->first();

            $merchant_id = $storeMerchantSet->merchant_id;
            $user        = $storeMerchantSet->username;
            $pass        = $storeMerchantSet->password;
            $server      = 'https://fts.cardconnect.com:6443';

            //dd($storeMerchantSet);
        }

        
        $client = new CardPointe($merchant_id, $user, $pass, $server);


        $boolean = $client->testAuth();

        if($boolean==true){
            $obj=$this->reFundTrans($client,$auth_retref);
            return $obj;
                        
        }
        else
        {
            return (object)array('status'=>0,'message'=>'Invalid credentials.');
                die();
        }

        //dd($boolean);
    }

    
    
    /* Charge Profile start */
    //CardPointee
    private function cardPointeeChargeProfile($response){
        $invoice_id = time();
        try {

            $profile=CardPointeeProfile::where('profileid',$response->profileid)->where('acctid',$response->acctid)->first();
            $tab=new CardPointee();
            $tab->responseJson=json_encode($response);
            $tab->invoice_id=$invoice_id;
            $tab->card_number=$profile->card_number;
            $tab->card_holder_name=$profile->card_holder_name;
            $tab->amount=$response->amount;
            $tab->retref=$response->retref;
            $tab->profileid=$response->profileid;
            $tab->status_remarks=$response->resptext;
            $tab->save();

            if($tab->id){
                return response()->json(['status'=>1,'msg'=>'Successfully saved','response'=>$response]);
            }
            else
            {
                return response()->json(['status'=>0,'msg'=>'Failed, Please try again later.']);
            }
        } catch (Exception $e) {
            return response()->json(['status'=>0,'msg'=>$e]);
        }

    }

    public function captureCardProfile($request,$profileid='',$acctid='',$amount=0){

        $storeMerchantSetCount=CardpointeStoreSetting::orderBy('id','DESC')->count();
        if($storeMerchantSetCount==0){

            return (object)array('status'=>0,'message'=>'Invalid credentials','resptext'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::orderBy('id','DESC')->first();

            $merchant_id = $storeMerchantSet->merchant_id;
            $user        = $storeMerchantSet->username;
            $authkey        = $storeMerchantSet->password;
            $server      = 'https://fts.cardconnect.com/cardconnect/rest/auth';
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $server,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS =>"{\n    \"merchid\": \"$merchant_id\",\n    \"profile\": \"$profileid/$acctid\",\n    \"amount\": \"$amount\",\n    \"currency\": \"USD\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$authkey,
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //echo $response;

            $gCAT=json_decode($response,true);
            //dd($gCAT);
            if($gCAT['resptext']=="Approval" && $gCAT['respstat']=="A"){

                    return (object)$gCAT;

            }
            else{

                //dd($gAT);
                return (object)array('status'=>0,'message'=>$gCAT['resptext'],'resptext'=>$gCAT['resptext'],'datares'=>$gCAT);
                die();
                //return $gAT;
            }

            //dd($storeMerchantSet);
        }

      
    }

    public function chargeCaptureProfile(Request $request){
        
        $profileid='16868558860271439755';
        $acctid='1';
        $amount=1.00;
        $response=$this->captureCardProfile($request,$profileid,$acctid,$amount);

        if(isset($response->respstat) && isset($response->resptext))
        {
            if($response->respstat=="A" && $response->resptext=="Approval")
            {
                //dd($response);
                echo $this->cardPointeeChargeProfile($response);
            }
            else
            {
                echo response()->json(['status'=>0,'msg'=>$response->resptext]);
            }
        }
        else
        {
            echo response()->json(['status'=>0,'msg'=>$response->resptext]);
        }

        //dd($response);
        //return response()->json(json_encode($response));

    }
    /* charge Profile End */

    public function makePayment($cardNum='',$amount=0,$expiry='',$invoice_id=0){

        $storeMerchantSetCount=CardpointeStoreSetting::orderBy('id','DESC')->count();
        if($storeMerchantSetCount==0){

            return (object)array('status'=>0,'message'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::orderBy('id','DESC')->first();

            $merchant_id = $storeMerchantSet->merchant_id;
            $user        = $storeMerchantSet->username;
            $authkey        = $storeMerchantSet->password;
            $server      = 'https://fts.cardconnect.com/cardconnect/rest/auth';
            //$server      = 'https://uat.cardconnect.com/cardconnect/rest/auth';


            $amountReady=number_format($amount,2);

            //$cardHName=$request->cardHName;
            $cardHName="Test";
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $server,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS =>"{\n    \"merchid\": \"$merchant_id\",\n    \"account\": \"$cardNum\",\n    \"expiry\": \"$expiry\",\n    \"amount\": \"$amountReady\",\n    \"orderid\": \"$invoice_id\",\n    \"currency\": \"USD\",\n    \"name\": \"$cardHName\",\n    \"capture\": \"y\",\n    \"receipt\": \"y\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$authkey,
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //echo $response;

            $gCAT=json_decode($response,true);
            dd($gCAT);
            if($gCAT['resptext']=="Approval" && $gCAT['respstat']=="A"){

                    return $gCAT;

            }
            else{

                //dd($gAT);
                return (object)array('status'=>0,'message'=>$gCAT['resptext'],'resptext'=>$gCAT['resptext'],'datares'=>$gCAT);
                die();
                //return $gAT;
            }

            //dd($storeMerchantSet);
        }

      
    }

    public function authorizeCard(Request $request){
        $cardNum='4111111111111111';
        $amount=1.00;
        $expiry='1220';
        $invoice_id=123;

        $response=$this->makePayment($cardNum,$amount,$expiry,$invoice_id);

        dd($response);
        //return response()->json(json_encode($response));

    }

    public function genarteencodeCardPointee(){
        //pattern
        // Program to illustrate base64_encode() 
        // function 
       // $str = 'GeeksforGeeks'; 
          
       // echo base64_encode($str); 

        return view('apps.pages.settings.cardPointeCodeGenerateSettings');
    }

    public function genarteencodeCardPointeeSave(Request $request){
        //pattern username:password

        $this->validate($request,[
            'username'=>'required',
            'password'=>'required',
        ]);

        // Program to illustrate base64_encode() 
        // function 
       $str = $request->username.':'.$request->password; 

       $authorization_code=base64_encode($str); 

       $storeMerchantSetCount=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->count();
       if($storeMerchantSetCount==0){

            $tab=new CardpointeStoreSetting();     
            $tab->store_id=$this->sdc->storeID();     
            $tab->password=$authorization_code;     
            $tab->save();     

       }else{

            $tab=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->first(); 
            $tab->password=$authorization_code;     
            $tab->save();   
       
       }
          
        return redirect(url('cardpointe/account/setting'))->with('status','Code generated Successfully');
    }

    

    private function captureAuthTrans($client,$auth_retref=""){
        $params = []; // optional
        $capture_response = $client->capture($auth_retref, $params);
        return $capture_response;
    }

    public function VoidTrans($orderid=0,$auth_retref=""){

        $storeMerchantSetCount=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->count();
        if($storeMerchantSetCount==0){
            echo "credentials failed."; die();
            return (object)array('status'=>0,'message'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->first();

                $merchant_id = $storeMerchantSet->merchant_id;
                $user        = $storeMerchantSet->username;
                $authkey        = $storeMerchantSet->password;
                $server      = 'https://fts.cardconnect.com/cardconnect/rest/voidByOrderId';

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $server,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS =>"{\n    \"merchid\": \"$merchant_id\",\n    \"orderid\": \"$orderid\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$authkey,
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            echo $response;
        }


    }

    private function inQueryTrans($client,$auth_retref=""){
        $capture_response = $client->inquire($auth_retref);

        return $capture_response;
    }

    private function reFundTrans($orderid=0,$auth_retref=""){
        $storeMerchantSetCount=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->count();
        if($storeMerchantSetCount==0){
            //echo "credentials failed."; die();
            return (object)array('status'=>0,'message'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->first();

                $merchant_id = $storeMerchantSet->merchant_id;
                $user        = $storeMerchantSet->username;
                $authkey        = $storeMerchantSet->password;
                $server      = 'https://fts.cardconnect.com/cardconnect/rest/voidByOrderId';

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $server,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS =>"{\n    \"merchid\": \"$merchant_id\",\n    \"orderid\": \"$orderid\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$authkey,
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return (object)json_decode($response,true);

            //echo $response;
        }
    }

    private function boltreFundTrans($orderid=0,$auth_retref=""){
        $storeMerchantSetCount=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->count();
        if($storeMerchantSetCount==0){
            //echo "credentials failed."; die();
            return (object)array('status'=>0,'message'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::where('store_id',$this->sdc->storeID())->first();

                $merchant_id = $storeMerchantSet->merchant_id;
                $user        = $storeMerchantSet->username;
                $authkey        = $storeMerchantSet->password;
                $server      = 'https://fts.cardconnect.com/cardconnect/rest/voidByOrderId';

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $server,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS =>"{\n    \"merchid\": \"$merchant_id\",\n    \"retref\": \"$orderid\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$authkey,
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return (object)json_decode($response,true);

            //echo $response;
        }
    }

    /*  Store Settings Start */

    private function genarateCode(){
        //pattern username:password
        // Program to illustrate base64_encode() 
        // function 
        $str = 'eastpoin:ha8#dfcHC@9dW9a!bfCL'; 
          
        return base64_encode($str); 
    }

    public function cardPointeSettings()
    {


       // echo $this->genarateCode(); die();

        $countData=\DB::table('cardpointe_store_settings')->where('store_id',$this->sdc->storeID())->count();
        if($countData>0)
        {
           $edit=\DB::table('cardpointe_store_settings')->where('store_id',$this->sdc->storeID())->first();
           return view('apps.pages.settings.cardPointeSettings',compact('edit'));
        }
        else
        {
            return view('apps.pages.settings.cardPointeSettings');
        }
    }

    public function cardPointeSettingsSave(Request $request)
    {
        $module_status=$request->module_status?1:0;
        \DB::table('cardpointe_store_settings')->insert(
            [
                'merchant_id'=>$request->merchant_id,
                'username'=>$request->username,
                'password'=>$request->password,
                'module_status'=>$module_status,
                'store_id'=>$this->sdc->storeID()
            ]);

        return redirect(url('cardpointe/account/setting'))->with('status', $this->moduleName.' Added Successfully !');;
    }

    public function cardPointeSettingsUpdate(Request $request)
    {
        $module_status=$request->module_status?1:0;
        $bolt_status=$request->bolt_status?1:0;
        \DB::table('cardpointe_store_settings')->where('store_id',$this->sdc->storeID())->update(
            [
                'merchant_id'=>$request->merchant_id,
                'username'=>$request->username,
                'password'=>$request->password,
                'hsn'=>$request->hsn,
                'authkey'=>$request->authkey,
                'module_status'=>$module_status,
                'bolt_status'=>$bolt_status
            ]);

        return redirect(url('cardpointe/account/setting'))->with('status', $this->moduleName.' Modified Successfully !');;
    }

    /*  Store Settings End */

    private function methodToGetMembersCount($search=''){

        $tab=CardPointee::select('id')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere(\DB::Raw('SUBSTRING(card_number,-4) as card_number'),'LIKE','%'.$search.'%');
                        $query->orWhere('retref','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->count();
        return $tab;
    }

    private function methodToGetMembers($start, $length,$search=''){

        $tab=CardPointee::select('id','invoice_id','created_at',\DB::Raw('SUBSTRING(card_number,-4) as card_number'),'amount','retref','refund_status')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere(\DB::Raw('SUBSTRING(card_number,-4) as card_number'),'LIKE','%'.$search.'%');
                        $query->orWhere('retref','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function datajson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
        $members = $this->methodToGetMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function refund(Request $request)
    {
        $id=$request->rid;
        if(!empty($request->rid))
        {
            $refId='ref' .time();
            $aNpH=CardPointee::find($id);
            //die($aNpH);
            $retData=$this->reFundTrans($aNpH->invoice_id);
           // dd($retData);

            $statusReturn=0;
            if($retData->resptext=="Approval" && $retData->respstat=="A")
            {
                $aNpH->refund_status=1;
                $statusReturn=1;
            }
            else
            {
                $aNpH->refund_status=0;
            }
            $aNpH->save();
            //return $statusReturn;

            return response()->json(['status'=>$statusReturn,'res'=>$retData]);
        }
        else
        {
            return 0;
        }
        
           
    }

    public function boltrefund(Request $request)
    {
        $id=$request->rid;
        if(!empty($request->rid))
        {
            $refId='ref' .time();
            $aNpH=CardPointee::find($id);
            //die($aNpH);
            $retData=$this->boltreFundTrans($aNpH->retref);
           // dd($retData);

            $statusReturn=0;
            if($retData->resptext=="Approval" && $retData->respstat=="A")
            {
                $aNpH->refund_status=1;
                $statusReturn=1;
            }
            else
            {
                $aNpH->refund_status=0;
            }
            $aNpH->save();
            //return $statusReturn;

            return response()->json(['status'=>$statusReturn,'res'=>$retData]);
        }
        else
        {
            return 0;
        }
        
           
    }

    public function index()
    {
        //echo 1; die();
        return view('apps.pages.report.card-payment-history-cardpointe');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function show(CardPointee $cardPointee, request $request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }
        // $customer_id='';
        // if(isset($request->customer_id))
        // {
        //     $customer_id=$request->customer_id;
        // }
        // dd($invoice_id);
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $card_number='';
        if(isset($request->card_number))
        {
            $card_number=$request->card_number;
        }
        // dd($card_number);
        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =CardPointee::select(\DB::raw('substr(card_number,-4) as card_number'))->groupBy(DB::raw('substr(card_number, -4)'))->get();
        // dd($dateString);
        $tab=CardPointee::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     // ->when($card_number, function ($query) use ($card_number) {
                     //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
                     // })
                     ->when($card_number, function ($query) use ($card_number) {
                            return $query->where(DB::raw('substr(card_number,-4)'),'=',$card_number);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("id","DESC")
                     ->get();
         // dd($tab);                 
        return view('apps.pages.report.card-payment-history-cardpointe',
            [
                'dataTable'=>$tab,
                'invoice_id'=>$invoice_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'card_number'=>$card_number
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuthorizeNetPaymentHistory  $authorizeNetPaymentHistory
     * @return \Illuminate\Http\Response
     */

    public function AuthReport(Request $request)
        {

            $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }
        // $customer_id='';
        // if(isset($request->customer_id))
        // {
        //     $customer_id=$request->customer_id;
        // }
        // dd($invoice_id);
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $card_number='';
        if(isset($request->card_number))
        {
            $card_number=$request->card_number;
        }
        // dd($card_number);
        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }
        $code =CardPointee::select(DB::raw('substr(card_number,-4) as card_number'))->groupBy(DB::raw('substr(card_number, -4)'))->get();
        // dd($code);
        $tab=CardPointee::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     // ->when($card_number, function ($query) use ($card_number) {
                     //        return $query->where(SUBSTRING('authorize_net_payment_histories.card_number',-4),'=', $card_number);
                     // })
                     ->when($card_number, function ($query) use ($card_number) {
                            return $query->where(DB::raw('substr(card_number,-4)'),'=',$card_number);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("id","DESC")
                     ->get();

          // dd($tab);
            return $tab;
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\ProductStockin  $productStockin
         * @return \Illuminate\Http\Response
         */
        
        public function ExcelReport(Request $request) 
        {
            // dd($request);
            //excel 
            $total_paid_amount=0;
            $data=array();
            $array_column=array('Invoice ID','Card Number','Transaction ID','Paid Amount','Date');
            array_push($data, $array_column);
            $inv=$this->AuthReport($request);
            foreach($inv as $voi):
                $inv_arry=array(
                    $voi->invoice_id,
                    "************".substr($voi->card_number,-4),
                    $voi->retref,
                    $voi->amount,
                    formatDateTime($voi->created_at)
                );
                $total_paid_amount+= $voi->amount;
                array_push($data, $inv_arry);
            endforeach;
           
            $array_column=array('','','Total =', $total_paid_amount,'');
            array_push($data, $array_column);

            $reportName="CardPointe Payment History Report";
            $report_title="CardPointe Payment History Report";
            $report_description="Report Genarated : ".date('d-M-Y H:i:s a');
            /*$data = array(
                array('data1', 'data2'),
                array('data3', 'data4')
            );*/

            //array_unshift($data,$array_column);

           // dd($data);

            $excelArray=array(
                'report_name'=>$reportName,
                'report_title'=>$report_title,
                'report_description'=>$report_description,
                'data'=>$data
            );

            $this->sdc->ExcelLayout($excelArray);
            
        }


        public function PdfReport(Request $request)
        {

            $data=array();
            
           
            $reportName="CardPointe Payment History Report";
            $report_title="CardPointe Payment History Report";
            $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

            $html='<table class="table table-bordered" style="width:100%;">
                    <thead>
                    <tr>
                    <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                    <th class="text-center" style="font-size:12px;" >Card Number</th>
                    <th class="text-center" style="font-size:12px;" >Transaction ID</th>
                    <th class="text-center" style="font-size:12px;" >Paid Amount</th>
                    <th class="text-center" style="font-size:12px;" >Date</th>
                    </tr>
                    </thead>
                    <tbody>';

                        $total_paid_amount=0;
                        $inv=$this->AuthReport($request);
                        foreach($inv as $index=>$voi):
        
                            $html .='<tr>
                            <td>'.$voi->invoice_id.'</td>
                            <td>************'.(substr($voi->card_number,-4)).'</td>
                            <td>'.$voi->retref.'</td>
                            <td align="center">'.$voi->amount.'</td>
                            <td>'.formatDateTime($voi->created_at).'</td>
                            </tr>';
                            $total_paid_amount+=$voi->amount;
                        endforeach;



                            

                 
                    /*html .='<tr style="border-bottom: 5px #000 solid;">
                    <td style="font-size:12px;">Subtotal </td>
                    <td style="font-size:12px;">Total Item : 4</td>
                    <td></td>
                    <td></td>
                    <td style="font-size:12px;" class="text-right">00</td>
                    </tr>';*/

                    $html .='</tbody>';
                    $html .='<tfoot>';
                    $html .='<tfoot>';
                    $html .='<tr>
                    <td></td>
                    <td></td>
                    <td>Total =</td>
                    <td align="center">'.$total_paid_amount.'</td>
                    <td></td>
                    </tr>';
                    $html .='</table>';
                    //echo $html; die();



                    $this->sdc->PDFLayout($reportName,$html);


        }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function edit(CardPointe $cardPointe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CardPointe $cardPointe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CardPointe  $cardPointe
     * @return \Illuminate\Http\Response
     */
    public function destroy(CardPointe $cardPointe)
    {
        //
    }
}
