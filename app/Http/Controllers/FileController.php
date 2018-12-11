<?php

namespace Pilot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class FileController extends Controller
{
    protected $fileSystem;

    public function __construct() {
        $this->fileSystem = new Filesystem();
    }

    protected function deleteFile($path) {
        return $this->fileSystem->delete($path);
    }
}
