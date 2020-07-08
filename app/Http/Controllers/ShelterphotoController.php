<?php

namespace App\Http\Controllers;

use App\ShelterPhoto;
use App\AdminLog;
use Illuminate\Http\Request;

class ShelterPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Shelter Photo";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=ShelterPhoto::all();
        return view('admin.pages.shelterphoto.shelterphoto_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.shelterphoto.shelterphoto_create');
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
                
                'photo'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Shelter Photo","Save New","Create New");

        

        $filename_shelterphoto_0='';
        if ($request->hasFile('photo')) {
            $img_shelterphoto = $request->file('photo');
            $upload_shelterphoto = 'upload/shelterphoto';
            $filename_shelterphoto_0 = env('APP_NAME').'_'.time() . '.' . $img_shelterphoto->getClientOriginalExtension();
            $img_shelterphoto->move($upload_shelterphoto, $filename_shelterphoto_0);
        }

                
        $tab=new ShelterPhoto();
        
        $tab->photo=$filename_shelterphoto_0;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('shelterphoto')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'photo'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new ShelterPhoto();
        
        $tab->photo=$filename_shelterphoto_0;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShelterPhoto  $shelterphoto
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
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

    
    public function ShelterPhotoQuery($request)
    {
        $ShelterPhoto_data=ShelterPhoto::orderBy('id','DESC')->get();

        return $ShelterPhoto_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Photo','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->ShelterPhotoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->photo,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Shelter Photo Report',
            'report_title'=>'Shelter Photo Report',
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
                            <th class='text-center' style='font-size:12px;' >Photo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->ShelterPhotoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->photo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Shelter Photo Report',$html);


    }
    public function show(ShelterPhoto $shelterphoto)
    {
        
        $tab=ShelterPhoto::all();return view('admin.pages.shelterphoto.shelterphoto_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShelterPhoto  $shelterphoto
     * @return \Illuminate\Http\Response
     */
    public function edit(ShelterPhoto $shelterphoto,$id=0)
    {
        $tab=ShelterPhoto::find($id);      
        return view('admin.pages.shelterphoto.shelterphoto_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShelterPhoto  $shelterphoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShelterPhoto $shelterphoto,$id=0)
    {
        $this->validate($request,[
                
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Shelter Photo","Update","Edit / Modify");

        

        $filename_shelterphoto_0=$request->ex_photo;
        if ($request->hasFile('photo')) {
            $img_shelterphoto = $request->file('photo');
            $upload_shelterphoto = 'upload/shelterphoto';
            $filename_shelterphoto_0 = env('APP_NAME').'_'.time() . '.' . $img_shelterphoto->getClientOriginalExtension();
            $img_shelterphoto->move($upload_shelterphoto, $filename_shelterphoto_0);
        }

                
        $tab=ShelterPhoto::find($id);
        
        $tab->photo=$filename_shelterphoto_0;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('shelterphoto')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShelterPhoto  $shelterphoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShelterPhoto $shelterphoto,$id=0)
    {
        $this->SystemAdminLog("Shelter Photo","Destroy","Delete");

        $tab=ShelterPhoto::find($id);
        $tab->delete();
        return redirect('shelterphoto')->with('status','Deleted Successfully !');}
}
