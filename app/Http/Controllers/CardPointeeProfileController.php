<?php

namespace App\Http\Controllers;

use App\CardPointeeProfile;
use App\CardpointeStoreSetting;
use App\BookingRequest;
use App\BookingConfiguration;
use Illuminate\Http\Request;

class CardPointeeProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* Generate Profile start */
    private $moduleName = "";
    private $sdc;
    public function __construct()
    {
        $this->sdc = new CoreCustomController();
    }

    private function bookingTemplate($request){


        $siteMessage='  <h2>
                            <strong><span style="color: #ff9900;">Room Reservation Detail</span></strong>
                        </h2>

                        <table style="border: 2px solid #000000; width: 436px;">

                        <tbody>

                        <tr style="height: 32px;">

                        <td style="width: 184px; height: 32px;">Reservation Created</td>

                        <td style="width: 244px; height: 32px;">&nbsp;'.date('dS M Y, h:i A').'</td>

                        </tr>

                        <tr style="height: 46px;">

                        <td style="width: 428px; height: 46px;" colspan="2">

                        <h3 style="display: block; width: 80%; border-bottom: 3px #000 solid;"><strong>Reservation Detail</strong></h3>

                        </td>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Booking Status</td>

                        <td style="width: 244px; height: 18px;">Pending</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Name</td>

                        <td style="width: 244px; height: 18px;">'.$request->card_holder_name.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Email&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->email.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Phone&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->phone.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Address&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->address.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Arrival Date</td>

                        <td style="width: 244px; height: 18px;">'.$request->arrival_date.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Departure Date</td>

                        <td style="width: 244px; height: 18px;">'.$request->departure_date.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Adults</td>

                        <td style="width: 244px; height: 18px;">'.$request->adults.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Children</td>

                        <td style="width: 244px; height: 18px;">'.$request->children.'</td>

                        </tr>
                        </tbody>

                        </table>

                        <p>Kind Regards, '.$this->sdc->SiteName.'&nbsp;</p>

                        <p>&nbsp;</p>';

        return $siteMessage;
    }
    
    private function addBookingRequest($request,$bking)
    {
        $tab=new BookingRequest();        
        $tab->paymentprofileid=$bking->profileid;
        $tab->acctid=$bking->acctid;
        $tab->customer_name=$request->card_holder_name;
        $tab->customer_name=$request->card_holder_name;
        $tab->customer_phone=$request->phone;
        $tab->customer_email=$request->email;
        $tab->customer_address=$request->address;
        $tab->arrival_date=$request->arrival_date;
        $tab->departure_date=$request->departure_date;
        $tab->adults=$request->adults;
        $tab->children=$request->children;
        $tab->booking_from="Online Booking";
        $tab->booking_status="Pending";
        $tab->save();

        $booking_Template=$this->bookingTemplate($request);
        //echo $booking_Template; die();

        $BookingConfiguration=BookingConfiguration::orderBy('id','DESC')->first();

        $this->sdc->initMail($request->email,
        'Online Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);


        $this->sdc->initMail($BookingConfiguration->booking_admin_email,
        'Online Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);

        return $tab->id;

    }   

    private function saveProfile($request,$response,$card_number='',$card_holder_name=''){
        
        try {
            $tab=new CardPointeeProfile();
            $tab->responseJson=json_encode($response);
            $tab->card_number=$card_number;
            $tab->card_holder_name=$card_holder_name;
            $tab->acctid=$response->acctid;
            $tab->profileid=$response->profileid;
            $tab->save();

            if($tab->id){
                $this->addBookingRequest($request,$tab);
                $BookingConfiguration=BookingConfiguration::orderBy('id','DESC')->first();
                return response()->json(['status'=>1,'resptext'=>$BookingConfiguration->booking_success_message,'response'=>$response]);
            }
            else
            {
                return response()->json(['status'=>0,'resptext'=>'Failed, Please try again later.']);
            }
        } catch (Exception $e) {
            return response()->json(['status'=>0,'resptext'=>$e]);
        }

    }

    public function createCardProfile($request){
        $card_number=$request->card_number;
        $card_holder_name=$request->card_holder_name;
        $address=$request->address;
        $city=$request->city;
        $region=$request->region;
        $country=$request->country;
        $postal=$request->postal;
        $expirySt=$request->expiry;
        $expiryArray=explode("/",$request->expiry);
        $expiryMonth=trim($expiryArray[0]);
        $expiryYear=substr(trim($expiryArray[1]),-2);
        $expiry=$expiryMonth."".$expiryYear;
        $storeMerchantSetCount=CardpointeStoreSetting::orderBy('id','DESC')->count();
        if($storeMerchantSetCount==0){

            return (object)array('status'=>0,'message'=>'Invalid credentials','resptext'=>'Invalid credentials');
                die();

        }else{

            $storeMerchantSet=CardpointeStoreSetting::orderBy('id','DESC')->first();

            $merchant_id = $storeMerchantSet->merchant_id;
            $user        = $storeMerchantSet->username;
            $authkey        = $storeMerchantSet->authcode;
            $server      = 'https://fts.cardconnect.com/cardconnect/rest/profile';
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $server,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "PUT",
              CURLOPT_POSTFIELDS =>"{\n    \"name\": \"$card_holder_name\",\n    \"address\": \"$address\",\n    \"city\": \"$city\",\n    \"region\": \"$region\",\n    \"country\": \"$country\",\n    \"postal\": \"$postal\",\n    \"merchid\": \"$merchant_id\",\n    \"account\": \"$card_number\",\n    \"expiry\": \"$expiry\",\n    \"currency\": \"USD\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic ".$authkey,
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $gCAT=json_decode($response,true);
            if($gCAT['resptext']=="Profile Saved" && $gCAT['respstat']=="A"){
                return (object)$gCAT;
            }
            else
            {
                return (object)array('status'=>0,'message'=>$gCAT['resptext'],'resptext'=>$gCAT['resptext'],'datares'=>$gCAT);
            }
        }
    }

    public function GenerateProfile(Request $request){
        $card_number=$request->card_number;
        $card_holder_name=$request->card_holder_name;

        // $card_number='4266841601703125';
        // $card_holder_name='Justin Dabish';
        // $address='46858 Topaz Ln Shelby Twp';
        // $city='Sterling Heights';
        // $region='MI';
        // $country='US';
        // $postal='48317';
        // $expiry='0823';

        //dd($request);
        
        $response=$this->createCardProfile($request);

        //dd($request);

        if(isset($response->respstat) && isset($response->resptext))
        {
            if($response->respstat=="A" && $response->resptext=="Profile Saved")
            {
                //dd($response);
                return $this->saveProfile($request,$response,$card_number,$card_holder_name);
            }
            else
            {
                return response()->json(['status'=>0,'resptext'=>$response->resptext]);
            }
        }
        else
        {
            return response()->json(['status'=>0,'resptext'=>$response->resptext]);
        }


        //return response()->json($response);

    }
    /* Generate Profile End */
}
