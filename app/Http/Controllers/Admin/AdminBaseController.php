<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class AdminBaseController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('status');
    }
}
