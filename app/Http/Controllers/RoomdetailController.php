<?php

namespace App\Http\Controllers;

use App\RoomDetail;
use App\AdminLog;
use Illuminate\Http\Request;

class RoomDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Room Detail";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=RoomDetail::all();
        return view('admin.pages.roomdetail.roomdetail_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.roomdetail.roomdetail_create');
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
                
                'room_sub_title'=>'required',
                'room_title'=>'required',
                'room_detail'=>'required',
                'photo'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Room Detail","Save New","Create New");

        

        $filename_roomdetail_3='';
        if ($request->hasFile('photo')) {
            $img_roomdetail = $request->file('photo');
            $upload_roomdetail = 'upload/roomdetail';
            $filename_roomdetail_3 = env('APP_NAME').'_'.time() . '.' . $img_roomdetail->getClientOriginalExtension();
            $img_roomdetail->move($upload_roomdetail, $filename_roomdetail_3);
        }

                
        $tab=new RoomDetail();
        
        $tab->room_sub_title=$request->room_sub_title;
        $tab->room_title=$request->room_title;
        $tab->room_detail=$request->room_detail;
        $tab->photo=$filename_roomdetail_3;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('roomdetail')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'room_sub_title'=>'required',
                'room_title'=>'required',
                'room_detail'=>'required',
                'photo'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new RoomDetail();
        
        $tab->room_sub_title=$request->room_sub_title;
        $tab->room_title=$request->room_title;
        $tab->room_detail=$request->room_detail;
        $tab->photo=$filename_roomdetail_3;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomDetail  $roomdetail
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('room_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('room_title','LIKE','%'.$search.'%');
                            $query->orWhere('room_detail','LIKE','%'.$search.'%');
                            $query->orWhere('photo','LIKE','%'.$search.'%');
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
                            $query->orWhere('room_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('room_title','LIKE','%'.$search.'%');
                            $query->orWhere('room_detail','LIKE','%'.$search.'%');
                            $query->orWhere('photo','LIKE','%'.$search.'%');
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

    
    public function RoomDetailQuery($request)
    {
        $RoomDetail_data=RoomDetail::orderBy('id','DESC')->get();

        return $RoomDetail_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Room Sub Title','Room Title','Room Detail','Photo','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->RoomDetailQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->room_sub_title,$voi->room_title,$voi->room_detail,$voi->photo,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Room Detail Report',
            'report_title'=>'Room Detail Report',
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
                            <th class='text-center' style='font-size:12px;' >Room Sub Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Room Detail</th>
                        
                            <th class='text-center' style='font-size:12px;' >Photo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->RoomDetailQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_sub_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->room_detail."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->photo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Room Detail Report',$html);


    }
    public function show(RoomDetail $roomdetail)
    {
        
        $tab=RoomDetail::all();return view('admin.pages.roomdetail.roomdetail_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomDetail  $roomdetail
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomDetail $roomdetail,$id=0)
    {
        $tab=RoomDetail::find($id);      
        return view('admin.pages.roomdetail.roomdetail_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomDetail  $roomdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomDetail $roomdetail,$id=0)
    {
        $this->validate($request,[
                
                'room_sub_title'=>'required',
                'room_title'=>'required',
                'room_detail'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Room Detail","Update","Edit / Modify");

        

        $filename_roomdetail_3=$request->ex_photo;
        if ($request->hasFile('photo')) {
            $img_roomdetail = $request->file('photo');
            $upload_roomdetail = 'upload/roomdetail';
            $filename_roomdetail_3 = env('APP_NAME').'_'.time() . '.' . $img_roomdetail->getClientOriginalExtension();
            $img_roomdetail->move($upload_roomdetail, $filename_roomdetail_3);
        }

                
        $tab=RoomDetail::find($id);
        
        $tab->room_sub_title=$request->room_sub_title;
        $tab->room_title=$request->room_title;
        $tab->room_detail=$request->room_detail;
        $tab->photo=$filename_roomdetail_3;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('roomdetail')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomDetail  $roomdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomDetail $roomdetail,$id=0)
    {
        $this->SystemAdminLog("Room Detail","Destroy","Delete");

        $tab=RoomDetail::find($id);
        $tab->delete();
        return redirect('roomdetail')->with('status','Deleted Successfully !');}
}
