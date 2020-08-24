<?php

namespace App\Http\Controllers;

use App\VideosContent;
use App\AdminLog;
use Illuminate\Http\Request;

class VideosContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Videos Content";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=VideosContent::count();
        if($tabCount==0)
        {
            return redirect(url('videoscontent/create'));
        }else{

            $tab=VideosContent::orderBy('id','DESC')->first();      
        return view('admin.pages.videoscontent.videoscontent_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=VideosContent::count();
        if($tabCount==0)
        {            
        return view('admin.pages.videoscontent.videoscontent_create');
            
        }else{

            $tab=VideosContent::orderBy('id','DESC')->first();      
        return view('admin.pages.videoscontent.videoscontent_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'section_sub_title'=>'required',
                'section_title'=>'required',
                'section_button_text'=>'required',
                'section_button_url'=>'required',
                'section_foreground_image'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Videos Content","Save New","Create New");

        

        $filename_videoscontent_4='';
        if ($request->hasFile('section_foreground_image')) {
            $img_videoscontent = $request->file('section_foreground_image');
            $upload_videoscontent = 'upload/videoscontent';
            $filename_videoscontent_4 = env('APP_NAME').'_'.time() . '.' . $img_videoscontent->getClientOriginalExtension();
            $img_videoscontent->move($upload_videoscontent, $filename_videoscontent_4);
        }

                

        $filename_videoscontent_5='';
        if ($request->hasFile('section_video_mp4')) {
            $img_videoscontent = $request->file('section_video_mp4');
            $upload_videoscontent = 'upload/videoscontent';
            $filename_videoscontent_5 = env('APP_NAME').'_'.time() . '.' . $img_videoscontent->getClientOriginalExtension();
            $img_videoscontent->move($upload_videoscontent, $filename_videoscontent_5);
        }

                

        $filename_videoscontent_6='';
        if ($request->hasFile('section_video_webm')) {
            $img_videoscontent = $request->file('section_video_webm');
            $upload_videoscontent = 'upload/videoscontent';
            $filename_videoscontent_6 = env('APP_NAME').'_'.time() . '.' . $img_videoscontent->getClientOriginalExtension();
            $img_videoscontent->move($upload_videoscontent, $filename_videoscontent_6);

            
        }

                
        $tab=new VideosContent();
        
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_title=$request->section_title;
        $tab->section_button_text=$request->section_button_text;
        $tab->section_button_url=$request->section_button_url;
        $tab->section_foreground_image=$filename_videoscontent_4;
        $tab->section_video_mp4=$filename_videoscontent_5;
        $tab->section_video_webm=$filename_videoscontent_6;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('videoscontent')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'section_sub_title'=>'required',
                'section_title'=>'required',
                'section_button_text'=>'required',
                'section_button_url'=>'required',
                'section_foreground_image'=>'required',
                'section_video_mp4'=>'required',
                'section_video_webm'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new VideosContent();
        
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_title=$request->section_title;
        $tab->section_button_text=$request->section_button_text;
        $tab->section_button_url=$request->section_button_url;
        $tab->section_foreground_image=$filename_videoscontent_4;
        $tab->section_video_mp4=$filename_videoscontent_5;
        $tab->section_video_webm=$filename_videoscontent_6;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideosContent  $videoscontent
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('section_sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_title','LIKE','%'.$search.'%');
                            $query->orWhere('section_button_text','LIKE','%'.$search.'%');
                            $query->orWhere('section_button_url','LIKE','%'.$search.'%');
                            $query->orWhere('section_foreground_image','LIKE','%'.$search.'%');
                            $query->orWhere('section_video_mp4','LIKE','%'.$search.'%');
                            $query->orWhere('section_video_webm','LIKE','%'.$search.'%');
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
                            $query->orWhere('section_button_text','LIKE','%'.$search.'%');
                            $query->orWhere('section_button_url','LIKE','%'.$search.'%');
                            $query->orWhere('section_foreground_image','LIKE','%'.$search.'%');
                            $query->orWhere('section_video_mp4','LIKE','%'.$search.'%');
                            $query->orWhere('section_video_webm','LIKE','%'.$search.'%');
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

    
    public function VideosContentQuery($request)
    {
        $VideosContent_data=VideosContent::orderBy('id','DESC')->get();

        return $VideosContent_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Section Sub Title','Section Title','Section Button Text','Section Button URL','Section Foreground Image','Section Video Mp4','Section Video Webm','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->VideosContentQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->section_sub_title,$voi->section_title,$voi->section_button_text,$voi->section_button_url,$voi->section_foreground_image,$voi->section_video_mp4,$voi->section_video_webm,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Videos Content Report',
            'report_title'=>'Videos Content Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Section Button Text</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Button URL</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Foreground Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Video Mp4</th>
                        
                            <th class='text-center' style='font-size:12px;' >Section Video Webm</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->VideosContentQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_sub_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_button_text."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_button_url."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_foreground_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_video_mp4."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->section_video_webm."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Videos Content Report',$html);


    }
    public function show(VideosContent $videoscontent)
    {
        
        $tab=VideosContent::all();return view('admin.pages.videoscontent.videoscontent_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideosContent  $videoscontent
     * @return \Illuminate\Http\Response
     */
    public function edit(VideosContent $videoscontent,$id=0)
    {
        $tab=VideosContent::find($id);      
        return view('admin.pages.videoscontent.videoscontent_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideosContent  $videoscontent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideosContent $videoscontent,$id=0)
    {
        $this->validate($request,[
                
                'section_sub_title'=>'required',
                'section_title'=>'required',
                'section_button_text'=>'required',
                'section_button_url'=>'required',
                'section_video_mp4'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Videos Content","Update","Edit / Modify");


        $filename_videoscontent_4=$request->ex_section_foreground_image;
        if ($request->hasFile('section_foreground_image')) {
            $img_videoscontent = $request->file('section_foreground_image');
            $upload_videoscontent = 'upload/videoscontent';
            $filename_videoscontent_4 = env('APP_NAME').'_'.time() . '.' . $img_videoscontent->getClientOriginalExtension();
            $img_videoscontent->move($upload_videoscontent, $filename_videoscontent_4);
        }

                
        $tab=VideosContent::find($id);
        
        $tab->section_sub_title=$request->section_sub_title;
        $tab->section_title=$request->section_title;
        $tab->section_button_text=$request->section_button_text;
        $tab->section_button_url=$request->section_button_url;
        $tab->section_foreground_image=$filename_videoscontent_4;
        $tab->section_video_mp4=$request->section_video_mp4;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('videoscontent')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideosContent  $videoscontent
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideosContent $videoscontent,$id=0)
    {
        $this->SystemAdminLog("Videos Content","Destroy","Delete");

        $tab=VideosContent::find($id);
        $tab->delete();
        return redirect('videoscontent')->with('status','Deleted Successfully !');}
}
