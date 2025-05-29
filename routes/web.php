<?php

use App\Http\Controllers\AcademicController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Settings\CitizenshipController;
use App\Http\Controllers\Settings\CountryController;
use App\Http\Controllers\Settings\CurrencyController;
use App\Http\Controllers\Settings\EducationCostController;
use App\Http\Controllers\Settings\EducationLanguageController;
use App\Http\Controllers\Settings\EducationLevelController;
use App\Http\Controllers\Settings\ExamController;
use App\Http\Controllers\Settings\ExamLanguageController;
use App\Http\Controllers\Settings\PeriodController;
use App\Http\Controllers\Settings\ProfessionController;
use App\Http\Controllers\Settings\ProgramStatusController;
use App\Http\Controllers\Settings\SchoolTypeController;
use App\Http\Controllers\Settings\SettingDocumentController;
use App\Http\Controllers\Settings\TownController;
use App\Http\Controllers\Settings\UniversityEducationLevelController;
use App\Http\Controllers\Settings\UniversityListController;
use App\Http\Controllers\Settings\UniversitySchoolTypeController;
use App\Http\Controllers\Student\ContractController;
use App\Http\Controllers\Student\DocumentController;
use App\Http\Controllers\Student\EducationController;
use App\Http\Controllers\Student\ProgramController;
use App\Http\Controllers\Student\StudentLanguageController;
use App\Http\Controllers\Student\StudentServiceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UserController;
use App\Models\Settings\ExamLanguage;
use App\Models\Settings\Profession;
use App\Models\Settings\SchoolType;
use App\Models\Settings\UniversitySchoolType;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_submit', [AuthController::class, 'login_submit'])->name('login_submit');

