<?php

namespace App\Http\Controllers;

use App\PeopleFeedback;
use App\AdminLog;
use Illuminate\Http\Request;

class PeopleFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="People Feedback";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=PeopleFeedback::all();
        return view('admin.pages.peoplefeedback.peoplefeedback_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.peoplefeedback.peoplefeedback_create');
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
                'feedback'=>'required',
                'feedback_author'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("People Feedback","Save New","Create New");

        

        $filename_peoplefeedback_0='';
        if ($request->hasFile('photo')) {
            $img_peoplefeedback = $request->file('photo');
            $upload_peoplefeedback = 'upload/peoplefeedback';
            $filename_peoplefeedback_0 = env('APP_NAME').'_'.time() . '.' . $img_peoplefeedback->getClientOriginalExtension();
            $img_peoplefeedback->move($upload_peoplefeedback, $filename_peoplefeedback_0);
        }

                
        $tab=new PeopleFeedback();
        
        $tab->photo=$filename_peoplefeedback_0;
        $tab->feedback=$request->feedback;
        $tab->feedback_author=$request->feedback_author;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('peoplefeedback')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'photo'=>'required',
                'feedback'=>'required',
                'feedback_author'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new PeopleFeedback();
        
        $tab->photo=$filename_peoplefeedback_0;
        $tab->feedback=$request->feedback;
        $tab->feedback_author=$request->feedback_author;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PeopleFeedback  $peoplefeedback
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('photo','LIKE','%'.$search.'%');
                            $query->orWhere('feedback','LIKE','%'.$search.'%');
                            $query->orWhere('feedback_author','LIKE','%'.$search.'%');
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
                            $query->orWhere('feedback','LIKE','%'.$search.'%');
                            $query->orWhere('feedback_author','LIKE','%'.$search.'%');
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

    
    public function PeopleFeedbackQuery($request)
    {
        $PeopleFeedback_data=PeopleFeedback::orderBy('id','DESC')->get();

        return $PeopleFeedback_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Photo','Feedback','Feedback Author','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->PeopleFeedbackQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->photo,$voi->feedback,$voi->feedback_author,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'People Feedback Report',
            'report_title'=>'People Feedback Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Feedback</th>
                        
                            <th class='text-center' style='font-size:12px;' >Feedback Author</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->PeopleFeedbackQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->photo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->feedback."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->feedback_author."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('People Feedback Report',$html);


    }
    public function show(PeopleFeedback $peoplefeedback)
    {
        
        $tab=PeopleFeedback::all();return view('admin.pages.peoplefeedback.peoplefeedback_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PeopleFeedback  $peoplefeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(PeopleFeedback $peoplefeedback,$id=0)
    {
        $tab=PeopleFeedback::find($id);      
        return view('admin.pages.peoplefeedback.peoplefeedback_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PeopleFeedback  $peoplefeedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeopleFeedback $peoplefeedback,$id=0)
    {
        $this->validate($request,[
                
                'feedback'=>'required',
                'feedback_author'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("People Feedback","Update","Edit / Modify");

        

        $filename_peoplefeedback_0=$request->ex_photo;
        if ($request->hasFile('photo')) {
            $img_peoplefeedback = $request->file('photo');
            $upload_peoplefeedback = 'upload/peoplefeedback';
            $filename_peoplefeedback_0 = env('APP_NAME').'_'.time() . '.' . $img_peoplefeedback->getClientOriginalExtension();
            $img_peoplefeedback->move($upload_peoplefeedback, $filename_peoplefeedback_0);
        }

                
        $tab=PeopleFeedback::find($id);
        
        $tab->photo=$filename_peoplefeedback_0;
        $tab->feedback=$request->feedback;
        $tab->feedback_author=$request->feedback_author;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('peoplefeedback')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PeopleFeedback  $peoplefeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeopleFeedback $peoplefeedback,$id=0)
    {
        $this->SystemAdminLog("People Feedback","Destroy","Delete");

        $tab=PeopleFeedback::find($id);
        $tab->delete();
        return redirect('peoplefeedback')->with('status','Deleted Successfully !');}
}
