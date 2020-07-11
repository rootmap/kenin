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
use App\Room;
use App\BookingRequest;

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
        $room = \DB::Select(\DB::raw("SELECT a.* FROM rooms AS a
        WHERE a.id NOT IN (SELECT br.room FROM booking_requests AS br WHERE br.room=a.id AND cast(br.arrival_date as date) BETWEEN CAST('".$arrival."' as date) AND CAST('".$departure."' as date))"));
        // $bookingCount=BookingRequest::whereDate('created_at',$arrival)->count();
        return view('front-end.pages.booking',['room'=>$room,'slider'=>$slider,'arrival'=>$arrival,'departure'=>$departure,'adult'=>$adult,'children'=>$children]);
    }

    public function bookingRoom($room=0, $arrival='',$departure='',$adult='',$children=''){

        $slider=Slider::orderBy('id','DESC')->first();
        $roomData = Room::find($room);
        // $bookingCount=BookingRequest::whereDate('created_at',$arrival)->count();
        return view('front-end.pages.booking-room',['roomData'=>$roomData,'room'=>$room,'slider'=>$slider,'arrival'=>$arrival,'departure'=>$departure,'adult'=>$adult,'children'=>$children]);
    }

    public function bookingConfirm(Request $request){

        if(empty($request->room)){
            return response()->json(['status'=>1,'msg'=>'Invalid Room ID, Please Select a valid room.']);
        }
        $tab_0_Room=Room::where('id',$request->room)->first();
        $room_0_Room=$tab_0_Room->room_name;
        $tab=new BookingRequest();

        if(empty($request->room_quantity)){
            return response()->json(['status'=>1,'msg'=>'Please select a room quantity.']);
        }
        elseif(empty($request->customer_name)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Name.']);
        }
        elseif(empty($request->customer_phone)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Phone.']);
        }
        elseif(empty($request->customer_email)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Email.']);
        }
        elseif(empty($request->customer_address)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Address.']);
        }
        elseif(empty($request->arrival_date)){
            return response()->json(['status'=>1,'msg'=>'Please Type Arrival Date.']);
        }
        elseif(empty($request->departure_date)){
            return response()->json(['status'=>1,'msg'=>'Please Type Departure Date.']);
        }
        elseif(empty($request->adults)){
            return response()->json(['status'=>1,'msg'=>'Minimum One Adults Required.']);
        }
        
        $tab->room_room_name=$room_0_Room;
        $tab->room=$request->room;
        $tab->room_quantity=$request->room_quantity;
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->customer_address=$request->customer_address;
        $tab->arrival_date=$request->arrival_date;
        $tab->departure_date=$request->departure_date;
        $tab->adults=$request->adults;
        $tab->children=$request->children;
        $tab->booking_from="Online Booking";
        $tab->booking_status="Pending";
        $tab->save();

        return response()->json(['status'=>0,'msg'=>'Booking Saved, Admin Will Response Soon.']);


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
