<?php

namespace App\Http\Controllers;

use App\PeopleAndStory;
use App\AdminLog;
use Illuminate\Http\Request;

class PeopleAndStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="People And Story";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=PeopleAndStory::count();
        if($tabCount==0)
        {
            return redirect(url('peopleandstory/create'));
        }else{

            $tab=PeopleAndStory::orderBy('id','DESC')->first();      
        return view('admin.pages.peopleandstory.peopleandstory_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=PeopleAndStory::count();
        if($tabCount==0)
        {            
        return view('admin.pages.peopleandstory.peopleandstory_create');
            
        }else{

            $tab=PeopleAndStory::orderBy('id','DESC')->first();      
        return view('admin.pages.peopleandstory.peopleandstory_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("People And Story","Save New","Create New");

        
        $tab=new PeopleAndStory();
        
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_title=$request->section_title;
        $tab->section_description=$request->section_description;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('peopleandstory')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'section_title'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new PeopleAndStory();
        
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_title=$request->section_title;
        $tab->section_description=$request->section_description;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PeopleAndStory  $peopleandstory
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('section_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_description','LIKE','%'.$search.'%');
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
                            $query->orWhere('section_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_description','LIKE','%'.$search.'%');
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

    
    public function PeopleAndStoryQuery($request)
    {
        $PeopleAndStory_data=PeopleAndStory::orderBy('id','DESC')->get();

        return $PeopleAndStory_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Section Sub Title','Section Title','Section Description','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->PeopleAndStoryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->section_sub_title,$voi->section_title,$voi->section_description,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'People And Story Report',
            'report_title'=>'People And Story Report',
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
                            <th class='text-center' style='font-size:12px;' >Section Sub Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->PeopleAndStoryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_sub_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('People And Story Report',$html);


    }
    public function show(PeopleAndStory $peopleandstory)
    {
        
        $tab=PeopleAndStory::all();return view('admin.pages.peopleandstory.peopleandstory_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeopleAndStory  $peopleandstory
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleAndStory $peopleandstory,$id=0)
    {
        $tab=PeopleAndStory::find($id);      
        return view('admin.pages.peopleandstory.peopleandstory_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeopleAndStory  $peopleandstory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeopleAndStory $peopleandstory,$id=0)
    {
        $this->validate($request,[
                
                'section_title'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("People And Story","Update","Edit / Modify");

        
        $tab=PeopleAndStory::find($id);
        
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_title=$request->section_title;
        $tab->section_description=$request->section_description;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('peopleandstory')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeopleAndStory  $peopleandstory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleAndStory $peopleandstory,$id=0)
    {
        $this->SystemAdminLog("People And Story","Destroy","Delete");

        $tab=PeopleAndStory::find($id);
        $tab->delete();
        return redirect('peopleandstory')->with('status','Deleted Successfully !');}
}
