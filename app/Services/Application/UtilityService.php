<?php

namespace App\Services\Application;

use App\Services\Domain\OrgService;
use App\Services\Domain\ShortCourseService;
use App\Services\Domain\StudentService;
use App\Services\Domain\TeacherService;

class UtilityService
{
    /** @var OrgService $orgService */
    private $orgService;
    /** @var TeacherService $teacherService */
    private $teacherService;
    /** @var StudentService $studentService */
    private $studentService;
    /** @var ShortCourseService $shortCourseService */
    private $shortCourseService;

    public function __construct()
    {
        $this->orgService = app(OrgService::class);
        $this->teacherService = app(TeacherService::class);
        $this->studentService = app(StudentService::class);
        $this->shortCourseService = app(ShortCourseService::class);
    }

    /**
     * Get data for dashboard
     *
     * @return array
     */
    public function getDataForDashboard()
    {
        $countSchools = number_format($this->orgService->getCountSchool(), 0, ',', '.');
        $countTeachers = number_format($this->teacherService->getCountTeacher(), 0, ',', '.');
        $countStudents = number_format($this->studentService->getCountStudent(), 0, ',', '.');
        $countShortCourses = number_format($this->shortCourseService->getCountShortCourse(), 0, ',', '.');
        $dataGraphTrend = $this->generateDataGraphTrend();

        return [$countSchools, $countTeachers, $countStudents, $countShortCourses, $dataGraphTrend];
    }

    /**
     * Generate data graph trend for dashboard
     *
     * @return array
     */
    private function generateDataGraphTrend()
    {
        return $this->orgService->getGraphSchoolAndStudents();
    }
}
