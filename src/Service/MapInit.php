<?php

namespace App\Service;

use App\Service\Grid;
use App\Service\Auth;

class MapInit {

    public function mapInit()
    {
        $auth = new Auth;
        $objects = $auth->getMapObjects();
        $buildingTasks = $auth->getTasks('build');
        foreach ($buildingTasks as $task) {
            array_push($objects, [
                "type"=>$task["target"]."InConst",
                "pos"=>$task["targetPos"],
                "player"=>$auth->getUsernameById($task["author"]),
                "playerId"=>$task["author"],
                "start"=>$task["start"],
                "time"=>$task["time"],
            ]);
        }
        $result = '<script>var objectMapObj = [';
        foreach ($objects as $object) {

            if ($object['type'] == "base" || $object['type'] == "mine") {
                $content = [];
                $workers = $auth->getUnit('worker', 'base,'.$object["id"]);
                if ($workers != 0) {
                    $content["workers"] = $workers;
                }
                $workersInConstruct = $auth->getEntityInConst("worker", $object["id"]);
                if ($workersInConstruct) {
                    for ($i=0; $i < sizeof($workersInConstruct); $i++) {
                        $content["workersInConst"][$i] = (int)$workersInConstruct[$i]["time"];
                    }
                }

                $soldiers = $auth->getUnit('soldier', 'base,'.$object["id"]);
                if ($soldiers != 0) {
                    $content["soldiers"] = $soldiers;
                }
                $soldiersInConstruct = $auth->getEntityInConst("soldier", $object["id"]);
                if ($soldiersInConstruct) {
                    for ($i=0; $i < sizeof($soldiersInConstruct); $i++) {
                        $content["soldiersInConst"][$i] = (int)$soldiersInConstruct[$i]["time"];
                    }
                }

                $workerSpaceInConstruct = $auth->getEntityInConst("workerSpace", $object["id"]);
                if ($workerSpaceInConstruct) {
                    $content["workerSpaceInConst"] = (int)$workerSpaceInConstruct[0]["time"];
                }
                $soldierSpaceInConstruct = $auth->getEntityInConst("soldierSpace", $object["id"]);
                if ($soldierSpaceInConstruct) {
                    $content["soldierSpaceInConst"] = (int)$soldierSpaceInConstruct[0]["time"];
                }
            }

            if (isset($_SESSION['auth'])){
                if ($object["player"] == $_SESSION['auth']){
                    $owner = "player";
                } else {
                    $owner = "enemy";
                }
            } else {
                $owner = "neutral";
            }            
            $pos = json_decode($object["pos"]);
            
            if ($object['type'] == 'base') {
                $workerSpace = $auth->getSpace('worker', $object['type'].','.$object["id"]);
                $soldierSpace = $auth->getSpace('soldier', $object['type'].','.$object["id"]);
                $result .= '
                    {
                        "type": "base",
                        "x": '.$pos[0].', 
                        "y": '.$pos[1].', 
                        "id": '.$object["id"].', 
                        "owner": "'.$owner.'", 
                        "ownerName": "'.$object["player"].'", 
                        "main": '.$object["main"].',
                        "content": '.json_encode($content).',
                        "workerSpace": '.$workerSpace.',
                        "soldierSpace": '.$soldierSpace.'
                    },';
            } else if ($object['type'] == 'mine') {
                $workerSpace = $auth->getSpace('worker', $object['type'].','.$object["id"]);
                $soldierSpace = $auth->getSpace('soldier', $object['type'].','.$object["id"]);
                $result .= '
                    {
                        "type": "mine",
                        "x": '.$pos[0].', 
                        "y": '.$pos[1].', 
                        "id": '.$object["id"].', 
                        "owner": "'.$owner.'", 
                        "ownerName": "'.$object["player"].'",
                        "content": '.json_encode($content).',
                        "workerSpace": '.$workerSpace.',
                        "soldierSpace": '.$soldierSpace.'
                    },';

            } else {
                $result .= '
                {
                    "type": "'.$object['type'].'",
                    "x": '.$pos[0].', 
                    "y": '.$pos[1].', 
                    "owner": "'.$owner.'", 
                    "ownerName": "'.$object["player"].'",
                    "start": "'.$object["start"].'",
                    "time": "'.$object["time"].'"
                },';
            }
        }
        $result[strrpos($result, ',')] = ' ';
        $result = $result . ']</script>';
        return $result;
    }
    
}

