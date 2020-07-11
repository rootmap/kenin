<?php

namespace App\Http\Controllers;

use App\BookingRequest;
use App\AdminLog;
use Illuminate\Http\Request;
use App\Room;
use App\BookingConfiguration;
                

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

        $this->SystemAdminLog("Booking Request","Save New","Create New");

        
        $tab_0_Room=Room::where('id',$request->room)->first();
        $room_0_Room=$tab_0_Room->room_name;
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

    private function bookingTemplate($booking, $room){


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

                        <td style="width: 184px; height: 18px;">&nbsp;Room Name</td>

                        <td style="width: 244px; height: 18px;">'.$room->room_name.' ('.$room->room_size.')</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Room Quantity</td>

                        <td style="width: 244px; height: 18px;">'.$booking->room_quantity.'</td>

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

        $this->SystemAdminLog("Booking Request","Update","Edit / Modify");

        
        $tab_0_Room=Room::where('id',$request->room)->first();
        $room_0_Room=$tab_0_Room->room_name;
        $tab=BookingRequest::find($id);
        
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


        $booking_Template=$this->bookingTemplate($tab, $tab_0_Room);
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
