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
        Route::any('/create', 'Administrator\OrgController@create')->name('administrator.org.create');
        Route::any('/{org}/update', 'Administrator\OrgController@update')->name('administrator.org.update');
        Route::get('/{org}/delete', 'Administrator\OrgController@delete')->name('administrator.org.delete');
        Route::get('/{org}', 'Administrator\OrgController@ajaxDetailOrg')->name('administrator.org.view');
        Route::get('/', 'Administrator\OrgController@index')->name('administrator.org.index');

        Route::get('/link-match', 'Administrator\LinkMatchController@index')->name('administrator.linkmatch.index');

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
            Route::any('/upload', 'Administrator\StudentController@upload')->name('administrator.student.upload');
            Route::get('/', 'Administrator\StudentController@index')->name('administrator.student.index');
        });

        Route::group(['prefix' => '/{org_supply}/teacher', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\TeacherController@create')->name('administrator.teacher.create');
            Route::any('/{teacher}/update', 'Administrator\TeacherController@update')->name('administrator.teacher.update');
            Route::get('/{teacher}/delete', 'Administrator\TeacherController@delete')->name('administrator.teacher.delete');
            Route::get('/{teacher}', 'Administrator\TeacherController@ajaxDetailTeacher')->name('administrator.teacher.view');
            Route::any('/upload', 'Administrator\TeacherController@upload')->name('administrator.teacher.upload');
            Route::get('/', 'Administrator\TeacherController@index')->name('administrator.teacher.index');
        });

        Route::group(['prefix' => '/{org_demand}/employee', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\EmployeeController@create')->name('administrator.employee.create');
            Route::any('/{employee}/update', 'Administrator\EmployeeController@update')->name('administrator.employee.update');
            Route::get('/{employee}/delete', 'Administrator\EmployeeController@delete')->name('administrator.employee.delete');
            Route::get('/{employee}', 'Administrator\EmployeeController@ajaxDetailEmployee')->name('administrator.employee.view');
            Route::get('/', 'Administrator\EmployeeController@index')->name('administrator.employee.index');

            Route::group(['prefix' => '/{employee}/employeeCertificate', 'middleware' => ['only_admin']], function() {
                Route::any('/create', 'Administrator\EmployeeCertificateController@create')->name('administrator.employeeCertificate.create');
                Route::any('/{employeeCertificate}/update', 'Administrator\EmployeeCertificateController@update')->name('administrator.employeeCertificate.update');
                Route::get('/{employeeCertificate}/delete', 'Administrator\EmployeeCertificateController@delete')->name('administrator.employeeCertificate.delete');
                Route::get('/{employeeCertificate}', 'Administrator\EmployeeCertificateController@ajaxDetailEmployeeCertificate')->name('administrator.employeeCertificate.view');
                Route::any('/upload', 'Administrator\EmployeeCertificateController@upload')->name('administrator.employeeCertificate.upload');
                Route::get('/', 'Administrator\EmployeeCertificateController@index')->name('administrator.employeeCertificate.index');
            });
        });

        Route::group(['prefix' => '/{org_demand}/jobTitle', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\JobTitleController@create')->name('administrator.jobTitle.create');
            Route::any('/{jobTitle}/update', 'Administrator\JobTitleController@update')->name('administrator.jobTitle.update');
            Route::get('/{jobTitle}/delete', 'Administrator\JobTitleController@delete')->name('administrator.jobTitle.delete');
            Route::get('/', 'Administrator\JobTitleController@index')->name('administrator.jobTitle.index');
        });
    });


    Route::group(['prefix' => '/link-match', 'middleware' => ['only_admin']], function() {
        Route::get('/', 'Administrator\LinkMatchController@index')->name('administrator.linkmatch.index');
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

    Route::group(['prefix' => '/license', 'middleware' => ['only_admin']], function() {
        Route::any('/create', 'Administrator\LicenseController@create')->name('administrator.license.create');
        Route::any('/{license}/update', 'Administrator\LicenseController@update')->name('administrator.license.update');
        Route::get('/{license}/delete', 'Administrator\LicenseController@delete')->name('administrator.license.delete');
        Route::get('/', 'Administrator\LicenseController@index')->name('administrator.license.index');
    });

    Route::group(['prefix' => '/shortCourse', 'middleware' => ['only_admin']], function() {
        Route::any('/create', 'Administrator\ShortCourseController@create')->name('administrator.shortCourse.create');
        Route::any('/{shortCourse}/update', 'Administrator\ShortCourseController@update')->name('administrator.shortCourse.update');
        Route::get('/{shortCourse}/delete', 'Administrator\ShortCourseController@delete')->name('administrator.shortCourse.delete');
        Route::get('/{shortCourse}', 'Administrator\ShortCourseController@ajaxDetailShortCourse')->name('administrator.shortCourse.view');
        Route::get('/download/template', 'Administrator\ShortCourseController@templateDownload')->name('administrator.shortCourse.template.download');
        Route::get('/', 'Administrator\ShortCourseController@index')->name('administrator.shortCourse.index');
        Route::post('/upload', 'Administrator\ShortCourseController@upload')->name('administrator.shortCourse.upload');

        Route::group(['prefix' => '/{shortCourse}/shortCourseData', 'middleware' => ['only_admin']], function() {
            Route::any('/create', 'Administrator\ShortCourseDataController@create')->name('administrator.shortCourseData.create');
            Route::any('/{shortCourseData}/update', 'Administrator\ShortCourseDataController@update')->name('administrator.shortCourseData.update');
            Route::get('/{shortCourseData}/delete', 'Administrator\ShortCourseDataController@delete')->name('administrator.shortCourseData.delete');
            Route::get('/', 'Administrator\ShortCourseDataController@index')->name('administrator.shortCourseData.index');
        });
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
        Route::any('/upload', 'Supply\StudentController@upload')->name('supply.student.upload');
        Route::get('/', 'Supply\StudentController@index')->name('supply.student.index');
    });

    Route::group(['prefix' => '/teacher', 'middleware' => ['only_supply']], function() {
        Route::any('/create', 'Supply\TeacherController@create')->name('supply.teacher.create');
        Route::any('/{teacher}/update', 'Supply\TeacherController@update')->name('supply.teacher.update');
        Route::get('/{teacher}/delete', 'Supply\TeacherController@delete')->name('supply.teacher.delete');
        Route::get('/{teacher}', 'Supply\TeacherController@ajaxDetailTeacher')->name('supply.teacher.view');
        Route::any('/upload', 'Supply\TeacherController@upload')->name('supply.teacher.upload');
        Route::get('/', 'Supply\TeacherController@index')->name('supply.teacher.index');
    });

    // demand routes
    Route::group(['prefix' => '/employee', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\EmployeeController@create')->name('demand.employee.create');
        Route::any('/{employee}/update', 'Demand\EmployeeController@update')->name('demand.employee.update');
        Route::get('/{employee}/delete', 'Demand\EmployeeController@delete')->name('demand.employee.delete');
        Route::get('/{employee}', 'Demand\EmployeeController@ajaxDetailEmployee')->name('demand.employee.view');
        Route::get('/', 'Demand\EmployeeController@index')->name('demand.employee.index');

        Route::group(['prefix' => '/{employee}/employeeCertificate', 'middleware' => ['only_demand']], function() {
            Route::any('/create', 'Demand\EmployeeCertificateController@create')->name('demand.employeeCertificate.create');
            Route::any('/{employeeCertificate}/update', 'Demand\EmployeeCertificateController@update')->name('demand.employeeCertificate.update');
            Route::get('/{employeeCertificate}/delete', 'Demand\EmployeeCertificateController@delete')->name('demand.employeeCertificate.delete');
            Route::get('/{employeeCertificate}', 'Demand\EmployeeCertificateController@ajaxDetailEmployeeCertificate')->name('demand.employeeCertificate.view');
            Route::get('/', 'Demand\EmployeeCertificateController@index')->name('demand.employeeCertificate.index');
        });
    });

    Route::group(['prefix' => '/jobTitle', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\JobTitleController@create')->name('demand.jobTitle.create');
        Route::any('/{jobTitle}/update', 'Demand\JobTitleController@update')->name('demand.jobTitle.update');
        Route::get('/{jobTitle}/delete', 'Demand\JobTitleController@delete')->name('demand.jobTitle.delete');
        Route::get('/', 'Demand\JobTitleController@index')->name('demand.jobTitle.index');
    });

    Route::group(['prefix' => '/certificate', 'middleware' => ['only_demand']], function() {
        Route::any('/create', 'Demand\CertificateController@create')->name('demand.certificate.create');
        Route::any('/{certificate}/update', 'Demand\CertificateController@update')->name('demand.certificate.update');
        Route::get('/{certificate}/delete', 'Demand\CertificateController@delete')->name('demand.certificate.delete');
        Route::get('/', 'Demand\CertificateController@index')->name('demand.certificate.index');
    });

    Route::group(['prefix' => '/recruitment', 'middleware' => ['only_demand']], function() {
        Route::get('/', 'Demand\RecruitmentController@index')->name('demand.recruitment.index');
    });
    Route::group(['prefix' => '/offering', 'middleware' => ['only_demand']], function() {
        Route::get('/', 'Demand\OfferingController@index')->name('demand.recruitment.offer');
    });

    // utils routes
    Route::any('/update-profile', 'UtilityController@updateProfile')->name('update.profile');
    Route::get('/', 'UtilityController@dashboard')->name('dashboard');
});

Route::any('/verify/{id}', 'AuthController@verifyUser')->name('verify.user');
Route::any('/register', 'AuthController@register')->name('register');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::any('/login', 'AuthController@login')->name('login');