Route::group(['middleware' => 'auth'], function (): void {
    Route::get('student', [StudentController::class, 'single_student'])->name('single_student');
    Route::get('agent_students', [AgentController::class, 'agent_students'])->name('agent_students');
    Route::get('single_agent_student/{id}', [AgentController::class, 'student_single'])->name('single_agent_student');
    Route::patch('/agents/{id}/pin', [AgentController::class, 'pinAgent'])->name('agents.pin');
    Route::post('/profile/upload-image', [UserController::class, 'uploadImage'])->name('profile.uploadImage');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('universities', UniversityController::class);

    Route::get('/', [AuthController::class, 'home'])->name('home');

    Route::resource('users', UserController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('students', StudentController::class);
    Route::resource('academics', AcademicController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('notifications', NotificationController::class);
    Route::post('/notifications/mark-read', [NotificationController::class, 'markRead'])->name('notifications.markRead');

    Route::resource('setting_documents', SettingDocumentController::class);

    Route::resource('services', ServiceController::class);
    Route::get('student-service/index/{student_id}', [StudentServiceController::class, 'index'])->name('student.service.index');
    Route::post('addServices/{user}', [StudentServiceController::class, 'addServices'])->name('student.addService');
    Route::post('addCosts/{user}', [StudentController::class, 'addCosts'])->name('student.addCosts');
    Route::post('/user/{user}/toggle-status', [StudentController::class, 'toggleStatus'])->name('user.toggleStatus');
    Route::get('university', [UniversityController::class, 'university'])->name('university');

    Route::resource('school_types', SchoolTypeController::class);
    Route::resource('periods', PeriodController::class);
    Route::resource('program_statuses', ProgramStatusController::class);
    Route::post('toggle-period-status/{id}', [PeriodController::class, 'togglePeriodStatus'])->name('toggle.period.status');
    Route::resource('education_levels', EducationLevelController::class);
    Route::resource('university_education_levels', UniversityEducationLevelController::class);
    Route::resource('university_school_types', UniversitySchoolTypeController::class);
    Route::resource('professions', ProfessionController::class);
    Route::post('profession_import', [ProfessionController::class, 'import'])->name('professions.import');
    Route::post('citizenship_import', [CitizenshipController::class, 'import'])->name('citizenships.import');
    Route::resource('education_languages', EducationLanguageController::class);
    Route::resource('education_costs', EducationCostController::class);
    Route::resource('exam_languages', ExamLanguageController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('towns', TownController::class);
    Route::resource('university_lists', UniversityListController::class);
    Route::resource('tariffs', TariffController::class);
    Route::get('tariff_export_excel', [TariffController::class, 'export_excel'])->name('tariff_export_excel');
    Route::get('application_export_excel', [ApplicationController::class, 'export_excel'])->name('application_export_excel');
    Route::get('tariff_export_pdf', [TariffController::class, 'export_pdf'])->name('tariff_export_pdf');
    Route::get('application_export_pdf', [ApplicationController::class, 'export_pdf'])->name('application_export_pdf');
    Route::get('all-edit/{university_id}', [TariffController::class, 'allEdit'])->name('tariff.all.edit');
    Route::put('all-update/{university_id}', [TariffController::class, 'allUpdate'])->name('tariff.all.update');
    Route::resource('countries', CountryController::class);
    Route::resource('currencies', CurrencyController::class);
    Route::resource('citizenships', CitizenshipController::class);
    Route::resource('applications', ApplicationController::class);
    Route::post('/applications/change-status', [ApplicationController::class, 'changeStatus'])->name('applications.change-status');

    Route::get('programs/index/{student_id}', [ProgramController::class, 'index'])->name('programs.index');
    Route::post('programs.accept/{id}', [ProgramController::class, 'accept'])->name('programs.accept');
    Route::get('programs/create/{student_id}', [ProgramController::class, 'create'])->name('programs.create');
    Route::get('programs/edit/{id}', [ProgramController::class, 'edit'])->name('programs.edit');
    Route::get('programs/show/{id}', [ProgramController::class, 'show'])->name('programs.show');
    Route::post('programs/store/{student_id}', [ProgramController::class, 'store'])->name('programs.store');
    Route::put('programs/update/{id}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('programs/destroy/{id}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    Route::post('/program-status', [ProgramController::class, 'storeStatus'])->name('program-status.store');
    Route::put('/programs/{program}/status/{status}', [ProgramController::class, 'updateStatus'])
        ->name('program-status.update');

    Route::delete('/programs/{program}/status/{status}', [ProgramController::class, 'destroyStatus'])
        ->name('program-status.destroy');

    Route::get('get-tariffs/{university_list_id}/{education_level_id}', [ProgramController::class, 'getTariffs']);
    //    Route::get('get-professions/{education_level_id}', [ProgramController::class,'getProfessions']);

    Route::prefix('educations')->group(function (): void {
        Route::get('/{userId}', [EducationController::class, 'index'])->name('educations.index');
        Route::get('/create/{userId}', [EducationController::class, 'create'])->name('educations.create');
        Route::post('/', [EducationController::class, 'store'])->name('educations.store');
        Route::get('/{id}/edit', [EducationController::class, 'edit'])->name('educations.edit');
        Route::put('/{id}', [EducationController::class, 'update'])->name('educations.update');
        Route::delete('/{id}', [EducationController::class, 'destroy'])->name('educations.destroy');
        Route::get('/get-fields/{degree}', [EducationController::class, 'getFields'])->name('educations.get_fields');
    });

    Route::get('documents/index/{student_id}', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('file-upload', [DocumentController::class, 'fileUpload'])->name('file-upload');
    Route::get('documents/create', [DocumentController::class, 'create'])->name('student.document_create');
    Route::get('documents/edit/{id}', [DocumentController::class, 'edit'])->name('student.document_edit');
    Route::post('documents/update/{id}', [DocumentController::class, 'update'])->name('file.upload.update');
    Route::delete('deleteFile/{id}', [DocumentController::class, 'deleteFile'])->name('deleteFile');

    Route::get('/get-user-info', [StudentController::class, 'getUserInfo']);
    Route::post('/update-user-info', [StudentController::class, 'updateUserInfo']);

    Route::post('/lang/store', [StudentLanguageController::class, 'storeLang'])->name('lang.store');
    Route::put('/lang/update/{id}', [StudentLanguageController::class, 'updateLang'])->name('lang.update');
    Route::get('languages/index/{student_id}', [StudentLanguageController::class, 'index'])->name('lang.index');
    Route::get('languages/edit/{id}', [StudentLanguageController::class, 'edit'])->name('lang.edit');
    Route::get('languages/create/{id}', [StudentLanguageController::class, 'create'])->name('lang.create');
    Route::delete('languages/destroy/{id}', [StudentLanguageController::class, 'destroy'])->name('lang.destroy');

    Route::get('/get-documents/{educationLevel}', [StudentController::class, 'getDocuments']);

    Route::get('/get-school-types/{education_level_id}', function ($education_level_id) {
        $schoolTypes = SchoolType::query()->where('education_level_id', $education_level_id)->get();
        $professions = Profession::query()->where('education_level_id', $education_level_id)->get();

        return response()->json([
            'schoolTypes' => $schoolTypes,
            'professions' => $professions,
        ]);
    });
    Route::get('/university-get-school-types/{education_level_id}', function ($education_level_id) {
        $schoolTypes = UniversitySchoolType::query()->where('university_education_level_id', $education_level_id)->get();

        return response()->json($schoolTypes);
    });
    Route::get('/api/exams/by-education/{id}', function ($id) {
        $exam_language = ExamLanguage::with('exams')->find($id);

        return response()->json([
            'exams' => $exam_language?->exams ?? [],
        ]);
    });
});
