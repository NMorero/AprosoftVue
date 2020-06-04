<?php

namespace App\Http\Controllers;

;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function saveLog(Request $request){
        $data = [];
        $data['type'] = $request->input('type');
        $data['goal_name'] = $request->input('goal_name');
        return $data;


    }
}
