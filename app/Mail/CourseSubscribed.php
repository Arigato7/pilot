<?php

namespace Pilot\Mail;

use Pilot\User;
use Pilot\Course;
use Pilot\Position;
use Pilot\UserInfo;
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
    public $course;
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

        $this->user = $userData->userInfo;
        $this->course = Course::findOrFail($courseRecord->course_id);
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
                        'user' => $this->user,
                        'course' => $this->course,
                        'organization' => $this->organization,
                        'position' => $this->position,
                    ]);
    }
}
