<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use App\AdminLog;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Site Setting";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=SiteSetting::count();
        if($tabCount==0)
        {
            return redirect(url('sitesetting/create'));
        }else{

            $tab=SiteSetting::orderBy('id','DESC')->first();      
        return view('admin.pages.sitesetting.sitesetting_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=SiteSetting::count();
        if($tabCount==0)
        {            
        return view('admin.pages.sitesetting.sitesetting_create');
            
        }else{

            $tab=SiteSetting::orderBy('id','DESC')->first();      
        return view('admin.pages.sitesetting.sitesetting_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'site_name'=>'required',
                'site_title'=>'required',
                'site_description'=>'required',
                'site_logo'=>'required',
                'site_map'=>'required',
                'fotter_logo'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Site Setting","Save New","Create New");

        

        $filename_sitesetting_3='';
        if ($request->hasFile('site_logo')) {
            $img_sitesetting = $request->file('site_logo');
            $upload_sitesetting = 'upload/sitesetting';
            $filename_sitesetting_3 = env('APP_NAME').'_'.time() . '.' . $img_sitesetting->getClientOriginalExtension();
            $img_sitesetting->move($upload_sitesetting, $filename_sitesetting_3);
        }

                

        $filename_sitesetting_5='';
        if ($request->hasFile('fotter_logo')) {
            $img_sitesetting = $request->file('fotter_logo');
            $upload_sitesetting = 'upload/sitesetting';
            $filename_sitesetting_5 = env('APP_NAME').'_'.time() . '.' . $img_sitesetting->getClientOriginalExtension();
            $img_sitesetting->move($upload_sitesetting, $filename_sitesetting_5);
        }

                
        $tab=new SiteSetting();
        
        $tab->site_name=$request->site_name;
        $tab->site_title=$request->site_title;
        $tab->site_description=$request->site_description;
        $tab->site_logo=$filename_sitesetting_3;
        $tab->site_map=$request->site_map;
        $tab->fotter_logo=$filename_sitesetting_5;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('sitesetting')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'site_name'=>'required',
                'site_title'=>'required',
                'site_description'=>'required',
                'site_logo'=>'required',
                'site_map'=>'required',
                'fotter_logo'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new SiteSetting();
        
        $tab->site_name=$request->site_name;
        $tab->site_title=$request->site_title;
        $tab->site_description=$request->site_description;
        $tab->site_logo=$filename_sitesetting_3;
        $tab->site_map=$request->site_map;
        $tab->fotter_logo=$filename_sitesetting_5;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteSetting  $sitesetting
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('site_name','LIKE','%'.$search.'%');
                            $query->orWhere('site_title','LIKE','%'.$search.'%');
                            $query->orWhere('site_description','LIKE','%'.$search.'%');
                            $query->orWhere('site_logo','LIKE','%'.$search.'%');
                            $query->orWhere('site_map','LIKE','%'.$search.'%');
                            $query->orWhere('fotter_logo','LIKE','%'.$search.'%');
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
                            $query->orWhere('site_name','LIKE','%'.$search.'%');
                            $query->orWhere('site_title','LIKE','%'.$search.'%');
                            $query->orWhere('site_description','LIKE','%'.$search.'%');
                            $query->orWhere('site_logo','LIKE','%'.$search.'%');
                            $query->orWhere('site_map','LIKE','%'.$search.'%');
                            $query->orWhere('fotter_logo','LIKE','%'.$search.'%');
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

    
    public function SiteSettingQuery($request)
    {
        $SiteSetting_data=SiteSetting::orderBy('id','DESC')->get();

        return $SiteSetting_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Site Name','Site Title','Site Description','Site Logo','Site Map','Fotter Logo','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->SiteSettingQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->site_name,$voi->site_title,$voi->site_description,$voi->site_logo,$voi->site_map,$voi->fotter_logo,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Site Setting Report',
            'report_title'=>'Site Setting Report',
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
                            <th class='text-center' style='font-size:12px;' >Site Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Site Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Site Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Site Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Site Map</th>
                        
                            <th class='text-center' style='font-size:12px;' >Fotter Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->SiteSettingQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_map."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->fotter_logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Site Setting Report',$html);


    }
    public function show(SiteSetting $sitesetting)
    {
        
        $tab=SiteSetting::all();return view('admin.pages.sitesetting.sitesetting_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteSetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $sitesetting,$id=0)
    {
        $tab=SiteSetting::find($id);      
        return view('admin.pages.sitesetting.sitesetting_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteSetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSetting $sitesetting,$id=0)
    {
        $this->validate($request,[
                
                'site_name'=>'required',
                'site_title'=>'required',
                'site_description'=>'required',
                'site_map'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Site Setting","Update","Edit / Modify");

        

        $filename_sitesetting_3=$request->ex_site_logo;
        if ($request->hasFile('site_logo')) {
            $img_sitesetting = $request->file('site_logo');
            $upload_sitesetting = 'upload/sitesetting';
            $filename_sitesetting_3 = env('APP_NAME').'_'.time() . '.' . $img_sitesetting->getClientOriginalExtension();
            $img_sitesetting->move($upload_sitesetting, $filename_sitesetting_3);
        }

                

        $filename_sitesetting_5=$request->ex_fotter_logo;
        if ($request->hasFile('fotter_logo')) {
            $img_sitesetting = $request->file('fotter_logo');
            $upload_sitesetting = 'upload/sitesetting';
            $filename_sitesetting_5 = env('APP_NAME').'_'.time() . '.' . $img_sitesetting->getClientOriginalExtension();
            $img_sitesetting->move($upload_sitesetting, $filename_sitesetting_5);
        }

                
        $tab=SiteSetting::find($id);
        
        $tab->site_name=$request->site_name;
        $tab->site_title=$request->site_title;
        $tab->site_description=$request->site_description;
        $tab->site_logo=$filename_sitesetting_3;
        $tab->site_map=$request->site_map;
        $tab->fotter_logo=$filename_sitesetting_5;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('sitesetting')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteSetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $sitesetting,$id=0)
    {
        $this->SystemAdminLog("Site Setting","Destroy","Delete");

        $tab=SiteSetting::find($id);
        $tab->delete();
        return redirect('sitesetting')->with('status','Deleted Successfully !');}
}
