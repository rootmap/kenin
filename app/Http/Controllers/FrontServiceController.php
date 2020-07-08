<?php

namespace App\Http\Controllers;

use App\FrontService;
use App\ContactMeAbout;
use App\ContactRequest;
use App\CaseType;
use App\USAState;
use App\NeedAnAttorney;
use App\AdminLog;
use App\ApplicationForm;
use Illuminate\Http\Request;

class FrontServiceController extends Controller
{

    private $moduleName = "";
    private $sdc;
    public function __construct()
    {
        $this->sdc = new CoreCustomController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard(){
        return view('admin.pages.dashboard.index');
    }

    private function SystemAdminLog($module_name = "", $action = "", $details = "")
    {
        $tab = new AdminLog();
        $tab->module_name = $module_name;
        $tab->action = $action;
        $tab->details = $details;
        $tab->admin_id = $this->sdc->admin_id();
        $tab->admin_name = $this->sdc->UserName();
        $tab->save();
    }

    public function contactus(Request $request){
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_about_id' => 'required',
            'state_case_id' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'msg' => 'Please Enter all required (*) field','error'=> $validator->errors()->all()]);
        }

        $this->SystemAdminLog("User Contact Us Request Submitted", "Save New", "Create New");


        

        $tab_2_ContactMeAbout = ContactMeAbout::where('id', $request->contact_about_id)->first();
        $contact_about_2_ContactMeAbout = $tab_2_ContactMeAbout->name;
        $tab_3_USAState = USAState::where('id', $request->state_case_id)->first();
        $state_case_3_USAState = $tab_3_USAState->name;

        $tab = new ContactRequest();
        $tab->first_name = $request->first_name;
        $tab->last_name = $request->last_name;
        $tab->contact_about_Reviewed = $contact_about_2_ContactMeAbout;
        $tab->contact_about = $request->contact_about_id;
        $tab->state_case_name = $state_case_3_USAState;
        $tab->state_case = $request->state_case_id;
        $tab->phone = $request->phone;
        $tab->email = $request->email;
        $tab->message = $request->message;
        $tab->save();

        return response()->json(['status' => 1, 'msg' => 'Your contact request submitted successfully.']);
    }

    public function needAnAttorNey(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'case_type' => 'required',
            'state_case' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'msg' => 'Please Enter all required (*) field', 'error' => $validator->errors()->all()]);
        }

        $this->SystemAdminLog("User Need Attorney Request Submitted", "Save New", "Create New");


        $tab_2_CaseType = CaseType::where('id', $request->case_type)->first();
        $case_type_2_CaseType = $tab_2_CaseType->name;
        
        $tab_3_USAState = USAState::where('id', $request->state_case)->first();
        $state_case_3_USAState = $tab_3_USAState->name;
        
        $tab = new NeedAnAttorney();
        $tab->first_name = $request->first_name;
        $tab->last_name = $request->last_name;
        $tab->case_type_name = $case_type_2_CaseType;
        $tab->case_type = $request->case_type;
        $tab->state_case_name = $state_case_3_USAState;
        $tab->state_case = $request->state_case;
        $tab->phone = $request->phone;
        $tab->email = $request->email;
        $tab->message = $request->message;
        $tab->request_status = "Submitted";
        $tab->save();

        return response()->json(['status' => 1, 'msg' => 'Your attorney request submitted successfully. Support team will contact with you soon.']);
    } 

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FrontService  $frontService
     * @return \Illuminate\Http\Response
     */
    public function show(FrontService $frontService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FrontService  $frontService
     * @return \Illuminate\Http\Response
     */
    public function edit(FrontService $frontService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FrontService  $frontService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrontService $frontService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FrontService  $frontService
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrontService $frontService)
    {
        //
    }
}
