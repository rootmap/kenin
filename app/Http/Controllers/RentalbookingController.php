<?php

namespace App\Http\Controllers;

use App\RentalBooking;
use App\AdminLog;
use Illuminate\Http\Request;
use App\RentalService;
                

class RentalBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Rental Booking";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=RentalBooking::all();
        return view('admin.pages.rentalbooking.rentalbooking_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_RentalService=RentalService::all();           
        return view('admin.pages.rentalbooking.rentalbooking_create',['dataRow_RentalService'=>$tab_RentalService]);
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
                
                'rental_id'=>'required',
                'rental_price'=>'required',
                'rent_start_date_time'=>'required',
                'rent_end_date_time'=>'required',
                'customer_name'=>'required',
                'customer_phone'=>'required',
                'customer_email'=>'required',
                'booking_method'=>'required',
                'booking_status'=>'required',
        ]);

        $this->SystemAdminLog("Rental Booking","Save New","Create New");

        
        $tab_0_RentalService=RentalService::where('id',$request->rental_id)->first();
        $rental_id_0_RentalService=$tab_0_RentalService->name;
        $tab=new RentalBooking();
        
        $tab->rental_id_name=$rental_id_0_RentalService;
        $tab->rental_id=$request->rental_id;
        $tab->rental_price=$request->rental_price;
        $tab->rent_start_date_time=$request->rent_start_date_time;
        $tab->rent_end_date_time=$request->rent_end_date_time;
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->booking_method=$request->booking_method;
        $tab->booking_status=$request->booking_status;
        $tab->save();

        return redirect('rentalbooking')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'rental_id'=>'required',
                'rental_price'=>'required',
                'rent_start_date_time'=>'required',
                'rent_end_date_time'=>'required',
                'customer_name'=>'required',
                'customer_phone'=>'required',
                'customer_email'=>'required',
                'booking_method'=>'required',
                'booking_status'=>'required',
        ]);

        $tab=new RentalBooking();
        
        $tab->rental_id_name=$rental_id_0_RentalService;
        $tab->rental_id=$request->rental_id;
        $tab->rental_price=$request->rental_price;
        $tab->rent_start_date_time=$request->rent_start_date_time;
        $tab->rent_end_date_time=$request->rent_end_date_time;
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->booking_method=$request->booking_method;
        $tab->booking_status=$request->booking_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RentalBooking  $rentalbooking
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('rental_id','LIKE','%'.$search.'%');
                            $query->orWhere('rental_price','LIKE','%'.$search.'%');
                            $query->orWhere('rent_start_date_time','LIKE','%'.$search.'%');
                            $query->orWhere('rent_end_date_time','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_phone','LIKE','%'.$search.'%');
                            $query->orWhere('customer_email','LIKE','%'.$search.'%');
                            $query->orWhere('booking_method','LIKE','%'.$search.'%');
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
                            $query->orWhere('rental_id','LIKE','%'.$search.'%');
                            $query->orWhere('rental_price','LIKE','%'.$search.'%');
                            $query->orWhere('rent_start_date_time','LIKE','%'.$search.'%');
                            $query->orWhere('rent_end_date_time','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_phone','LIKE','%'.$search.'%');
                            $query->orWhere('customer_email','LIKE','%'.$search.'%');
                            $query->orWhere('booking_method','LIKE','%'.$search.'%');
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

    
    public function RentalBookingQuery($request)
    {
        $RentalBooking_data=RentalBooking::orderBy('id','DESC')->get();

        return $RentalBooking_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Rental ID','Rental Price','Rent Start Date Time','Rent End Date Time','Customer Name','Customer Phone','Customer Email','Booking Method','Booking Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->RentalBookingQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->rental_id,$voi->rental_price,$voi->rent_start_date_time,$voi->rent_end_date_time,$voi->customer_name,$voi->customer_phone,$voi->customer_email,$voi->booking_method,$voi->booking_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Rental Booking Report',
            'report_title'=>'Rental Booking Report',
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
                            <th class='text-center' style='font-size:12px;' >Rental ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Rental Price</th>
                        
                            <th class='text-center' style='font-size:12px;' >Rent Start Date Time</th>
                        
                            <th class='text-center' style='font-size:12px;' >Rent End Date Time</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Phone</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Booking Method</th>
                        
                            <th class='text-center' style='font-size:12px;' >Booking Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->RentalBookingQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->rental_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->rental_price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->rent_start_date_time."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->rent_end_date_time."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_phone."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->booking_method."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->booking_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Rental Booking Report',$html);


    }
    public function show(RentalBooking $rentalbooking)
    {
        
        $tab=RentalBooking::all();return view('admin.pages.rentalbooking.rentalbooking_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RentalBooking  $rentalbooking
     * @return \Illuminate\Http\Response
     */
    public function edit(RentalBooking $rentalbooking,$id=0)
    {
        $tab=RentalBooking::find($id); 
        $tab_RentalService=RentalService::all();     
        return view('admin.pages.rentalbooking.rentalbooking_edit',['dataRow_RentalService'=>$tab_RentalService,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RentalBooking  $rentalbooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RentalBooking $rentalbooking,$id=0)
    {
        $this->validate($request,[
                
                'rental_id'=>'required',
                'rental_price'=>'required',
                'rent_start_date_time'=>'required',
                'rent_end_date_time'=>'required',
                'customer_name'=>'required',
                'customer_phone'=>'required',
                'customer_email'=>'required',
                'booking_method'=>'required',
                'booking_status'=>'required',
        ]);

        $this->SystemAdminLog("Rental Booking","Update","Edit / Modify");

        
        $tab_0_RentalService=RentalService::where('id',$request->rental_id)->first();
        $rental_id_0_RentalService=$tab_0_RentalService->name;
        $tab=RentalBooking::find($id);
        
        $tab->rental_id_name=$rental_id_0_RentalService;
        $tab->rental_id=$request->rental_id;
        $tab->rental_price=$request->rental_price;
        $tab->rent_start_date_time=$request->rent_start_date_time;
        $tab->rent_end_date_time=$request->rent_end_date_time;
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->booking_method=$request->booking_method;
        $tab->booking_status=$request->booking_status;
        $tab->save();

        return redirect('rentalbooking')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RentalBooking  $rentalbooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(RentalBooking $rentalbooking,$id=0)
    {
        $this->SystemAdminLog("Rental Booking","Destroy","Delete");

        $tab=RentalBooking::find($id);
        $tab->delete();
        return redirect('rentalbooking')->with('status','Deleted Successfully !');}
}
