<?php

namespace App\Http\Controllers;

use App\AdminLog;
use App\SiteSetting;
use App\Slider;
use App\DreamContent;
use App\VideosContent;
use App\ExploreShelterInfo;
use App\ShelterPhoto;
use App\PeopleAndStory;
use App\peopleFeedback;
use App\RoomInfo;
use App\RoomDetail;
use App\FotterPageContent;
use App\FotterMenu;

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

    public function booking($arrival='',$departure='',$adult='',$children=''){

        $slider=Slider::orderBy('id','DESC')->first();
        return view('front-end.pages.booking',['slider'=>$slider,'arrival'=>$arrival,'departure'=>$departure,'adult'=>$adult,'children'=>$children]);
    }

    public function pages($pages=''){
        $FotterMenu=FotterMenu::where('menu_link',$pages)->first();
        $pageID=$FotterMenu->id;
        //dd($FotterMenu);
        $FotterPageContent=FotterPageContent::where('page_name',$pageID)->orderBy('id','ASC')->get();
        //dd($FotterPageContent);
        return view('front-end.pages.pages',['page'=>$FotterPageContent]);
    }

    public function index(){
        $SiteSetting=SiteSetting::orderBy('id','DESC')->first();
        $slider=Slider::orderBy('id','DESC')->first();
        $dreamContent=DreamContent::orderBy('id','DESC')->first();
        $videosContent=VideosContent::orderBy('id','DESC')->first();
        $exploreShelterInfo=ExploreShelterInfo::orderBy('id','DESC')->first();
        $peopleAndStory=PeopleAndStory::orderBy('id','DESC')->first();
        $RoomInfo=RoomInfo::orderBy('id','DESC')->first();
        $shelterPhoto=ShelterPhoto::where('module_status','Active')->orderBy('id','DESC')->get();
        $PeopleFeedback=PeopleFeedback::where('module_status','Active')->orderBy('id','DESC')->get();
        $RoomDetail=RoomDetail::where('module_status','Active')->orderBy('id','DESC')->get();
        $data=[
            'site'=>$SiteSetting,
            'dream'=>$dreamContent,
            'slider'=>$slider,
            'video'=>$videosContent,
            'shelter'=>$exploreShelterInfo,
            'shelterPhoto'=>$shelterPhoto,
            'peopleAndStory'=>$peopleAndStory,
            'peopleFeedback'=>$PeopleFeedback,
            'roomInfo'=>$RoomInfo,
            'roomDetail'=>$RoomDetail,
        ];
        return view('front-end.pages.index',$data);
    }
    
}
