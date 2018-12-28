<?php

namespace Pilot\Mail;

use Pilot\User;
use Pilot\Course;
use Pilot\UserInfo;
use Pilot\Position;
use Pilot\CourseType;
use Pilot\CourseRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Pilot\EducationOrganization;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CourseSubscribed extends Mailable
{
    use Queueable, SerializesModels;

    /** 
     * @property Course $course
     * @property UserInfo $user
     * @property EducationOrganization $organization
     * @property Position $position
     */
    public $loginData;
    public $course;
    public $courseType;
    public $user;
    public $organization;
    public $position;

    /**
     * Create a new message instance.
     * @param int $userId
     * @param int $courseId
     *
     * @return void
     */
    public function __construct(CourseRecord $courseRecord)
    {
        $userData = User::findOrFail($courseRecord->user_id);

        $this->loginData = $userData;
        $this->user = $userData->userInfo;
        $this->course = Course::findOrFail($courseRecord->course_id);
        $this->courseType = CourseType::findOrFail($this->course->course_type_id);
        $this->organization = EducationOrganization::findOrFail($userData->userInfo->education_organization_id);
        $this->position = Position::findOrFail($userData->userInfo->position_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@pilot-ipek.ru')
                    ->view('emails.test', [
                        'loginData' => $this->loginData,
                        'user' => $this->user,
                        'course' => $this->course,
                        'courseType' => $this->courseType,
                        'organization' => $this->organization,
                        'position' => $this->position,
                    ]);
    }
}
