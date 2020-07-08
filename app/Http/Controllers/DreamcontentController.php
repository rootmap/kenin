<?php

namespace App\Http\Controllers;

use App\DreamContent;
use App\AdminLog;
use Illuminate\Http\Request;

class DreamContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Dream Content";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=DreamContent::count();
        if($tabCount==0)
        {
            return redirect(url('dreamcontent/create'));
        }else{

            $tab=DreamContent::orderBy('id','DESC')->first();      
        return view('admin.pages.dreamcontent.dreamcontent_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=DreamContent::count();
        if($tabCount==0)
        {            
        return view('admin.pages.dreamcontent.dreamcontent_create');
            
        }else{

            $tab=DreamContent::orderBy('id','DESC')->first();      
        return view('admin.pages.dreamcontent.dreamcontent_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
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
                
                'section_title'=>'required',
                'section_sub_title'=>'required',
                'section_block_one_title'=>'required',
                'section_block_one_detail'=>'required',
                'section_block_two_title'=>'required',
                'section_block_two_detail'=>'required',
                'section_block_three_title'=>'required',
                'section_block_three_detail'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Dream Content","Save New","Create New");

        
        $tab=new DreamContent();
        
        $tab->section_title=$request->section_title;
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_block_one_title=$request->section_block_one_title;
        $tab->section_block_one_detail=$request->section_block_one_detail;
        $tab->section_block_two_title=$request->section_block_two_title;
        $tab->section_block_two_detail=$request->section_block_two_detail;
        $tab->section_block_three_title=$request->section_block_three_title;
        $tab->section_block_three_detail=$request->section_block_three_detail;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('dreamcontent')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'section_title'=>'required',
                'section_sub_title'=>'required',
                'section_block_one_title'=>'required',
                'section_block_one_detail'=>'required',
                'section_block_two_title'=>'required',
                'section_block_two_detail'=>'required',
                'section_block_three_title'=>'required',
                'section_block_three_detail'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new DreamContent();
        
        $tab->section_title=$request->section_title;
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_block_one_title=$request->section_block_one_title;
        $tab->section_block_one_detail=$request->section_block_one_detail;
        $tab->section_block_two_title=$request->section_block_two_title;
        $tab->section_block_two_detail=$request->section_block_two_detail;
        $tab->section_block_three_title=$request->section_block_three_title;
        $tab->section_block_three_detail=$request->section_block_three_detail;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DreamContent  $dreamcontent
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('section_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_one_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_one_detail','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_two_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_two_detail','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_three_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_three_detail','LIKE','%'.$search.'%');
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
                            $query->orWhere('section_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_one_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_one_detail','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_two_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_two_detail','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_three_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_block_three_detail','LIKE','%'.$search.'%');
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

    
    public function DreamContentQuery($request)
    {
        $DreamContent_data=DreamContent::orderBy('id','DESC')->get();

        return $DreamContent_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Section Title','Section Sub Title','Section Block One Title','Section Block One Detail','Section Block Two Title','Section Block Two Detail','Section Block Three Title','Section Block Three Detail','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->DreamContentQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->section_title,$voi->section_sub_title,$voi->section_block_one_title,$voi->section_block_one_detail,$voi->section_block_two_title,$voi->section_block_two_detail,$voi->section_block_three_title,$voi->section_block_three_detail,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Dream Content Report',
            'report_title'=>'Dream Content Report',
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
                            <th class='text-center' style='font-size:12px;' >Section Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Sub Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Block One Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Block One Detail</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Block Two Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Block Two Detail</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Block Three Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Block Three Detail</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->DreamContentQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_sub_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_block_one_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_block_one_detail."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_block_two_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_block_two_detail."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_block_three_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_block_three_detail."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Dream Content Report',$html);


    }
    public function show(DreamContent $dreamcontent)
    {
        
        $tab=DreamContent::all();return view('admin.pages.dreamcontent.dreamcontent_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DreamContent  $dreamcontent
     * @return \Illuminate\Http\Response
     */
    public function edit(DreamContent $dreamcontent,$id=0)
    {
        $tab=DreamContent::find($id);      
        return view('admin.pages.dreamcontent.dreamcontent_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DreamContent  $dreamcontent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DreamContent $dreamcontent,$id=0)
    {
        $this->validate($request,[
                
                'section_title'=>'required',
                'section_sub_title'=>'required',
                'section_block_one_title'=>'required',
                'section_block_one_detail'=>'required',
                'section_block_two_title'=>'required',
                'section_block_two_detail'=>'required',
                'section_block_three_title'=>'required',
                'section_block_three_detail'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Dream Content","Update","Edit / Modify");

        
        $tab=DreamContent::find($id);
        
        $tab->section_title=$request->section_title;
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_block_one_title=$request->section_block_one_title;
        $tab->section_block_one_detail=$request->section_block_one_detail;
        $tab->section_block_two_title=$request->section_block_two_title;
        $tab->section_block_two_detail=$request->section_block_two_detail;
        $tab->section_block_three_title=$request->section_block_three_title;
        $tab->section_block_three_detail=$request->section_block_three_detail;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('dreamcontent')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DreamContent  $dreamcontent
     * @return \Illuminate\Http\Response
     */
    public function destroy(DreamContent $dreamcontent,$id=0)
    {
        $this->SystemAdminLog("Dream Content","Destroy","Delete");

        $tab=DreamContent::find($id);
        $tab->delete();
        return redirect('dreamcontent')->with('status','Deleted Successfully !');}
}
