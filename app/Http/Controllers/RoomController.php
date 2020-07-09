<?php

namespace App\Http\Controllers;

use App\Room;
use App\AdminLog;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Room";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=Room::all();
        return view('admin.pages.room.room_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.room.room_create');
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
                
                'room_size'=>'required',
                'room_name'=>'required',
                'room_price'=>'required',
                'room_quantity'=>'required',
                'room_feature'=>'required',
                'room_service'=>'required',
                'room_photo'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Room","Save New","Create New");

        

        $filename_room_6='';
        if ($request->hasFile('room_photo')) {
            $img_room = $request->file('room_photo');
            $upload_room = 'upload/room';
            $filename_room_6 = env('APP_NAME').'_'.time() . '.' . $img_room->getClientOriginalExtension();
            $img_room->move($upload_room, $filename_room_6);
        }

                
        $tab=new Room();
        
        $tab->room_size=$request->room_size;
        $tab->room_name=$request->room_name;
        $tab->room_price=$request->room_price;
        $tab->room_quantity=$request->room_quantity;
        $tab->room_feature=$request->room_feature;
        $tab->room_service=$request->room_service;
        $tab->room_photo=$filename_room_6;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('room')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'room_size'=>'required',
                'room_name'=>'required',
                'room_price'=>'required',
                'room_quantity'=>'required',
                'room_feature'=>'required',
                'room_service'=>'required',
                'room_photo'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new Room();
        
        $tab->room_size=$request->room_size;
        $tab->room_name=$request->room_name;
        $tab->room_price=$request->room_price;
        $tab->room_quantity=$request->room_quantity;
        $tab->room_feature=$request->room_feature;
        $tab->room_service=$request->room_service;
        $tab->room_photo=$filename_room_6;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('room_size','LIKE','%'.$search.'%');
                            $query->orWhere('room_name','LIKE','%'.$search.'%');
                            $query->orWhere('room_price','LIKE','%'.$search.'%');
                            $query->orWhere('room_quantity','LIKE','%'.$search.'%');
                            $query->orWhere('room_feature','LIKE','%'.$search.'%');
                            $query->orWhere('room_service','LIKE','%'.$search.'%');
                            $query->orWhere('room_photo','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('room_size','LIKE','%'.$search.'%');
                            $query->orWhere('room_name','LIKE','%'.$search.'%');
                            $query->orWhere('room_price','LIKE','%'.$search.'%');
                            $query->orWhere('room_quantity','LIKE','%'.$search.'%');
                            $query->orWhere('room_feature','LIKE','%'.$search.'%');
                            $query->orWhere('room_service','LIKE','%'.$search.'%');
                            $query->orWhere('room_photo','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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

    
    public function RoomQuery($request)
    {
        $Room_data=Room::orderBy('id','DESC')->get();

        return $Room_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Room SIze','Room Name','Room Price','Room Quantity','Room Feature','Room Service','Room Photo','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->RoomQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->room_size,$voi->room_name,$voi->room_price,$voi->room_quantity,$voi->room_feature,$voi->room_service,$voi->room_photo,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Room Report',
            'report_title'=>'Room Report',
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
                            <th class='text-center' style='font-size:12px;' >Room SIze</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Price</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Quantity</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Feature</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Service</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Photo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->RoomQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_size."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_quantity."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_feature."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_service."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_photo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Room Report',$html);


    }
    public function show(Room $room)
    {
        
        $tab=Room::all();return view('admin.pages.room.room_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room,$id=0)
    {
        $tab=Room::find($id);      
        return view('admin.pages.room.room_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room,$id=0)
    {
        $this->validate($request,[
                
                'room_size'=>'required',
                'room_name'=>'required',
                'room_price'=>'required',
                'room_quantity'=>'required',
                'room_feature'=>'required',
                'room_service'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Room","Update","Edit / Modify");

        

        $filename_room_6=$request->ex_room_photo;
        if ($request->hasFile('room_photo')) {
            $img_room = $request->file('room_photo');
            $upload_room = 'upload/room';
            $filename_room_6 = env('APP_NAME').'_'.time() . '.' . $img_room->getClientOriginalExtension();
            $img_room->move($upload_room, $filename_room_6);
        }

                
        $tab=Room::find($id);
        
        $tab->room_size=$request->room_size;
        $tab->room_name=$request->room_name;
        $tab->room_price=$request->room_price;
        $tab->room_quantity=$request->room_quantity;
        $tab->room_feature=$request->room_feature;
        $tab->room_service=$request->room_service;
        $tab->room_photo=$filename_room_6;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('room')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room,$id=0)
    {
        $this->SystemAdminLog("Room","Destroy","Delete");

        $tab=Room::find($id);
        $tab->delete();
        return redirect('room')->with('status','Deleted Successfully !');}
}
