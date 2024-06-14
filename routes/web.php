<?php

use App\Http\Controllers\Admin\AdminClassesController;
use App\Http\Controllers\Admin\AdminPagesController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Admin\AdminSubjectsController;
use App\Http\Controllers\Admin\AdminQuestionTypeController;
use App\Http\Controllers\Admin\ExaminationTypeController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\DownloadResourceController;
use App\Http\Controllers\ExamCategroyController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HomePagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\USSD\UssdMachineController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\Caster\ResourceCaster;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(UssdMachineController::class)->group(function () {
    Route::post('/ussd-api', 'startUSSD');
});


Route::middleware(['visitor'])->group(function () {
    Route::controller(HomePagesController::class)->group(function () {
        Route::get('/', 'index')->name('homepage');
        Route::get('/libraries', 'libraries')->name('libraries');
        Route::get('/lessons', 'lessons')->name('lesson');
        Route::get('/answer-libraries', 'answerLibraries')->name('answer-libraries');
        Route::get('/all-subjects', 'allSubjects')->name('subjects-all');
        Route::get('/{id}/pasco-all', 'viewSubjectPasco')->name('view-subject-pasco');
        Route::get('/{id}/answers-all', 'viewAnswerPasco')->name('view-answer-all');

        Route::get('/{slug}/{id}/view-library', 'viewExamLibrary')->name('view-exams-library');
        Route::get('/exams/{examType}/content', 'fetchContent')->name('exams.content');
        Route::get('/subjects/all', 'fetchAllSubjects')->name('exams.content');

        Route::get('/pasco/{examType}/answers', 'fetchContentAnswer')->name('exams.content');
        Route::get('/answers/all', 'fetchAllAnswer')->name('exams.content');


        Route::get('/download/step-one/{resource}', 'submitNumber')->name('submit.phone');
        Route::get('/download/step-two/{student}/{token}', 'submitOtherDetails')->name('submit.details');
        Route::get('/download/preview/{student}/{token}', 'downloadPreview')->name('preview.download');
    });

    Route::controller(FilterController::class)->group(function () {
        Route::get('/load-initial-resources', 'fetchFilteredResources')->name('load-initial-resources');
        Route::get('/filter-resources', 'filterResources')->name('filter-resources');

        Route::get('/load-initial-answers', 'fetchFilteredAnswer')->name('load-initial-resources');
        Route::get('/filter-answers', 'filterAnswer')->name('filter-resources');
    });

    Route::controller(DownloadResourceController::class)->group(function () {
        Route::post('/save-phone-number', 'savePhoneNumber')->name('save-phone-number');
        Route::post('/save-student-details', 'saveStudentDetails')->name('save-student-detials');
        Route::post('/sms-requested', 'smsRequestSent')->name('sms-student-request');

        Route::get('/download-resource/{token}', 'verifyLink')->name('verify-token');

        //view answer routes
        Route::get('/view-answer/{id}', 'viewAnswerStudent')->name('view-answer');
    });
});

Route::middleware('auth', 'verified')->group(function () {
    Route::middleware('verified')->group(function () {

        Route::controller(AdminPagesController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/classes', 'levels')->name('levels.index');
            Route::get('/programs', 'programs')->name('programs.index');
            Route::get('/subjects', 'subjects')->name('subjects.index');
            Route::get('/exams-types', 'examsTypes')->name('exams.index');
            Route::get('/exams-category', 'examsCategory')->name('category.index');
            Route::get('/users-view-all', 'viewUsers')->name('users.index');

            Route::post('/update-timezone', 'getUserTimezone')->name('get-user-timezone');
        });

        Route::controller(ExaminationTypeController::class)->group(function () {
            Route::get('/exams-types-create', 'create')->name('exams.create');
            Route::post('/exams-types/store', 'store')->name('exams.store');
            Route::get('/exams/{examType}/edit', 'edit')->name('exams.edit');
            Route::put('/exams/{examType}', 'update')->name('exams.update');

            Route::delete('/exams/{examType}', 'destroy')->name('exams.destroy');
        });

        Route::controller(ExamCategroyController::class)->group(function () {
            Route::get('/category-types-create', 'create')->name('category.create');
            Route::post('/category-types/store', 'store')->name('category.store');
            Route::get('/category/{examCat}/edit', 'edit')->name('category.edit');
            Route::put('/category/{examCat}', 'update')->name('category.update');

            Route::delete('/category/{examCat}', 'destroy')->name('category.destroy');
            Route::get('/get-examtypes', 'getExamType')->name('get-courses');
        });

        Route::controller(AdminClassesController::class)->group(function () {
            Route::get('/level-create', 'create')->name('levels.create');
            Route::post('/level/store', 'store')->name('levels.store');
            Route::get('/level/{level}/edit', 'edit')->name('levels.edit');
            Route::put('/level/{level}/update', 'update')->name('levels.update');

            Route::delete('/level/{level}destory', 'destroy')->name('levels.destroy');
        });


        Route::controller(AdminSubjectsController::class)->group(function () {
            Route::get('/subject-create', 'create')->name('subjects.create');
            Route::post('/subject/store', 'store')->name('subjects.store');
            Route::get('/subject/{subject}/edit', 'edit')->name('subjects.edit');
            Route::put('/subject/{subject}/update', 'update')->name('subjects.update');

            Route::delete('/subject/{subject}destory', 'destroy')->name('subjects.destroy');
        });

        Route::controller(AdminProgramController::class)->group(function () {
            Route::get('/program-create', 'create')->name('programs.create');
            Route::post('/program/store', 'store')->name('programs.store');
            Route::get('/program/{program}/edit', 'edit')->name('programs.edit');
            Route::put('/program/{program}/update', 'update')->name('programs.update');

            Route::delete('/program/{program}destory', 'destroy')->name('programs.destroy');

            Route::get('/get-programs', 'getPrograms')->name('get-programs');
        });

        Route::controller(ResourceController::class)->group(function () {
            Route::get('/view_resources', 'index')->name('view-resources');
            Route::get('/resources_create', 'create')->name('resoures.create');
            Route::post('/resources_create', 'storeResource')->name('resoures.store');
            Route::get('/get-subjects', 'getCourses')->name('get-courses');
            Route::get('/get-categories', 'getCategory')->name('get-categories');

            Route::get('/resoures/{resource}/edit', 'edit')->name('resoures.edit');
            Route::put('/resoures/{resource}', 'update')->name('resoures.update');

            Route::delete('/resoures/{resource}', 'destroy')->name('resoures.destroy');
        });

        Route::controller(AdminQuestionTypeController::class)->group(function () {
            Route::get('/question-type-view', 'index')->name('question_type');
            Route::get('/question-type-create', 'create')->name('question_type.create');
            Route::post('/question-type/store', 'store')->name('question_type.store');
            Route::get('/question-type/{QuestionType}/edit', 'edit')->name('question_type.edit');
            Route::put('/question-type/{QuestionType}/update', 'update')->name('question_type.update');

            Route::delete('/question-type/{QuestionType}destory', 'destroy')->name('question_type.destroy');
        });

        Route::controller(AdminStudentController::class)->group(function () {
            Route::get('/students', 'index')->name('students');
            Route::get('/students/create', 'create')->name('students.create');
        });
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});



require __DIR__ . '/auth.php';
