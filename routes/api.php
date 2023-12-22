<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LawController;
use App\Http\Controllers\FileLawController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\ProdiaLinkController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\OfficialDocumentController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\OfficialDocumentPublishController;
use App\Http\Controllers\OfficialDocumentArchiveController;
use App\Http\Controllers\OfficialDocumentReplyController;
use App\Http\Controllers\AllchatController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\PatientController;

use App\Http\Controllers\CompanyController;

use App\Http\Controllers\OrientationFileController;
use App\Http\Controllers\OrientationFilePermissionController;


use App\Http\Controllers\LogisticController;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\Events\StatusRequest;
use App\Events\FireMajorMessage;
use App\Events\FireMinorMessage;
use App\Events\FireAllchatMessage;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

///////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                               Justice                                                 //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
///////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('/strafregister')->group(function () {
    Route::prefix('/files')->controller(FileController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/id/{id}', 'getid')->middleware('auth:sanctum');
        Route::post('/create', 'store')->middleware('auth:sanctum');
    });

    Route::prefix('/company')->controller(CompanyController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'id');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('')->controller(LoginController::class)->group(function () {
        Route::post('login', 'login');
        Route::get('auth', 'checkAuth')->middleware('auth:sanctum');
        Route::get('logout', 'logout')->middleware('auth:sanctum');
        Route::get('secure', 'secureSite')->middleware('auth:sanctum');
        Route::get('getPermissions', 'getRestrictionClass')->middleware('auth:sanctum');
        Route::post('register', 'register')->middleware('auth:sanctum');
        Route::get('switchActive/{id}', 'switchActive')->middleware('auth:sanctum');
        Route::get('checkDepartment/{department}', 'checkDepartment')->middleware('auth:sanctum');
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        $user = $request->user();
        // returne die user resource
        return new \App\Http\Resources\UserResource($user);
    });


    Route::prefix('/files')->controller(FileController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/id/{id}', 'getid')->middleware('auth:sanctum');
        Route::post('/create', 'store')->middleware('auth:sanctum');
    });

    Route::prefix('/entries')->controller(EntryController::class)->group(function () {
        Route::get('/index', 'index')->middleware('auth:sanctum');
        Route::get('/index/{id}', 'id')->middleware('auth:sanctum');
        Route::post('/switchWanted/{id}', 'changeWanted')->middleware('auth:sanctum');
        Route::post('/create', 'store');
        Route::put('/{id}', 'App\Http\Controllers\EntryController@update');
        Route::delete('/{id}', 'App\Http\Controllers\EntryController@destroy');
        Route::get('/onlyEntry', 'onlyEntry')->middleware('auth:sanctum');
    });

    Route::prefix('/law')->controller(LawController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'id');
        Route::post('/', 'App\Http\Controllers\LawController@store');
        Route::put('/{id}', 'App\Http\Controllers\LawController@update');
        Route::delete('/{id}', 'App\Http\Controllers\LawController@destroy');
    });

    Route::prefix('/filelaw')->controller(FileLawController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'id');
        Route::post('/', 'store');
        Route::put('/{id}', 'App\Http\Controllers\FileLawController@update');
        Route::delete('/{id}', 'App\Http\Controllers\FileLawController@destroy');
    });

    Route::prefix('/case')->controller(CaseController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'id');
        Route::post('/', 'App\Http\Controllers\CaseController@store');
        Route::put('/{id}', 'App\Http\Controllers\CaseController@update');
        Route::delete('/{id}', 'App\Http\Controllers\CaseController@destroy');
    });

    Route::prefix('members')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
        Route::get('/{id}', 'id')->middleware('auth:sanctum');
        Route::put('/', 'update')->middleware('auth:sanctum');
        Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy');
    });

    Route::prefix('/ranks')->controller(RankController::class)->group(function () {
        Route::get('/', 'index');
    });

    Route::prefix('/discord')->group(function () {

        Route::get('/discord/{discordid}', function (Request $request, $discordid) {
            $user = \App\Models\User::where('discord', $discordid)->first();
            return response()->json(['message' => $user], 200);
        })->middleware('discord.bot');

        Route::get('/files/{entryid}', function (Request $request, $entryid) {
            #benutze die FileResource
            $files = \App\Http\Resources\FileResource::collection(\App\Models\File::where('entry_id', $entryid)->get());
            return response()->json(['message' => $files], 200);
        })->middleware('discord.bot');

        Route::get('/file/{fileid}', function (Request $request, $fileid) {
            #benutze die FileResource
            $file = \App\Http\Resources\FileResource::collection(\App\Models\File::where('id', $fileid)->get());
            return response()->json(['message' => $file], 200);
        })->middleware('discord.bot');

        Route::get('/test', function (Request $request) {

        return response()->json(['message' => 'Passed'], 200);
        })->middleware('discord.bot');

        Route::get('/ranks', function (Request $request) {
            $ranks = \App\Models\Rank::all();
            return response()->json(['message' => $ranks], 200);
        })->middleware('discord.bot');

        Route::get('/entries', function (Request $request) {
            $entries = \App\Models\Entry::all();
            $data = [];
            foreach ($entries as $entry) {
                $data[] = [
                    'entry' => $entry,
                    'filesCount' => $entry->files->count(),
                ];
            
            }
            return response()->json(['message' => $data], 200);
        })->middleware('discord.bot');

        #Erstelle die Route /discordUser die alle User zurückgibt deren discord nicht null ist
        Route::get('/discordUser', function (Request $request) {
            #benutze die UserResource
            $users = \App\Http\Resources\UserResource::collection(\App\Models\User::whereNotNull('discord')->get());
            return response()->json(['message' => $users], 200);
        })->middleware('discord.bot');
    });

    Route::prefix('/prodia')->controller(ProdiaLinkController::class)->group(function () {
        Route::post('/generate', 'generate');
        Route::post('/job', 'job');
        Route::get('/job', 'job');
    });

    Route::prefix('/publish')->controller(PublishController::class)->group(function () {
        Route::prefix('/case')->group(function () {
            Route::get('/route/{route}', 'id');
            Route::get('/id/{id}', 'create')->middleware('auth:sanctum');
            Route::delete('/id/{id}', 'destroy')->middleware('auth:sanctum');
        });
        Route::get('/', 'index');
    });

    Route::prefix('/odt')->controller(OfficialDocumentController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
        Route::get('/{id}', 'id');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('/odtreply')->controller(OfficialDocumentReplyController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
        Route::get('/{id}', 'id');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('/odtarchive')->controller(OfficialDocumentArchiveController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
        Route::get('/{id}', 'id');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('/event')->group(function () {
        Route::get('/test', function (Request $request) {
            #Bananen sind schön
            event(new StatusRequest('Hello World!'));
            return response()->json(['message' => 'Event fired'], 200);
        });
        Route::post('/minor', function (Request $request) {
            event(new FireMinorMessage($request->message));
            return response()->json(['message' => 'Event fired'], 200);
        });
        Route::post('/major', function (Request $request) {
            event(new FireMajorMessage($request->message));
            return response()->json(['message' => 'Event fired'], 200);
        });
    });

    Route::prefix('/institution')->controller(InstitutionController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'id');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('/allchat')->controller(AllchatController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
        Route::get('/{from}', 'range')->middleware('auth:sanctum');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

});

Route::prefix('/logistic')->controller(LogisticController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'id')->middleware('auth:sanctum');
    Route::post('/', 'store')->middleware('auth:sanctum');
    Route::put('/{id}', 'update')->middleware('auth:sanctum');
    Route::delete('/{id}', 'destroy')->middleware('auth:sanctum');
});

