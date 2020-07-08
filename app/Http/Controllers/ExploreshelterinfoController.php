<?php

namespace App\Http\Controllers;

use App\ExploreShelterInfo;
use App\AdminLog;
use Illuminate\Http\Request;

class ExploreShelterInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Explore Shelter Info";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=ExploreShelterInfo::count();
        if($tabCount==0)
        {
            return redirect(url('exploreshelterinfo/create'));
        }else{

            $tab=ExploreShelterInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.exploreshelterinfo.exploreshelterinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=ExploreShelterInfo::count();
        if($tabCount==0)
        {            
        return view('admin.pages.exploreshelterinfo.exploreshelterinfo_create');
            
        }else{

            $tab=ExploreShelterInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.exploreshelterinfo.exploreshelterinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                'section_one_title'=>'required',
                'section_two_title'=>'required',
                'section_three_title'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Explore Shelter Info","Save New","Create New");

        
        $tab=new ExploreShelterInfo();
        
        $tab->section_title=$request->section_title;
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_one_title=$request->section_one_title;
        $tab->section_two_title=$request->section_two_title;
        $tab->section_three_title=$request->section_three_title;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('exploreshelterinfo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'section_title'=>'required',
                'section_sub_title'=>'required',
                'section_one_title'=>'required',
                'section_two_title'=>'required',
                'section_three_title'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new ExploreShelterInfo();
        
        $tab->section_title=$request->section_title;
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_one_title=$request->section_one_title;
        $tab->section_two_title=$request->section_two_title;
        $tab->section_three_title=$request->section_three_title;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExploreShelterInfo  $exploreshelterinfo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('section_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_one_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_two_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_three_title','LIKE','%'.$search.'%');
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
                            $query->orWhere('section_one_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_two_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_three_title','LIKE','%'.$search.'%');
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

    
    public function ExploreShelterInfoQuery($request)
    {
        $ExploreShelterInfo_data=ExploreShelterInfo::orderBy('id','DESC')->get();

        return $ExploreShelterInfo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Section Title','Section Sub Title','Section One Title','Section Two Title','Section Three Title','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->ExploreShelterInfoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->section_title,$voi->section_sub_title,$voi->section_one_title,$voi->section_two_title,$voi->section_three_title,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Explore Shelter Info Report',
            'report_title'=>'Explore Shelter Info Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Section One Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Two Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Three Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->ExploreShelterInfoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_sub_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_one_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_two_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_three_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Explore Shelter Info Report',$html);


    }
    public function show(ExploreShelterInfo $exploreshelterinfo)
    {
        
        $tab=ExploreShelterInfo::all();return view('admin.pages.exploreshelterinfo.exploreshelterinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExploreShelterInfo  $exploreshelterinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ExploreShelterInfo $exploreshelterinfo,$id=0)
    {
        $tab=ExploreShelterInfo::find($id);      
        return view('admin.pages.exploreshelterinfo.exploreshelterinfo_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExploreShelterInfo  $exploreshelterinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExploreShelterInfo $exploreshelterinfo,$id=0)
    {
        $this->validate($request,[
                
                'section_title'=>'required',
                'section_one_title'=>'required',
                'section_two_title'=>'required',
                'section_three_title'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Explore Shelter Info","Update","Edit / Modify");

        
        $tab=ExploreShelterInfo::find($id);
        
        $tab->section_title=$request->section_title;
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_one_title=$request->section_one_title;
        $tab->section_two_title=$request->section_two_title;
        $tab->section_three_title=$request->section_three_title;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('exploreshelterinfo')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExploreShelterInfo  $exploreshelterinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExploreShelterInfo $exploreshelterinfo,$id=0)
    {
        $this->SystemAdminLog("Explore Shelter Info","Destroy","Delete");

        $tab=ExploreShelterInfo::find($id);
        $tab->delete();
        return redirect('exploreshelterinfo')->with('status','Deleted Successfully !');}
}
