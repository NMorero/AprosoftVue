<?php

namespace App\Http\Controllers;

;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function saveLog(Request $request)
    {
        $data = [];
        $data['type'] = $request->input('type');
        $data['goal_name'] = $request->input('goal_name');
        return $data;
    }

    public function getTasks()
    {
        $jsonTaskFile = file_get_contents("json/tasks.json");
        $taskData = json_decode($jsonTaskFile, true);
        return $taskData;
    }
    public function getMissions()
    {
        $jsonMissionFile = file_get_contents("json/missions.json");
        $missionData = json_decode($jsonMissionFile, true);
        return $missionData;
    }
    public function setGoalsPointPlanner(Request $request){
        $string = file_get_contents("json/goalsPointPlanner.json");
        $json_a = json_decode($string, true);
        array_push($json_a, $request['goal']);
        $json = json_encode($json_a);
        file_put_contents("json/goalsPointPlanner.json",$json);
        return 'ok';
    }
}
