<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function information()
    {
        // echo "1111";exit;
        return view('index/information/information');
    }
}
