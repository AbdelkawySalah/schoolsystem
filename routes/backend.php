<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// use App\Http\Controllers\authController;
// use App\Http\Controllers\adminController;
//  use App\Http\Controllers\adminController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use App\Http\Controllers\Classrooms\ClassroomController;
// use App\Http\Controllers\Students\StudentController;
Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
	], function(){
		 
		Route::get('/dashboard', function () {
			return view('dashboard');
		})->name('dashboard');

		Route::group(['namespace'=>'Grades'],function(){
			Route::resource('Grades',GradesController::class);
		});

		Route::group(['namespace'=>'Classrooms'],function(){
			 Route::resource('Classroom',ClassroomController::class);
			 Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
			 Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');

		});

		Route::group(['namespace'=>'Sections'],function(){
			Route::resource('Sections',SectionsController::class);
			//Route::get('/classes/{id}', [SectionController::class,"getclasses"]);
			Route::get('/classes/{id}', 'SectionsController@getclasses');

	 	});


		 Route::view('add_parent','livewire.show_Form')->name('add_parent');
		 Route::get('test',function(){
             return view('dashboard/test');
	});

     //Teachers Root
	 Route::group(['namespace'=>'Teachers'],function(){
		Route::resource('Teacher',TeacherController::class);
	

	 });
     
	//  //Students Root
	 Route::group(['namespace'=>'Students'],function(){
		Route::resource('Student',StudentController::class);
		 Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
		Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
		Route::get('Download_attachment/{studentname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
		Route::get('view_attachment/{studentname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
		Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
		Route::resource('Promotion',PromotionController::class);
		Route::resource('Graduated',GraduatedController::class);
		Route::resource('Fees',FeesController::class);
		Route::resource('FeesType',FeesTypeController::class);
		Route::resource('Fees_Invoices',FeesInvoicesController::class);
		Route::resource('receipt_students',ReceiptStudentsController::class);
		Route::resource('ProcessingFee',ProcessingFeeController::class);


	});
	###########################################################################
	
	
		#################################Fees Route ##########################################



});



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

/*Route::get('/', function () {
    return view('empty');
});
*/

Route::group(
	[
		'prefix' => LaravelLocalization::setLocale(),
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
	], function(){
		 
		// Route::get('dashboard',[adminController::class,"index"]);

		Route::group(['namespace'=>'Grades'],function(){
			Route::resource('Grades',GradesController::class);
		});

		Route::group(['namespace'=>'Classrooms'],function(){
			Route::resource('Classroom',ClassroomController::class);
			//Route::post('delete_all',[ClassroomController::class,'delete_all'])->name('delete_all');
			 //Route::post('Filter_Classes',[ClassroomController::class,'Filter_Classes'])->name('Filter_Classes');

			 Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
			 Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');

		});

		Route::group(['namespace'=>'Sections'],function(){
			Route::resource('Sections',SectionsController::class);
			//Route::get('/classes/{id}', [SectionController::class,"getclasses"]);
			Route::get('/classes/{id}', 'SectionsController@getclasses');

	 	});
		 Route::group(['namespace'=>'Classrooms'],function(){
			Route::resource('Classroom',ClassroomController::class);
			//Route::post('delete_all',[ClassroomController::class,'delete_all'])->name('delete_all');
			 //Route::post('Filter_Classes',[ClassroomController::class,'Filter_Classes'])->name('Filter_Classes');
		
			 Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
			 Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
		
		});

		 Route::view('add_parent','livewire.show_Form')->name('add_parent');
		 Route::get('test',function(){
             return view('dashboard/test');
	});

     //Teachers Root
	 Route::group(['namespace'=>'Teachers'],function(){
		Route::resource('Teacheers',TeacherController::class);
	

	 });
     
	//  //Students Root
	 Route::group(['namespace'=>'Students'],function(){
		Route::resource('Student',StudentController::class);
		 Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
		Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
		Route::get('Download_attachment/{studentname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
		Route::get('view_attachment/{studentname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
		Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
	});
	###########################################################################
	Route::group(['namespace'=>'Students'],function(){
		Route::resource('Promotion',PromotionController::class);
	});



/*
/*
//Route::group(['prefix' => LaravelLocalization::setLocale()], function()
//{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	////	Route::get('/', function()
	//	{
		//		return View('empty');
		//	});

		//});*/

		// Route::get('/', [authController::class,"login"]);

	// //for user not logined
	// Route::group(['middleware'=>['guest']],function(){
	//      Route::get('/',[authController::class,"login"]);
	// 	});


	// 	Route::get('/register',[authController::class,"register"]);
	// 	Route::post('/postregister',[authController::class,"postregister"]);

	// 	Route::get('/logout',[authController::class,"logout"]);
	});