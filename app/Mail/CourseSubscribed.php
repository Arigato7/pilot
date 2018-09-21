<?php

namespace Pilot\Mail;

use Pilot\User;
use Pilot\Position;
use Pilot\UserInfo;
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
    public function __construct($userId, $courseId)
    {
        $userData = User::findOrFail($userId);

        $this->user = $userData->userInfo;
        $this->course = Course::findOrFail($courseId);
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
        return $this->from('downonrabota@mail.ru')
                    ->view('emails.test');
    }
}
