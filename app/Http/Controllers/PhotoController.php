<?php

namespace Pilot\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{

    protected $usersPhotoDirectory = '/public/userdata/';
    protected $newsPhotoDirectory = '/public/news/';
    protected $organizationPhotoDirectory = '/public/organizations/';

    public function showOrganization($name)
    {
        return asset($organizationPhotoDirectory . $name);
    }
    public function showNews($name)
    {
        return asset($newsPhotoDirectory . $name);
    }
    public function showUser($user, $name)
    {
        return asset($usersPhotoDirectory . $user . '/' . $name);
    }
}
