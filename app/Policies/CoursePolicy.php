<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\Course;
use Pilot\CourseRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;
    /**
     * Возможность записи на курс
     *
     * @param User $user
     * @param Course $course
     * @return void
     */
    public function courseEntry(User $user, Course $course) {
        return $course->records->where('user_id', $user->id)->count() === 0;
    }

    /**
     * Create a new policy instance.
     * 
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Возможность добавления комментария
     *
     * @param User $user
     * @param Course $course
     * @return void
     */
    public function createCourseComment(User $user, Course $course) {
        return $course->comments->whereIn('user_id', [$user->id])->count() === 0;
    }
}
