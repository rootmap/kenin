<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/','HomeController@master')->name('master');
Route::get('/','FrontServiceController@index')->name('index');
Route::get('/cardpointetest','CardPointeeController@makePayment');
Route::post('/cpe/profile/create','CardPointeeProfileController@GenerateProfile');
Route::get('/cpe/profile/charge','CardPointeeController@chargeCaptureProfile');
Route::post('/cpe/checking/booking','FrontServiceController@checkBooking');
Route::post('/region','FrontServiceController@getRegion');
Route::get('/pages/{page?}','FrontServiceController@pages');
Route::get('/booking/{arrival}/{departure}/{adult}/{children}','FrontServiceController@booking');
Route::post('/booking','FrontServiceController@bookingConfirm');
Route::get('/booking-item/{room}/{arrival}/{departure}/{adult}/{children}','FrontServiceController@bookingRoom');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/master', 'HomeController@master')->name('master');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/crud', 'CrudController@crud')->name('crud');
    Route::post('/crud', 'CrudController@crudgenarate')->name('crudgenarate');
    Route::get('/home', 'FrontServiceController@dashboard')->name('home');
    Route::get('/dashboard', 'FrontServiceController@dashboard')->name('dashboard');

    //======================== Sitesetting Route Start ===============================//
    Route::get('/sitesetting/list','SitesettingController@show');
    Route::get('/sitesetting/create','SitesettingController@create');
    Route::get('/sitesetting/edit/{id}','SitesettingController@edit');
    Route::get('/sitesetting/delete/{id}','SitesettingController@destroy');
    Route::get('/sitesetting','SitesettingController@index');
    Route::get('/sitesetting/export/excel','SitesettingController@ExportExcel');
    Route::get('/sitesetting/export/pdf','SitesettingController@ExportPDF');
    Route::post('/sitesetting','SitesettingController@store');
    Route::post('/sitesetting/ajax','SitesettingController@ajaxSave');
    Route::post('/sitesetting/datatable/ajax','SitesettingController@datatable');
    Route::post('/sitesetting/update/{id}','SitesettingController@update');
    //======================== Sitesetting Route End ===============================//
    //======================== Topmenu Route Start ===============================//
    Route::get('/topmenu/list','TopmenuController@show');
    Route::get('/topmenu/create','TopmenuController@create');
    Route::get('/topmenu/edit/{id}','TopmenuController@edit');
    Route::get('/topmenu/delete/{id}','TopmenuController@destroy');
    Route::get('/topmenu','TopmenuController@index');
    Route::get('/topmenu/export/excel','TopmenuController@ExportExcel');
    Route::get('/topmenu/export/pdf','TopmenuController@ExportPDF');
    Route::post('/topmenu','TopmenuController@store');
    Route::post('/topmenu/ajax','TopmenuController@ajaxSave');
    Route::post('/topmenu/datatable/ajax','TopmenuController@datatable');
    Route::post('/topmenu/update/{id}','TopmenuController@update');
    //======================== Topmenu Route End ===============================//
    //======================== Fottermenu Route Start ===============================//
    Route::get('/fottermenu/list','FottermenuController@show');
    Route::get('/fottermenu/create','FottermenuController@create');
    Route::get('/fottermenu/edit/{id}','FottermenuController@edit');
    Route::get('/fottermenu/delete/{id}','FottermenuController@destroy');
    Route::get('/fottermenu','FottermenuController@index');
    Route::get('/fottermenu/export/excel','FottermenuController@ExportExcel');
    Route::get('/fottermenu/export/pdf','FottermenuController@ExportPDF');
    Route::post('/fottermenu','FottermenuController@store');
    Route::post('/fottermenu/ajax','FottermenuController@ajaxSave');
    Route::post('/fottermenu/datatable/ajax','FottermenuController@datatable');
    Route::post('/fottermenu/update/{id}','FottermenuController@update');
    //======================== Fottermenu Route End ===============================//
    //======================== Slider Route Start ===============================//
    Route::get('/slider/list','SliderController@show');
    Route::get('/slider/create','SliderController@create');
    Route::get('/slider/edit/{id}','SliderController@edit');
    Route::get('/slider/delete/{id}','SliderController@destroy');
    Route::get('/slider','SliderController@index');
    Route::get('/slider/export/excel','SliderController@ExportExcel');
    Route::get('/slider/export/pdf','SliderController@ExportPDF');
    Route::post('/slider','SliderController@store');
    Route::post('/slider/ajax','SliderController@ajaxSave');
    Route::post('/slider/datatable/ajax','SliderController@datatable');
    Route::post('/slider/update/{id}','SliderController@update');
    //======================== Slider Route End ===============================//
    //======================== Dreamcontent Route Start ===============================//
    Route::get('/dreamcontent/list','DreamcontentController@show');
    Route::get('/dreamcontent/create','DreamcontentController@create');
    Route::get('/dreamcontent/edit/{id}','DreamcontentController@edit');
    Route::get('/dreamcontent/delete/{id}','DreamcontentController@destroy');
    Route::get('/dreamcontent','DreamcontentController@index');
    Route::get('/dreamcontent/export/excel','DreamcontentController@ExportExcel');
    Route::get('/dreamcontent/export/pdf','DreamcontentController@ExportPDF');
    Route::post('/dreamcontent','DreamcontentController@store');
    Route::post('/dreamcontent/ajax','DreamcontentController@ajaxSave');
    Route::post('/dreamcontent/datatable/ajax','DreamcontentController@datatable');
    Route::post('/dreamcontent/update/{id}','DreamcontentController@update');
    //======================== Dreamcontent Route End ===============================//
    //======================== Videoscontent Route Start ===============================//
    Route::get('/videoscontent/list','VideoscontentController@show');
    Route::get('/videoscontent/create','VideoscontentController@create');
    Route::get('/videoscontent/edit/{id}','VideoscontentController@edit');
    Route::get('/videoscontent/delete/{id}','VideoscontentController@destroy');
    Route::get('/videoscontent','VideoscontentController@index');
    Route::get('/videoscontent/export/excel','VideoscontentController@ExportExcel');
    Route::get('/videoscontent/export/pdf','VideoscontentController@ExportPDF');
    Route::post('/videoscontent','VideoscontentController@store');
    Route::post('/videoscontent/ajax','VideoscontentController@ajaxSave');
    Route::post('/videoscontent/datatable/ajax','VideoscontentController@datatable');
    Route::post('/videoscontent/update/{id}','VideoscontentController@update');
    //======================== Videoscontent Route End ===============================//
    //======================== Exploreshelterinfo Route Start ===============================//
    Route::get('/exploreshelterinfo/list','ExploreshelterinfoController@show');
    Route::get('/exploreshelterinfo/create','ExploreshelterinfoController@create');
    Route::get('/exploreshelterinfo/edit/{id}','ExploreshelterinfoController@edit');
    Route::get('/exploreshelterinfo/delete/{id}','ExploreshelterinfoController@destroy');
    Route::get('/exploreshelterinfo','ExploreshelterinfoController@index');
    Route::get('/exploreshelterinfo/export/excel','ExploreshelterinfoController@ExportExcel');
    Route::get('/exploreshelterinfo/export/pdf','ExploreshelterinfoController@ExportPDF');
    Route::post('/exploreshelterinfo','ExploreshelterinfoController@store');
    Route::post('/exploreshelterinfo/ajax','ExploreshelterinfoController@ajaxSave');
    Route::post('/exploreshelterinfo/datatable/ajax','ExploreshelterinfoController@datatable');
    Route::post('/exploreshelterinfo/update/{id}','ExploreshelterinfoController@update');
    //======================== Exploreshelterinfo Route End ===============================//
    //======================== Shelterphoto Route Start ===============================//
    Route::get('/shelterphoto/list','ShelterphotoController@show');
    Route::get('/shelterphoto/create','ShelterphotoController@create');
    Route::get('/shelterphoto/edit/{id}','ShelterphotoController@edit');
    Route::get('/shelterphoto/delete/{id}','ShelterphotoController@destroy');
    Route::get('/shelterphoto','ShelterphotoController@index');
    Route::get('/shelterphoto/export/excel','ShelterphotoController@ExportExcel');
    Route::get('/shelterphoto/export/pdf','ShelterphotoController@ExportPDF');
    Route::post('/shelterphoto','ShelterphotoController@store');
    Route::post('/shelterphoto/ajax','ShelterphotoController@ajaxSave');
    Route::post('/shelterphoto/datatable/ajax','ShelterphotoController@datatable');
    Route::post('/shelterphoto/update/{id}','ShelterphotoController@update');
    //======================== Shelterphoto Route End ===============================//
    //======================== Peopleandstory Route Start ===============================//
    Route::get('/peopleandstory/list','PeopleandstoryController@show');
    Route::get('/peopleandstory/create','PeopleandstoryController@create');
    Route::get('/peopleandstory/edit/{id}','PeopleandstoryController@edit');
    Route::get('/peopleandstory/delete/{id}','PeopleandstoryController@destroy');
    Route::get('/peopleandstory','PeopleandstoryController@index');
    Route::get('/peopleandstory/export/excel','PeopleandstoryController@ExportExcel');
    Route::get('/peopleandstory/export/pdf','PeopleandstoryController@ExportPDF');
    Route::post('/peopleandstory','PeopleandstoryController@store');
    Route::post('/peopleandstory/ajax','PeopleandstoryController@ajaxSave');
    Route::post('/peopleandstory/datatable/ajax','PeopleandstoryController@datatable');
    Route::post('/peopleandstory/update/{id}','PeopleandstoryController@update');
    //======================== Peopleandstory Route End ===============================//
    //======================== Peoplefeedback Route Start ===============================//
    Route::get('/peoplefeedback/list','PeoplefeedbackController@show');
    Route::get('/peoplefeedback/create','PeoplefeedbackController@create');
    Route::get('/peoplefeedback/edit/{id}','PeoplefeedbackController@edit');
    Route::get('/peoplefeedback/delete/{id}','PeoplefeedbackController@destroy');
    Route::get('/peoplefeedback','PeoplefeedbackController@index');
    Route::get('/peoplefeedback/export/excel','PeoplefeedbackController@ExportExcel');
    Route::get('/peoplefeedback/export/pdf','PeoplefeedbackController@ExportPDF');
    Route::post('/peoplefeedback','PeoplefeedbackController@store');
    Route::post('/peoplefeedback/ajax','PeoplefeedbackController@ajaxSave');
    Route::post('/peoplefeedback/datatable/ajax','PeoplefeedbackController@datatable');
    Route::post('/peoplefeedback/update/{id}','PeoplefeedbackController@update');
    //======================== Peoplefeedback Route End ===============================//
    //======================== Roominfo Route Start ===============================//
    Route::get('/roominfo/list','RoominfoController@show');
    Route::get('/roominfo/create','RoominfoController@create');
    Route::get('/roominfo/edit/{id}','RoominfoController@edit');
    Route::get('/roominfo/delete/{id}','RoominfoController@destroy');
    Route::get('/roominfo','RoominfoController@index');
    Route::get('/roominfo/export/excel','RoominfoController@ExportExcel');
    Route::get('/roominfo/export/pdf','RoominfoController@ExportPDF');
    Route::post('/roominfo','RoominfoController@store');
    Route::post('/roominfo/ajax','RoominfoController@ajaxSave');
    Route::post('/roominfo/datatable/ajax','RoominfoController@datatable');
    Route::post('/roominfo/update/{id}','RoominfoController@update');
    //======================== Roominfo Route End ===============================//
    //======================== Roomdetail Route Start ===============================//
    Route::get('/roomdetail/list','RoomdetailController@show');
    Route::get('/roomdetail/create','RoomdetailController@create');
    Route::get('/roomdetail/edit/{id}','RoomdetailController@edit');
    Route::get('/roomdetail/delete/{id}','RoomdetailController@destroy');
    Route::get('/roomdetail','RoomdetailController@index');
    Route::get('/roomdetail/export/excel','RoomdetailController@ExportExcel');
    Route::get('/roomdetail/export/pdf','RoomdetailController@ExportPDF');
    Route::post('/roomdetail','RoomdetailController@store');
    Route::post('/roomdetail/ajax','RoomdetailController@ajaxSave');
    Route::post('/roomdetail/datatable/ajax','RoomdetailController@datatable');
    Route::post('/roomdetail/update/{id}','RoomdetailController@update');
    //======================== Roomdetail Route End ===============================//
    //======================== Fotterpagecontent Route Start ===============================//
    Route::get('/fotterpagecontent/list','FotterpagecontentController@show');
    Route::get('/fotterpagecontent/create','FotterpagecontentController@create');
    Route::get('/fotterpagecontent/edit/{id}','FotterpagecontentController@edit');
    Route::get('/fotterpagecontent/delete/{id}','FotterpagecontentController@destroy');
    Route::get('/fotterpagecontent','FotterpagecontentController@index');
    Route::get('/fotterpagecontent/export/excel','FotterpagecontentController@ExportExcel');
    Route::get('/fotterpagecontent/export/pdf','FotterpagecontentController@ExportPDF');
    Route::post('/fotterpagecontent','FotterpagecontentController@store');
    Route::post('/fotterpagecontent/ajax','FotterpagecontentController@ajaxSave');
    Route::post('/fotterpagecontent/datatable/ajax','FotterpagecontentController@datatable');
    Route::post('/fotterpagecontent/update/{id}','FotterpagecontentController@update');
    //======================== Fotterpagecontent Route End ===============================//

        
    //======================== Room Route Start ===============================//
    Route::get('/room/list','RoomController@show');
    Route::get('/room/create','RoomController@create');
    Route::get('/room/edit/{id}','RoomController@edit');
    Route::get('/room/delete/{id}','RoomController@destroy');
    Route::get('/room','RoomController@index');
    Route::get('/room/export/excel','RoomController@ExportExcel');
    Route::get('/room/export/pdf','RoomController@ExportPDF');
    Route::post('/room','RoomController@store');
    Route::post('/room/ajax','RoomController@ajaxSave');
    Route::post('/room/datatable/ajax','RoomController@datatable');
    Route::post('/room/update/{id}','RoomController@update');
    //======================== Room Route End ===============================//
    //======================== Bookingrequest Route Start ===============================//
    Route::get('/payment/log','BookingrequestController@paymentLog');
    Route::get('/bookingrequest/list','BookingrequestController@show');
    Route::get('/bookingrequest/create','BookingrequestController@create');
    Route::get('/bookingrequest/edit/{id}','BookingrequestController@edit');
    Route::get('/bookingrequest/takepayment/{id}','BookingrequestController@takepayment');
    Route::get('/bookingrequest/void/{id}','BookingrequestController@voidPayment');
    Route::get('/bookingrequest/delete/{id}','BookingrequestController@destroy');
    Route::get('/bookingrequest','BookingrequestController@index');
    Route::post('/bookingrequest/capture/payment','BookingrequestController@capturePayment');
    Route::post('/rentalbooking/capture/payment','BookingrequestController@RentalBookingcapturePayment');
    Route::get('/bookingrequest/export/excel','BookingrequestController@ExportExcel');
    Route::get('/bookingrequest/export/pdf','BookingrequestController@ExportPDF');
    Route::post('/bookingrequest','BookingrequestController@store');
    Route::post('/bookingrequest/ajax','BookingrequestController@ajaxSave');
    Route::post('/bookingrequest/datatable/ajax','BookingrequestController@datatable');
    Route::post('/bookingrequest/update/{id}','BookingrequestController@update');
    //======================== Bookingrequest Route End ===============================//
    //======================== Bookingconfiguration Route Start ===============================//
    Route::get('/bookingconfiguration/list','BookingconfigurationController@show');
    Route::get('/bookingconfiguration/create','BookingconfigurationController@create');
    Route::get('/bookingconfiguration/edit/{id}','BookingconfigurationController@edit');
    Route::get('/bookingconfiguration/delete/{id}','BookingconfigurationController@destroy');
    Route::get('/bookingconfiguration','BookingconfigurationController@index');
    Route::get('/bookingconfiguration/export/excel','BookingconfigurationController@ExportExcel');
    Route::get('/bookingconfiguration/export/pdf','BookingconfigurationController@ExportPDF');
    Route::post('/bookingconfiguration','BookingconfigurationController@store');
    Route::post('/bookingconfiguration/ajax','BookingconfigurationController@ajaxSave');
    Route::post('/bookingconfiguration/datatable/ajax','BookingconfigurationController@datatable');
    Route::post('/bookingconfiguration/update/{id}','BookingconfigurationController@update');
    //======================== Bookingconfiguration Route End ===============================//

    
    //======================== Cardpointestoresetting Route Start ===============================//
    Route::get('/cardpointestoresetting/list','CardpointestoresettingController@show');
    Route::get('/cardpointestoresetting/create','CardpointestoresettingController@create');
    Route::get('/cardpointestoresetting/edit/{id}','CardpointestoresettingController@edit');
    Route::get('/cardpointestoresetting/delete/{id}','CardpointestoresettingController@destroy');
    Route::get('/cardpointestoresetting','CardpointestoresettingController@index');
    Route::get('/cardpointestoresetting/export/excel','CardpointestoresettingController@ExportExcel');
    Route::get('/cardpointestoresetting/export/pdf','CardpointestoresettingController@ExportPDF');
    Route::post('/cardpointestoresetting','CardpointestoresettingController@store');
    Route::post('/cardpointestoresetting/ajax','CardpointestoresettingController@ajaxSave');
    Route::post('/cardpointestoresetting/datatable/ajax','CardpointestoresettingController@datatable');
    Route::post('/cardpointestoresetting/update/{id}','CardpointestoresettingController@update');
    //======================== Cardpointestoresetting Route End ===============================//
    //======================== Cardpointestoresetting Route Start ===============================//
    Route::get('/cardpointestoresetting/list','CardpointestoresettingController@show');
    Route::get('/cardpointestoresetting/create','CardpointestoresettingController@create');
    Route::get('/cardpointestoresetting/edit/{id}','CardpointestoresettingController@edit');
    Route::get('/cardpointestoresetting/delete/{id}','CardpointestoresettingController@destroy');
    Route::get('/cardpointestoresetting','CardpointestoresettingController@index');
    Route::get('/cardpointestoresetting/export/excel','CardpointestoresettingController@ExportExcel');
    Route::get('/cardpointestoresetting/export/pdf','CardpointestoresettingController@ExportPDF');
    Route::post('/cardpointestoresetting','CardpointestoresettingController@store');
    Route::post('/cardpointestoresetting/ajax','CardpointestoresettingController@ajaxSave');
    Route::post('/cardpointestoresetting/datatable/ajax','CardpointestoresettingController@datatable');
    Route::post('/cardpointestoresetting/update/{id}','CardpointestoresettingController@update');
    //======================== Cardpointestoresetting Route End ===============================//

    //======================== Rentalservice Route Start ===============================//
    Route::get('/rentalservice/list','RentalserviceController@show');
    Route::get('/rentalservice/create','RentalserviceController@create');
    Route::get('/rentalservice/edit/{id}','RentalserviceController@edit');
    Route::get('/rentalservice/delete/{id}','RentalserviceController@destroy');
    Route::get('/rentalservice','RentalserviceController@index');
    Route::get('/rentalservice/export/excel','RentalserviceController@ExportExcel');
    Route::get('/rentalservice/export/pdf','RentalserviceController@ExportPDF');
    Route::post('/rentalservice','RentalserviceController@store');
    Route::post('/rentalservice/ajax','RentalserviceController@ajaxSave');
    Route::post('/rentalservice/datatable/ajax','RentalserviceController@datatable');
    Route::post('/rentalservice/update/{id}','RentalserviceController@update');
    //======================== Rentalservice Route End ===============================//

});



//======================== Rentalbooking Route Start ===============================//
Route::get('/rentalbooking/list','RentalbookingController@show');
Route::get('/rentalbooking/create','RentalbookingController@create');
Route::get('/rentalbooking/edit/{id}','RentalbookingController@edit');
Route::get('/rentalbooking/delete/{id}','RentalbookingController@destroy');
Route::get('/rentalbooking','RentalbookingController@index');
Route::get('/rentalbooking/export/excel','RentalbookingController@ExportExcel');
Route::get('/rentalbooking/export/pdf','RentalbookingController@ExportPDF');
Route::post('/rentalbooking','RentalbookingController@store');
Route::post('/rentalbooking/ajax','RentalbookingController@ajaxSave');
Route::post('/rentalbooking/datatable/ajax','RentalbookingController@datatable');
Route::post('/rentalbooking/update/{id}','RentalbookingController@update');
//======================== Rentalbooking Route End ===============================//
