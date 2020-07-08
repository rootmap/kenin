<?php

namespace App\Http\Controllers;

use App\TopMenu;
use App\AdminLog;
use Illuminate\Http\Request;

class TopMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Top Menu";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=TopMenu::all();
        return view('admin.pages.topmenu.topmenu_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.topmenu.topmenu_create');
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
                
                'menu_name'=>'required',
                'menu_link'=>'required',
                'menu_position'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Top Menu","Save New","Create New");

        
        $tab=new TopMenu();
        
        $tab->menu_name=$request->menu_name;
        $tab->menu_link=$request->menu_link;
        $tab->menu_position=$request->menu_position;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('topmenu')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'menu_name'=>'required',
                'menu_link'=>'required',
                'menu_position'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new TopMenu();
        
        $tab->menu_name=$request->menu_name;
        $tab->menu_link=$request->menu_link;
        $tab->menu_position=$request->menu_position;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TopMenu  $topmenu
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('menu_name','LIKE','%'.$search.'%');
                            $query->orWhere('menu_link','LIKE','%'.$search.'%');
                            $query->orWhere('menu_position','LIKE','%'.$search.'%');
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
                            $query->orWhere('menu_name','LIKE','%'.$search.'%');
                            $query->orWhere('menu_link','LIKE','%'.$search.'%');
                            $query->orWhere('menu_position','LIKE','%'.$search.'%');
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

    
    public function TopMenuQuery($request)
    {
        $TopMenu_data=TopMenu::orderBy('id','DESC')->get();

        return $TopMenu_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Menu Name','Menu Link','Menu Position','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->TopMenuQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->menu_name,$voi->menu_link,$voi->menu_position,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Top Menu Report',
            'report_title'=>'Top Menu Report',
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
                            <th class='text-center' style='font-size:12px;' >Menu Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Menu Link</th>
                        
                            <th class='text-center' style='font-size:12px;' >Menu Position</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->TopMenuQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->menu_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->menu_link."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->menu_position."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Top Menu Report',$html);


    }
    public function show(TopMenu $topmenu)
    {
        
        $tab=TopMenu::all();return view('admin.pages.topmenu.topmenu_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TopMenu  $topmenu
     * @return \Illuminate\Http\Response
     */
    public function edit(TopMenu $topmenu,$id=0)
    {
        $tab=TopMenu::find($id);      
        return view('admin.pages.topmenu.topmenu_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TopMenu  $topmenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopMenu $topmenu,$id=0)
    {
        $this->validate($request,[
                
                'menu_name'=>'required',
                'menu_link'=>'required',
                'menu_position'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Top Menu","Update","Edit / Modify");

        
        $tab=TopMenu::find($id);
        
        $tab->menu_name=$request->menu_name;
        $tab->menu_link=$request->menu_link;
        $tab->menu_position=$request->menu_position;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('topmenu')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TopMenu  $topmenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopMenu $topmenu,$id=0)
    {
        $this->SystemAdminLog("Top Menu","Destroy","Delete");

        $tab=TopMenu::find($id);
        $tab->delete();
        return redirect('topmenu')->with('status','Deleted Successfully !');}
}
