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

use App\Entities\User;

Route::group(['middleware' => ['authenticated']], function() {
    // administrator routes
    Route::group(['prefix' => '/org', 'middleware' => ['only_admin']], function() {
        Route::get('/supply', 'Administrator\OrgController@supply')->name('administrator.org.supply');
        Route::get('/demand', 'Administrator\OrgController@demand')->name('administrator.org.demand');
        Route::any('/create', 'Administrator\OrgController@create')->name('administrator.org.create');
        Route::any('/{org}/update', 'Administrator\OrgController@update')->name('administrator.org.update');
        Route::get('/{org}/delete', 'Administrator\OrgController@delete')->name('administrator.org.delete');
        Route::get('/{org}', 'Administrator\OrgController@ajaxDetailOrg')->name('administrator.org.view');

        Route::group(['prefix' => '/{org_supply}/program', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\ProgramController@create')->name('administrator.program.create');
            Route::any('/{program}/update', 'Administrator\ProgramController@update')->name('administrator.program.update');
            Route::get('/{program}/delete', 'Administrator\ProgramController@delete')->name('administrator.program.delete');
            Route::get('/{program}', 'Administrator\ProgramController@ajaxDetailProgram')->name('administrator.program.view');
            Route::get('/', 'Administrator\ProgramController@index')->name('administrator.program.index');
        });

        Route::group(['prefix' => '/{org_supply}/student', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\StudentController@create')->name('administrator.student.create');
            Route::any('/{student}/update', 'Administrator\StudentController@update')->name('administrator.student.update');
            Route::get('/{student}/delete', 'Administrator\StudentController@delete')->name('administrator.student.delete');
            Route::get('/{student}', 'Administrator\StudentController@ajaxDetailStudent')->name('administrator.student.view');
            Route::get('/download/template', 'Administrator\StudentController@templateDownload')->name('administrator.student.template.download');
            Route::any('/upload', 'Administrator\StudentController@upload')->name('administrator.student.upload');
            Route::get('/', 'Administrator\StudentController@index')->name('administrator.student.index');
        });

        Route::group(['prefix' => '/{org_supply}/teacher', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\TeacherController@create')->name('administrator.teacher.create');
            Route::any('/{teacher}/update', 'Administrator\TeacherController@update')->name('administrator.teacher.update');
            Route::get('/{teacher}/delete', 'Administrator\TeacherController@delete')->name('administrator.teacher.delete');
            Route::get('/{teacher}', 'Administrator\TeacherController@ajaxDetailTeacher')->name('administrator.teacher.view');
            Route::get('/download/template', 'Administrator\TeacherController@templateDownload')->name('administrator.teacher.template.download');
            Route::any('/upload', 'Administrator\TeacherController@upload')->name('administrator.teacher.upload');
            Route::get('/', 'Administrator\TeacherController@index')->name('administrator.teacher.index');
        });

        Route::group(['prefix' => '/{org_demand}/employee', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\EmployeeController@create')->name('administrator.employee.create');
            Route::any('/{employee}/update', 'Administrator\EmployeeController@update')->name('administrator.employee.update');
            Route::get('/{employee}/delete', 'Administrator\EmployeeController@delete')->name('administrator.employee.delete');
            Route::get('/{employee}', 'Administrator\EmployeeController@ajaxDetailEmployee')->name('administrator.employee.view');
            Route::get('/', 'Administrator\EmployeeController@index')->name('administrator.employee.index');
        });

        Route::group(['prefix' => '/{org_demand}/employee-certificate', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\EmployeeCertificateController@create')->name('administrator.employeeCertificate.create');
            Route::any('/{employeeCertificate}/update', 'Administrator\EmployeeCertificateController@update')->name('administrator.employeeCertificate.update');
            Route::get('/{employeeCertificate}/delete', 'Administrator\EmployeeCertificateController@delete')->name('administrator.employeeCertificate.delete');
            Route::get('/{employeeCertificate}', 'Administrator\EmployeeCertificateController@ajaxDetailEmployeeCertificate')->name('administrator.employeeCertificate.view');
            Route::get('/download/template', 'Administrator\EmployeeCertificateController@templateDownload')->name('administrator.employeeCertificate.template.download');
            Route::any('/upload', 'Administrator\EmployeeCertificateController@upload')->name('administrator.employeeCertificate.upload');
            Route::get('/', 'Administrator\EmployeeCertificateController@index')->name('administrator.employeeCertificate.index');
        });

        Route::group(['prefix' => '/{org_demand}/job-title', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\JobTitleController@create')->name('administrator.jobTitle.create');
            Route::any('/{jobTitle}/update', 'Administrator\JobTitleController@update')->name('administrator.jobTitle.update');
            Route::get('/{jobTitle}/delete', 'Administrator\JobTitleController@delete')->name('administrator.jobTitle.delete');
            Route::get('/', 'Administrator\JobTitleController@index')->name('administrator.jobTitle.index');
        });

        Route::group(['prefix' => '/{org_demand}/job-function', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\JobFunctionController@create')->name('administrator.jobFunction.create');
            Route::any('/{jobFunction}/update', 'Administrator\JobFunctionController@update')->name('administrator.jobFunction.update');
            Route::get('/{jobFunction}/delete', 'Administrator\JobFunctionController@delete')->name('administrator.jobFunction.delete');
            Route::get('/', 'Administrator\JobFunctionController@index')->name('administrator.jobFunction.index');
        });
    });

    Route::group(['prefix' => '/link-match', 'middleware' => ['only_admin']], function() {
        Route::get('/supply', 'Administrator\LinkMatchController@supply')->name('administrator.link-match.supply');
        Route::get('/demand', 'Administrator\LinkMatchController@demand')->name('administrator.link-match.demand');
        Route::get('/program/{org_supply}', 'Administrator\LinkMatchController@program')->name('administrator.link-match.program');
        Route::get('/program-license/{program}', 'Administrator\LinkMatchController@programLicense')->name('administrator.link-match.program-license');
        Route::get('/demand-by-program/{program}', 'Administrator\LinkMatchController@demandByProgram')->name('administrator.link-match.demand-by-program');
        Route::get('/job-title/{org_demand}', 'Administrator\LinkMatchController@jobTitle')->name('administrator.link-match.job-title');
        Route::get('/job-title-license/{jobTitle}', 'Administrator\LinkMatchController@jobTitleLicense')->name('administrator.link-match.job-title-license');
        Route::get('/supply-by-job-title/{jobTitle}', 'Administrator\LinkMatchController@supplyByJobTitle')->name('administrator.link-match.supply-by-job-title');

        Route::group(['prefix' => '/edit', 'middleware' => ['only_admin']], function() {
            Route::any('{org_supply}/update/{program}', 'Administrator\LinkMatchController@updateData')->name('administrator.link-match.update');
            Route::get('{org_supply}/update', 'Administrator\LinkMatchController@selectProgram')->name('administrator.link-match.select-program');
            Route::get('job-title/{org_demand}', 'Administrator\LinkMatchController@selectProgram')->name('administrator.link-match.job-title');
            Route::get('/', 'Administrator\LinkMatchController@selectSupply')->name('administrator.link-match.edit');
        });
    });

    Route::group(['prefix' => '/user', 'middleware' => ['only_admin']], function() {
        Route::any('/create/{type}', 'Administrator\UserController@create')->name('administrator.user.create')
            ->where('type', User::ROLE_ADMIN."|". User::ROLE_SUPPLY."|". User::ROLE_DEMAND);
        Route::any('/{user}/update', 'Administrator\UserController@update')->name('administrator.user.update');
        Route::get('/{user}/delete', 'Administrator\UserController@delete')->name('administrator.user.delete');
        Route::get('/{user}/enable', 'Administrator\UserController@enable')->name('administrator.user.enable');
        Route::get('/{user}/disable', 'Administrator\UserController@disable')->name('administrator.user.disable');
        Route::get('/{user}', 'Administrator\UserController@ajaxDetailUser')->name('administrator.user.view');
        Route::get('/', 'Administrator\UserController@index')->name('administrator.user.index');
    });

    Route::group(['prefix' => '/short-course', 'middleware' => ['only_admin']], function() {
        Route::any('/create', 'Administrator\ShortCourseController@create')->name('administrator.shortCourse.create');
        Route::any('/{shortCourse}/update', 'Administrator\ShortCourseController@update')->name('administrator.shortCourse.update');
        Route::get('/{shortCourse}/delete', 'Administrator\ShortCourseController@delete')->name('administrator.shortCourse.delete');
        Route::get('/{shortCourse}', 'Administrator\ShortCourseController@ajaxDetailShortCourse')->name('administrator.shortCourse.view');
        Route::get('/download/template', 'Administrator\ShortCourseController@templateDownload')->name('administrator.shortCourse.template.download');
        Route::get('/', 'Administrator\ShortCourseController@index')->name('administrator.shortCourse.index');
        Route::post('/upload', 'Administrator\ShortCourseController@upload')->name('administrator.shortCourse.upload');

        Route::group(['prefix' => '/{shortCourse}/short-course-data', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\ShortCourseDataController@create')->name('administrator.shortCourseData.create');
            Route::any('/{shortCourseData}/update', 'Administrator\ShortCourseDataController@update')->name('administrator.shortCourseData.update');
            Route::get('/{shortCourseData}/delete', 'Administrator\ShortCourseDataController@delete')->name('administrator.shortCourseData.delete');
            Route::get('/', 'Administrator\ShortCourseDataController@index')->name('administrator.shortCourseData.index');
            Route::any('/participant/create', 'Administrator\ShortCourseParticipantController@create')->name('administrator.shortCourseParticipant.create');
        });
    });

    Route::group(['prefix' => '/competency', 'middleware' => ['only_admin']], function() {
        Route::any('/create', 'Administrator\CompetencyController@create')->name('administrator.competency.create');
        Route::any('/{competency}/update', 'Administrator\CompetencyController@update')->name('administrator.competency.update');
        Route::get('/{competency}/delete', 'Administrator\CompetencyController@delete')->name('administrator.competency.delete');
        Route::get('/{competency}', 'Administrator\CompetencyController@ajaxDetailCompetency')->name('administrator.competency.view');
        Route::get('/', 'Administrator\CompetencyController@index')->name('administrator.competency.index');
    });

    Route::group(['prefix' => '/analytics', 'middleware' => ['only_admin']], function() {
        Route::get('/dashboard', 'Administrator\AnalyticsController@dashboard')->name('administrator.analytics.dashboard');
        Route::get('/lulusan', 'Administrator\AnalyticsController@index')->name('administrator.analytics.index');
        Route::get('/siswa', 'Administrator\AnalyticsController@students')->name('administrator.analytics.students');
        Route::get('/diklat', 'Administrator\AnalyticsController@shortcourse')->name('administrator.analytics.shortcourse');
        Route::get('/jurusan', 'Administrator\AnalyticsController@studyprogram')->name('administrator.analytics.studyprogram');
        Route::get('/pegawai', 'Administrator\AnalyticsController@employee')->name('administrator.analytics.employee');
    });

    // supply routes
    Route::group(['prefix' => '/program', 'middleware' => ['only_supply']], function() {
        Route::any('/create', 'Supply\ProgramController@create')->name('supply.program.create');
        Route::any('/{program}/update', 'Supply\ProgramController@update')->name('supply.program.update');
        Route::get('/{program}/delete', 'Supply\ProgramController@delete')->name('supply.program.delete');
        Route::get('/{program}', 'Supply\ProgramController@ajaxDetailProgram')->name('administrator.program.view');
        Route::get('/', 'Supply\ProgramController@index')->name('supply.program.index');
    });

    Route::group(['prefix' => '/student', 'middleware' => ['only_supply']], function() {
        Route::any('/create', 'Supply\StudentController@create')->name('supply.student.create');
        Route::any('/{student}/update', 'Supply\StudentController@update')->name('supply.student.update');
        Route::get('/{student}/delete', 'Supply\StudentController@delete')->name('supply.student.delete');
        Route::get('/{student}', 'Supply\StudentController@ajaxDetailStudent')->name('supply.student.view');
        Route::get('/download/template', 'Supply\StudentController@templateDownload')->name('supply.student.template.download');
        Route::any('/upload', 'Supply\StudentController@upload')->name('supply.student.upload');
        Route::get('/', 'Supply\StudentController@index')->name('supply.student.index');
    });

    Route::group(['prefix' => '/teacher', 'middleware' => ['only_supply']], function() {
        Route::any('/create', 'Supply\TeacherController@create')->name('supply.teacher.create');
        Route::any('/{teacher}/update', 'Supply\TeacherController@update')->name('supply.teacher.update');
        Route::get('/{teacher}/delete', 'Supply\TeacherController@delete')->name('supply.teacher.delete');
        Route::get('/{teacher}', 'Supply\TeacherController@ajaxDetailTeacher')->name('supply.teacher.view');
        Route::get('/download/template', 'Supply\TeacherController@templateDownload')->name('supply.teacher.template.download');
        Route::any('/upload', 'Supply\TeacherController@upload')->name('supply.teacher.upload');
        Route::get('/', 'Supply\TeacherController@index')->name('supply.teacher.index');
    });

    Route::group(['prefix' => '/link-match-supply', 'middleware' => ['only_supply']], function() {
        Route::get('/program-license/{program}', 'Supply\LinkMatchController@programLicense')->name('supply.link-match.program-license');
        Route::get('/demand-by-program/{program}', 'Supply\LinkMatchController@demandByProgram')->name('supply.link-match.demand-by-program');
        Route::get('/', 'Supply\LinkMatchController@supply')->name('supply.link-match');
    });
    
    Route::group(['prefix' => '/supply/short-course', 'middleware' => ['only_supply']], function() {
        Route::get('/', 'Supply\ShortCourseController@index')->name('supply.shortCourse.index');
    });

    // demand routes
    Route::group(['prefix' => '/employee', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\EmployeeController@create')->name('demand.employee.create');
        Route::any('/{employee}/update', 'Demand\EmployeeController@update')->name('demand.employee.update');
        Route::get('/{employee}/delete', 'Demand\EmployeeController@delete')->name('demand.employee.delete');
        Route::get('/{employee}', 'Demand\EmployeeController@ajaxDetailEmployee')->name('demand.employee.view');
        Route::get('/', 'Demand\EmployeeController@index')->name('demand.employee.index');
    });

    Route::group(['prefix' => '/employee-certificate', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\EmployeeCertificateController@create')->name('demand.employeeCertificate.create');
        Route::any('/{employeeCertificate}/update', 'Demand\EmployeeCertificateController@update')->name('demand.employeeCertificate.update');
        Route::get('/{employeeCertificate}/delete', 'Demand\EmployeeCertificateController@delete')->name('demand.employeeCertificate.delete');
        Route::get('/{employeeCertificate}', 'Demand\EmployeeCertificateController@ajaxDetailEmployeeCertificate')->name('demand.employeeCertificate.view');
        Route::any('/upload', 'Demand\EmployeeCertificateController@upload')->name('demand.employeeCertificate.upload');
        Route::get('/', 'Demand\EmployeeCertificateController@index')->name('demand.employeeCertificate.index');
    });

    Route::group(['prefix' => '/job-title', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\JobTitleController@create')->name('demand.jobTitle.create');
        Route::any('/{jobTitle}/update', 'Demand\JobTitleController@update')->name('demand.jobTitle.update');
        Route::get('/{jobTitle}/delete', 'Demand\JobTitleController@delete')->name('demand.jobTitle.delete');
        Route::get('/', 'Demand\JobTitleController@index')->name('demand.jobTitle.index');
    });

    Route::group(['prefix' => '/job-function', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\JobFunctionController@create')->name('demand.jobFunction.create');
        Route::any('/{jobFunction}/update', 'Demand\JobFunctionController@update')->name('demand.jobFunction.update');
        Route::get('/{jobFunction}/delete', 'Demand\JobFunctionController@delete')->name('demand.jobFunction.delete');
        Route::get('/', 'Demand\JobFunctionController@index')->name('demand.jobFunction.index');
    });

    Route::group(['prefix' => '/certificate', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\CertificateController@create')->name('demand.certificate.create');
        Route::any('/{certificate}/update', 'Demand\CertificateController@update')->name('demand.certificate.update');
        Route::get('/{certificate}/delete', 'Demand\CertificateController@delete')->name('demand.certificate.delete');
        Route::get('/', 'Demand\CertificateController@index')->name('demand.certificate.index');
    });

    Route::group(['prefix' => '/recruitment', 'middleware' => ['only_demand']], function() {
        Route::any('/', 'Demand\RecruitmentController@index')->name('demand.recruitment.index');
        Route::any('/{student}/create', 'Demand\RecruitmentController@create')->name('demand.recruitment.create');
        Route::get('/{student}', 'Demand\RecruitmentController@ajaxDetailStudent')->name('demand.recruitment.view');
    });

    Route::group(['prefix' => '/offering', 'middleware' => ['only_demand']], function() {
        Route::get('/', 'Demand\OfferingController@index')->name('demand.offering.index');
        Route::get('/{student}', 'Demand\OfferingController@ajaxDetailStudent')->name('demand.offering.view');
        Route::any('/{recruitment}/update', 'Demand\OfferingController@update')->name('demand.offering.update');
        Route::get('/{recruitment}/delete', 'Demand\OfferingController@delete')->name('demand.offering.delete');
        Route::get('/{recruitment}/email', 'Demand\OfferingController@email')->name('demand.offering.email');
    });

    Route::group(['prefix' => '/link-match-demand', 'middleware' => ['only_demand']], function() {
        Route::get('/job-title-license/{jobTitle}', 'Demand\LinkMatchController@jobTitleLicense')->name('demand.link-match.job-title-license');
        Route::get('/supply-by-job-title/{jobTitle}', 'Demand\LinkMatchController@supplyByJobTitle')->name('demand.link-match.supply-by-job-title');
        Route::get('/', 'Demand\LinkMatchController@demand')->name('demand.link-match');
    });

    Route::group(['prefix' => '/short-course-demand', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\ShortCourseController@create')->name('demand.shortCourse.create');
        Route::get('/{shortCourse}', 'Demand\ShortCourseController@ajaxDetailShortCourse')->name('administrator.shortCourse.view');
        Route::get('/', 'Demand\ShortCourseController@index')->name('demand.shortCourse.index');

        // Route::group(['prefix' => '/{shortCourse}/short-course-data', 'middleware' => ['only_admin']], function() {
        //     Route::any('/create', 'Administrator\ShortCourseDataController@create')->name('administrator.shortCourseData.create');
        //     Route::any('/{shortCourseData}/update', 'Administrator\ShortCourseDataController@update')->name('administrator.shortCourseData.update');
        //     Route::get('/{shortCourseData}/delete', 'Administrator\ShortCourseDataController@delete')->name('administrator.shortCourseData.delete');
        //     Route::get('/', 'Administrator\ShortCourseDataController@index')->name('administrator.shortCourseData.index');
        //     Route::any('/participant/create', 'Administrator\ShortCourseParticipantController@create')->name('administrator.shortCourseParticipant.create');
        // });
    });

    // shared routes
    Route::group(['prefix' => '/competency', 'middleware' => ['all_user']], function() {
        Route::any('/create', 'Shared\CompetencyController@create')->name('shared.competency.create');
        Route::any('/{competency}/update', 'Shared\CompetencyController@update')->name('shared.competency.update');
        Route::get('/{competency}/delete', 'Shared\CompetencyController@delete')->name('shared.competency.delete');
        Route::get('/{competency}', 'Shared\CompetencyController@ajaxDetailCompetency')->name('shared.competency.view');
        Route::get('/', 'Shared\CompetencyController@index')->name('shared.competency.index');
    });

    Route::group(['prefix' => '/competency-main-purpose', 'middleware' => ['all_user']], function() {
        Route::any('/create', 'Shared\CompetencyMainPurposeController@create')->name('shared.competency.create');
        Route::any('/{competencyMainPurpose}/update', 'Shared\CompetencyMainPurposeController@update')->name('shared.competencyMainPurpose.update');
        Route::get('/{competencyMainPurpose}/delete', 'Shared\CompetencyMainPurposeController@delete')->name('shared.competencyMainPurpose.delete');
        Route::get('/', 'Shared\CompetencyMainPurposeController@index')->name('shared.competencyMainPurpose.index');
    });

    Route::group(['prefix' => '/competency-key-function', 'middleware' => ['all_user']], function() {
        Route::any('/create', 'Shared\CompetencyKeyFunctionController@create')->name('shared.competencyKeyFunction.create');
        Route::any('/{competencyKeyFunction}/update', 'Shared\CompetencyKeyFunctionController@update')->name('shared.competencyKeyFunction.update');
        Route::get('/{competencyKeyFunction}/delete', 'Shared\CompetencyKeyFunctionController@delete')->name('shared.competencyKeyFunction.delete');
        Route::get('/', 'Shared\CompetencyKeyFunctionController@index')->name('shared.competencyKeyFunction.index');
    });

    Route::group(['prefix' => '/competency-main-function', 'middleware' => ['all_user']], function() {
        Route::any('/create', 'Shared\CompetencyMainFunctionController@create')->name('shared.competencyMainFunction.create');
        Route::any('/{competencyMainFunction}/update', 'Shared\CompetencyMainFunctionController@update')->name('shared.competencyMainFunction.update');
        Route::get('/{competencyMainFunction}/delete', 'Shared\CompetencyMainFunctionController@delete')->name('shared.competencyMainFunction.delete');
        Route::get('/', 'Shared\CompetencyMainFunctionController@index')->name('shared.competencyMainFunction.index');
    });

    Route::group(['prefix' => '/competency-main-purpose', 'middleware' => ['all_user']], function() {
        Route::any('/create', 'Shared\CompetencyMainPurposeController@create')->name('shared.competencyMainPurpose.create');
        Route::any('/{competencyMainPurpose}/update', 'Shared\CompetencyMainPurposeController@update')->name('shared.competencyMainPurpose.update');
        Route::get('/{competencyMainPurpose}/delete', 'Shared\CompetencyMainPurposeController@delete')->name('shared.competencyMainPurpose.delete');
        Route::get('/', 'Shared\CompetencyMainPurposeController@index')->name('shared.competencyMainPurpose.index');
    });

    Route::group(['prefix' => '/competency-unit', 'middleware' => ['all_user']], function() {
        Route::any('/create', 'Shared\CompetencyUnitController@create')->name('shared.competencyUnit.create');
        Route::any('/{competencyUnit}/update', 'Shared\CompetencyUnitController@update')->name('shared.competencyUnit.update');
        Route::get('/{competencyUnit}/delete', 'Shared\CompetencyUnitController@delete')->name('shared.competencyUnit.delete');
        Route::get('/', 'Shared\CompetencyUnitController@index')->name('shared.competencyUnit.index');
    });

    Route::group(['prefix' => '/license', 'middleware' => ['all_user']], function() {
        Route::any('/create', 'Shared\LicenseController@create')->name('shared.license.create');
        Route::any('/{license}/update', 'Shared\LicenseController@update')->name('shared.license.update');
        Route::get('/{license}/delete', 'Shared\LicenseController@delete')->name('shared.license.delete');
        Route::get('/{license}', 'Shared\LicenseController@ajaxDetailLicense')->name('shared.license.view');
        Route::get('/', 'Shared\LicenseController@index')->name('shared.license.index');
    });

    // utils routes
    Route::any('/update-profile', 'UtilityController@updateProfile')->name('update.profile');
    Route::get('/', 'UtilityController@dashboard')->name('dashboard');
});

Route::any('/verify/{id}', 'AuthController@verifyUser')->name('verify.user');
Route::any('/register', 'AuthController@register')->name('register');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::any('/login', 'AuthController@login')->name('login');