///////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                               Health                                                  //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
///////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('/health')->group(function () {

    Route::prefix('/patient')->controller(PatientController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'id');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('')->controller(HealthController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'id');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});

///////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                         Orientations                                                  //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
///////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('/orientations')->group(function () {

    Route::prefix('')->controller(OrientationFileController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
        Route::get('/permitted', 'get_permittet_files')->middleware('auth:sanctum');
        Route::get('/{id}', 'id')->middleware('auth:sanctum');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::put('/{id}', 'update')->middleware('auth:sanctum');
        Route::delete('/{id}', 'destroy')->middleware('auth:sanctum');
    });
    
    Route::prefix('/permission')->controller(OrientationFilePermissionController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:sanctum');
        Route::get('/{id}', 'id')->middleware('auth:sanctum');
        Route::get('/user/{id}', 'get_all_by_user_id')->middleware('auth:sanctum');
        Route::get('/orientation_file/{id}', 'get_all_by_orientation_file_id')->middleware('auth:sanctum');
        Route::post('/', 'store')->middleware('auth:sanctum');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy')->middleware('auth:sanctum');
    });

});


///////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                 GMod                                                  //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
//                                                                                                       //
///////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('/gmod')->group(function () {
    Route::get('/iswanted/{name}', function (Request $request, $name) {
        $entry = \App\Models\Entry::where('identification', 'like', '%' . $name . '%')->first();
        if ($entry) {
            $builder = [
                'message' => 'The Subject is wanted!',
                'identification' => $entry->identification,
                'filesCount' => $entry->files->count(),
                'isWanted' => $entry->isWanted,
            ];
            return response()->json(['data' => $builder], 200);
        } else {
            return response()->json(['message' => 'No entry found.'], 404);
        }
    });
});