<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MetaTag;

class MainController extends AdminBaseController
{

    public function index(){

        MetaTag::setTags(['title'=>'Админ паннель']);

        return view('admin.main.index');
    }
}
