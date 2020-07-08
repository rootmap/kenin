<?php

namespace App\Http\Controllers;

use App\FotterPageContent;
use App\AdminLog;
use Illuminate\Http\Request;
use App\FotterMenu;
                

class FotterPageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Fotter Page Content";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=FotterPageContent::all();
        return view('admin.pages.fotterpagecontent.fotterpagecontent_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_FotterMenu=FotterMenu::all();           
        return view('admin.pages.fotterpagecontent.fotterpagecontent_create',['dataRow_FotterMenu'=>$tab_FotterMenu]);
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
                
                'page_name'=>'required',
                'page_detail'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Fotter Page Content","Save New","Create New");

        
        $tab_0_FotterMenu=FotterMenu::where('id',$request->page_name)->first();
        $page_name_0_FotterMenu=$tab_0_FotterMenu->menu_name;
        $tab=new FotterPageContent();
        
        $tab->page_name_menu_name=$page_name_0_FotterMenu;
        $tab->page_name=$request->page_name;
        $tab->page_detail=$request->page_detail;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('fotterpagecontent')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'page_name'=>'required',
                'page_detail'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new FotterPageContent();
        
        $tab->page_name_menu_name=$page_name_0_FotterMenu;
        $tab->page_name=$request->page_name;
        $tab->page_detail=$request->page_detail;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FotterPageContent  $fotterpagecontent
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('page_name','LIKE','%'.$search.'%');
                            $query->orWhere('page_detail','LIKE','%'.$search.'%');
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
                            $query->orWhere('page_name','LIKE','%'.$search.'%');
                            $query->orWhere('page_detail','LIKE','%'.$search.'%');
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

    
    public function FotterPageContentQuery($request)
    {
        $FotterPageContent_data=FotterPageContent::orderBy('id','DESC')->get();

        return $FotterPageContent_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Page Name','Page Detail','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->FotterPageContentQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->page_name,$voi->page_detail,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Fotter Page Content Report',
            'report_title'=>'Fotter Page Content Report',
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
                            <th class='text-center' style='font-size:12px;' >Page Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Page Detail</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->FotterPageContentQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->page_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->page_detail."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Fotter Page Content Report',$html);


    }
    public function show(FotterPageContent $fotterpagecontent)
    {
        
        $tab=FotterPageContent::all();return view('admin.pages.fotterpagecontent.fotterpagecontent_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FotterPageContent  $fotterpagecontent
     * @return \Illuminate\Http\Response
     */
    public function edit(FotterPageContent $fotterpagecontent,$id=0)
    {
        $tab=FotterPageContent::find($id); 
        $tab_FotterMenu=FotterMenu::all();     
        return view('admin.pages.fotterpagecontent.fotterpagecontent_edit',['dataRow_FotterMenu'=>$tab_FotterMenu,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FotterPageContent  $fotterpagecontent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FotterPageContent $fotterpagecontent,$id=0)
    {
        $this->validate($request,[
                
                'page_name'=>'required',
                'page_detail'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Fotter Page Content","Update","Edit / Modify");

        
        $tab_0_FotterMenu=FotterMenu::where('id',$request->page_name)->first();
        $page_name_0_FotterMenu=$tab_0_FotterMenu->menu_name;
        $tab=FotterPageContent::find($id);
        
        $tab->page_name_menu_name=$page_name_0_FotterMenu;
        $tab->page_name=$request->page_name;
        $tab->page_detail=$request->page_detail;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('fotterpagecontent')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FotterPageContent  $fotterpagecontent
     * @return \Illuminate\Http\Response
     */
    public function destroy(FotterPageContent $fotterpagecontent,$id=0)
    {
        $this->SystemAdminLog("Fotter Page Content","Destroy","Delete");

        $tab=FotterPageContent::find($id);
        $tab->delete();
        return redirect('fotterpagecontent')->with('status','Deleted Successfully !');}
}
