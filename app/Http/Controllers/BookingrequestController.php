<?php

namespace App\Http\Controllers;

use App\BookingRequest;
use App\AdminLog;
use Illuminate\Http\Request;
use App\Room;
use App\BookingConfiguration;
use App\CardPointeeProfile;
use App\CardPointee;
use App\CardpointeStoreSetting;
                

class BookingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Booking Request";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=BookingRequest::all();
        return view('admin.pages.bookingrequest.bookingrequest_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $tab_Room=Room::all();           
        return view('admin.pages.bookingrequest.bookingrequest_create',['dataRow_Room'=>$tab_Room]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function SystemAdminLog($module_name="",$action="",$details=""){
        $tab=new AdminLog();
        $tab->module_name=$module_name;
        $tab->action=$action;
        $tab->details=$details;
        $tab->admin_id=$this->sdc->admin_id();
        $tab->admin_name=$this->sdc->UserName();
        $tab->save();
    }


    public function store(Request $request)
    {
        $this->validate($request,[
                'customer_name'=>'required',
                'customer_phone'=>'required',
                'customer_email'=>'required',
                'customer_address'=>'required',
                'arrival_date'=>'required',
                'departure_date'=>'required',
                'adults'=>'required',
                'children'=>'required',
                'booking_from'=>'required',
                'booking_status'=>'required',
        ]);

        $this->SystemAdminLog("Booking Request","Save New","Create New");

        $tab=new BookingRequest();
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->customer_address=$request->customer_address;
        $tab->arrival_date=$request->arrival_date;
        $tab->departure_date=$request->departure_date;
        $tab->adults=$request->adults;
        $tab->children=$request->children;
        $tab->booking_from=$request->booking_from;
        $tab->booking_status=$request->booking_status;
        $tab->save();

        return redirect('bookingrequest')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'room'=>'required',
                'room_quantity'=>'required',
                'customer_name'=>'required',
                'customer_phone'=>'required',
                'customer_email'=>'required',
                'customer_address'=>'required',
                'arrival_date'=>'required',
                'departure_date'=>'required',
                'adults'=>'required',
                'children'=>'required',
                'booking_from'=>'required',
                'booking_status'=>'required',
        ]);

        $tab=new BookingRequest();
        
        $tab->room_room_name=$room_0_Room;
        $tab->room=$request->room;
        $tab->room_quantity=$request->room_quantity;
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->customer_address=$request->customer_address;
        $tab->arrival_date=$request->arrival_date;
        $tab->departure_date=$request->departure_date;
        $tab->adults=$request->adults;
        $tab->children=$request->children;
        $tab->booking_from=$request->booking_from;
        $tab->booking_status=$request->booking_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingRequest  $bookingrequest
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('room','LIKE','%'.$search.'%');
                            $query->orWhere('room_quantity','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_phone','LIKE','%'.$search.'%');
                            $query->orWhere('customer_email','LIKE','%'.$search.'%');
                            $query->orWhere('customer_address','LIKE','%'.$search.'%');
                            $query->orWhere('arrival_date','LIKE','%'.$search.'%');
                            $query->orWhere('departure_date','LIKE','%'.$search.'%');
                            $query->orWhere('adults','LIKE','%'.$search.'%');
                            $query->orWhere('children','LIKE','%'.$search.'%');
                            $query->orWhere('booking_from','LIKE','%'.$search.'%');
                            $query->orWhere('booking_status','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->count();
        return $tab;
    }


    private function methodToGetMembers($start, $length,$search=''){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('room','LIKE','%'.$search.'%');
                            $query->orWhere('room_quantity','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_phone','LIKE','%'.$search.'%');
                            $query->orWhere('customer_email','LIKE','%'.$search.'%');
                            $query->orWhere('customer_address','LIKE','%'.$search.'%');
                            $query->orWhere('arrival_date','LIKE','%'.$search.'%');
                            $query->orWhere('departure_date','LIKE','%'.$search.'%');
                            $query->orWhere('adults','LIKE','%'.$search.'%');
                            $query->orWhere('children','LIKE','%'.$search.'%');
                            $query->orWhere('booking_from','LIKE','%'.$search.'%');
                            $query->orWhere('booking_status','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }

    public function datatable(Request $request){

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

    
    public function BookingRequestQuery($request)
    {
        $BookingRequest_data=BookingRequest::orderBy('id','DESC')->get();

        return $BookingRequest_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Room','Room Quantity','Customer Name','Customer Phone','Customer Email','Customer Address','Arrival Date','Departure Date','Adults','Children','Booking From','Booking Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->BookingRequestQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->room,$voi->room_quantity,$voi->customer_name,$voi->customer_phone,$voi->customer_email,$voi->customer_address,$voi->arrival_date,$voi->departure_date,$voi->adults,$voi->children,$voi->booking_from,$voi->booking_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Booking Request Report',
            'report_title'=>'Booking Request Report',
            'report_description'=>'Report Genarated : '.$dataDateTimeIns,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function ExportPDF(Request $request)
    {

        $html="<table class='table table-bordered' style='width:100%;'>
                <thead>
                <tr>
                <th class='text-center' style='font-size:12px;'>ID</th>
                            <th class='text-center' style='font-size:12px;' >Room</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Quantity</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Phone</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Arrival Date</th>
                        
                            <th class='text-center' style='font-size:12px;' >Departure Date</th>
                        
                            <th class='text-center' style='font-size:12px;' >Adults</th>
                        
                            <th class='text-center' style='font-size:12px;' >Children</th>
                        
                            <th class='text-center' style='font-size:12px;' >Booking From</th>
                        
                            <th class='text-center' style='font-size:12px;' >Booking Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->BookingRequestQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_quantity."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_phone."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->arrival_date."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->departure_date."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->adults."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->children."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->booking_from."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->booking_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Booking Request Report',$html);


    }
    public function show(BookingRequest $bookingrequest)
    {
        
        $tab=BookingRequest::all();return view('admin.pages.bookingrequest.bookingrequest_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingRequest  $bookingrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingRequest $bookingrequest,$id=0)
    {
        $tab=BookingRequest::find($id); 
        $tab_Room=Room::all();     
        return view('admin.pages.bookingrequest.bookingrequest_edit',['dataRow_Room'=>$tab_Room,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingRequest  $bookingrequest
     * @return \Illuminate\Http\Response
     */

    private function bookingTemplate($booking){


        $siteMessage='  <h2>
                            <strong><span style="color: #ff9900;">Room Reservation Detail</span></strong>
                        </h2>

                        <table style="border: 2px solid #000000; width: 436px;">

                        <tbody>

                        <tr style="height: 32px;">

                        <td style="width: 184px; height: 32px;">Reservation Created</td>

                        <td style="width: 244px; height: 32px;">&nbsp;'.date('dS M Y, h:i A').'</td>

                        </tr>

                        <tr style="height: 46px;">

                        <td style="width: 428px; height: 46px;" colspan="2">

                        <h3 style="display: block; width: 80%; border-bottom: 3px #000 solid;"><strong>Reservation Detail</strong></h3>

                        </td>

                        </tr>

                        
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Booking From</td>

                        <td style="width: 244px; height: 18px;">'.$booking->booking_from.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Booking Status</td>

                        <td style="width: 244px; height: 18px;">'.$booking->booking_status.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Name</td>

                        <td style="width: 244px; height: 18px;">'.$booking->customer_name.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Email&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$booking->customer_email.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Phone&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$booking->customer_phone.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Address&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$booking->customer_address.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Reservation Date</td>

                        <td style="width: 244px; height: 18px;">'.$booking->reservation_date.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Arrival Date</td>

                        <td style="width: 244px; height: 18px;">'.$booking->arrival_date.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Departure Date</td>

                        <td style="width: 244px; height: 18px;">'.$booking->departure_date.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Adults</td>

                        <td style="width: 244px; height: 18px;">'.$booking->adults.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Children</td>

                        <td style="width: 244px; height: 18px;">'.$booking->children.'</td>

                        </tr>
                        </tbody>

                        </table>

                        <p>Kind Regards, '.$this->sdc->SiteName.'&nbsp;</p>

                        <p>&nbsp;</p>';

        return $siteMessage;
    }



    public function update(Request $request, BookingRequest $bookingrequest,$id=0)
    {
        $this->validate($request,[
                'customer_name'=>'required',
                'customer_phone'=>'required',
                'customer_email'=>'required',
                'customer_address'=>'required',
                'arrival_date'=>'required',
                'departure_date'=>'required',
                'adults'=>'required',
                'children'=>'required',
                'booking_from'=>'required',
                'booking_status'=>'required',
        ]);

        $this->SystemAdminLog("Booking Request","Update","Edit / Modify");


        $tab=BookingRequest::find($id);
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->customer_address=$request->customer_address;
        $tab->arrival_date=$request->arrival_date;
        $tab->departure_date=$request->departure_date;
        $tab->adults=$request->adults;
        $tab->children=$request->children;
        $tab->booking_from=$request->booking_from;
        $tab->booking_status=$request->booking_status;
        $tab->save();


        $booking_Template=$this->bookingTemplate($tab);
        //echo $booking_Template; die();

        $BookingConfiguration=BookingConfiguration::orderBy('id','DESC')->first();

        $this->sdc->initMail($request->customer_email,
        $request->booking_status.' Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);


        $this->sdc->initMail($BookingConfiguration->booking_admin_email,
        $request->booking_status.' Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);


        return redirect('bookingrequest')->with('status','Booking Status ['.$request->booking_status.'] Updated Successfully !');
    }

    public function takepayment(Request $request, BookingRequest $bookingrequest,$id=0)
    {
        $this->SystemAdminLog("Booking Modification for Taking payment","Update","Edit / Modify");
        $tab=BookingRequest::find($id);
        //dd($tab);
        $BookingConfiguration=BookingConfiguration::orderBy('id','DESC')->first();
        $amount=number_format($BookingConfiguration->resort_daily_rent,2);
        $chargedProfile=$this->chargeCaptureProfile($request,$tab->paymentprofileid,$tab->acctid,$amount);
        
        $paymentMsg="";
        if($chargedProfile['status']==0)
        {
            $paymentMsg=$chargedProfile['msg'];
            $tab->booking_status="Canceled";
            $tab->save();
        }
        else
        {
            $paymentMsg="Payment Captured Successfully";
            $tab->booking_status="Confirm";
            $tab->save();
        }

        //dd($chargedProfile);

        $booking_Template=$this->bookingTemplate($tab);
        //echo $booking_Template; die();

        $this->sdc->initMail($request->customer_email,
        $tab->booking_status.' Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);


        $this->sdc->initMail($BookingConfiguration->booking_admin_email,
        $tab->booking_status.' Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);


        return redirect('bookingrequest')->with('status','Booking Status ['.$tab->booking_status.'] & Payment Status ['.$paymentMsg.'] !');
    }

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
                return (array)['status'=>1,'msg'=>'Successfully saved','response'=>$response];
            }
            else
            {
                return (array)['status'=>0,'msg'=>'Failed, Please try again later.'];
            }
        } catch (Exception $e) {
            return (array)['status'=>0,'msg'=>$e];
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

    private function chargeCaptureProfile($request,$profileid,$acctid,$amount){
        
        // $profileid='16868558860271439755';
        // $acctid='1';
        // $amount=1.00;
        $response=$this->captureCardProfile($request,$profileid,$acctid,$amount);

        if(isset($response->respstat) && isset($response->resptext))
        {
            if($response->respstat=="A" && $response->resptext=="Approval")
            {
                //dd($response);
                return $this->cardPointeeChargeProfile($response);
            }
            else
            {
                return (array)['status'=>0,'msg'=>$response->resptext];
            }
        }
        else
        {
            return (array)['status'=>0,'msg'=>$response->resptext];
        }

        //dd($response);
        //return response()->json(json_encode($response));

    }
    /* charge Profile End */

    public function voidPaymentMake($retref=''){

        $storeMerchantSetCount=CardpointeStoreSetting::orderBy('id','DESC')->count();
        if($storeMerchantSetCount==0){

            return (object)array('status'=>0,'message'=>'Invalid credentials','resptext'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::orderBy('id','DESC')->first();

            $merchant_id = $storeMerchantSet->merchant_id;
            $user        = $storeMerchantSet->username;
            $authkey        = $storeMerchantSet->password;
            $server      = 'https://fts.cardconnect.com/cardconnect/rest/void';
            
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
                CURLOPT_POSTFIELDS =>"{\n    \"merchid\": \"$merchant_id\",\n    \"retref\": \"$retref\"\n}",
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

    public function voidPayment($id=0){
        $tab=CardPointee::find($id);
        $response=$this->voidPaymentMake($tab->retref);
        if($response->resptext=="Approval" && $response->respstat=="A"){
                $tab->refund_status=1;
                $tab->save();
                return redirect(url('payment/log'))->with('status','Void operation complete successfully.');
        }
        else
        {
            return redirect(url('payment/log'))->with('error','Void operation failed.');
        }
        
    }

    public function paymentLog(){
        $tab=CardPointee::all();
        return view('admin.pages.bookingrequest.payment_list',['data'=>$tab]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingRequest  $bookingrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingRequest $bookingrequest,$id=0)
    {
        $this->SystemAdminLog("Booking Request","Destroy","Delete");

        $tab=BookingRequest::find($id);
        $tab->delete();
        return redirect('bookingrequest')->with('status','Deleted Successfully !');}
}
