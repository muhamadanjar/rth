<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('dashboard', ['middleware' => 'auth','uses' => 'PagesController@dashboard']);
/* Map */
Route::get('map','MapController@index');
Route::get('viewer','MapController@viewer');
Route::get('mapeditor','MapController@mapeditor');
Route::get('edat','MapController@edat');
Route::get('map-user','MapController@vieweruser');

Route::get('form-capture', 'PagesController@formCapture');
Route::get('form-capture-{objectid}-{rth}', 'MapController@formCaptureGet');
Route::post('imagestring', 'MapController@imagestring');
Route::post('editGeotagFoto', 'MapController@editGeotagFoto');
Route::post('editGeotagFotoPrivate', 'MapController@editGeotagFotoPrivate');


Route::get('raw','MapController@LayerUser');
Route::get('jsonfield-{id}-{idx}','LayerController@getfields');
Route::get('DMS2Decimal-{degrees}-{minutes}-{seconds}-{direction}','LayerController@DMS2Decimal');
//x 106.81682586111 y -6.5941581666667
Route::get('getfieldInfos','LayerController@getfieldInfos');

/* Layer */
Route::get('layer','LayerController@viewAllLayer');
Route::get('layer-new-layer', 'LayerController@createNewLayer');
Route::post('layer-new-layer', 'LayerController@create');

Route::get('layer/edit/{id}', 'LayerController@editExistingLayer');
Route::post('layer/edit/{id}', 'LayerController@edit');

Route::get('layer/delete/{id}', 'LayerController@delete');

Route::get('layer/create-new-post/success','LayerController@createSuccess');
Route::get('layer/manage-existing-layer/delete/{id}/success','LayerController@deleteSuccess');
Route::get('layer/manage-existing-layer/edit/{id}/success','LayerController@editSuccess');

Route::get('layerinfo/{id}','LayerController@showFormLayerInfo');
Route::get('layerinfoftr/{id}-{idx}-{layern}','LayerController@showFormLayerInfoPopUp');
Route::post('layerinfoftr/{id}-{idx}-{layern}','LayerController@postFormLayerInfoPopUpCr');

Route::get('layerinfo-sm', 'LayerController@showFormMedia');
Route::post('layerinfosm', 'LayerController@ajaxmedia');
Route::get('rolelayer','LayerController@rolelayer');

Route::get('bookmark','BookmarkController@viewAllBookmark');
Route::get('bookmark-new-bookmark', 'BookmarkController@createNewBookmark');
Route::post('bookmark-new-bookmark', 'BookmarkController@create');

Route::get('bookmark/edit/{id}', 'BookmarkController@editExistingBookmark');
Route::post('bookmark/edit/{id}', 'BookmarkController@edit');

Route::get('bookmark/create-new-bookmark/success','BookmarkController@createSuccess');
Route::get('bookmark/manage-existing-bookmark/delete/{id}/success','BookmarkController@deleteSuccess');
Route::get('bookmark/manage-existing-bookmark/edit/{id}/success','BookmarkController@editSuccess');


Route::get('video','HomeController@video');

Route::get('user','UserController@manageExisting');
Route::get('user/edit/{id}', 'UserController@editExisting');
Route::post('user/edit/{id}', 'UserController@edit');
Route::get('user/delete/{id}', 'UserController@delete');
Route::get('user-new-user', 'UserController@createNew');
Route::post('user-new-user', 'UserController@create');

Route::get('user/create-new-user/success','UserController@createSuccess');
Route::get('user/manage-existing-user/edit/{id}/success','UserController@editSuccess');
Route::get('user/manage-existing-user/delete/{id}/success','UserController@deleteSuccess');


/* Setting Web */
Route::get('setting-ganti-host', 'SettingController@gantihost');
Route::post('setting-ganti-host', 'SettingController@gantihostPost');

/* RTH */

Route::get('rth-informasi','RTHCtrl@RTHInformasi');
Route::get('rth-form-query','RTHCtrl@RTHFormQuery');
Route::post('rth-form-query','RTHCtrl@RTHFormQueryPost');

/*Route::get('rth-titik-list', 'Master@MasterTRTHPKOTBOGOR');
Route::get('rth-titik-add', 'Master@MasterAddTRTHPKOTBOGOR');
Route::get('rth-titik-edit-{id}', 'Master@MasterEditTRTHPKOTBOGOR');
Route::get('rth-titik-delete-{id}', 'Master@MasterDeleteTRTHPKOTBOGOR');*/
Route::get('rth-titik-add','RTHCtrl@TitikAdd');
Route::get('rth-titik-list','RTHCtrl@TitikList');
Route::get('rth-titik-edit-{id}','RTHCtrl@TitikEdit');
Route::post('rth-titik-edit-{id}','RTHCtrl@TitikEditPost');
Route::get('rth-titik-delete-{id}', 'RTHCtrl@TitikDelete');

Route::get('rth-titikprivat-add','RTHCtrl@TitikPrivatAdd');
Route::get('rth-titikprivat-list','RTHCtrl@TitikPrivatList');
Route::get('rth-titikprivat-edit-{id}','RTHCtrl@TitikPrivatEdit');
Route::post('rth-titikprivat-edit-{id}','RTHCtrl@TitikPrivatEditPost');
Route::get('rth-titikprivat-delete-{id}', 'RTHCtrl@TitikPrivatDelete');


Route::get('report-rth-titik','ReportCtrl@ReportForm');
Route::post('report-rth-titik','ReportCtrl@ReportFormPost');
Route::get('report-rth-titik-excel-{namafile}','ReportCtrl@ReportExcel');
Route::get('report-rth-titik-grafikhc','ReportCtrl@ReportGrafikHC');
Route::post('report-rth-titik-grafikhc','ReportCtrl@ReportGrafikHCPost');


Route::get('cauth/login', 'CustomAuthController@getLogin');   
Route::post('cauth/login', 'CustomAuthController@postLogin');
Route::get('login/editor', 'CustomAuthController@getLoginEditor');   
Route::post('login/editor', 'CustomAuthController@postLoginEditor');
Route::get('cauth/logout', 'CustomAuthController@getLogout');

Route::get('login', function(){
	return Redirect::to('login/editor');
}); 


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

