<?php

namespace App\Service;

use App\Service\Auth;
use App\Controller\BaseController;

/**
 * this class will be driven by cron.php
 */
class TaskHandler
{

    public function handleTasks($tasks)
    {
        $auth = new Auth;
        foreach ($tasks as $task) {
            if ($task["time"] < time()) {
                if ($task["action"] == "buy") {
                    if ($task["subject"] == "worker" || $task["subject"] == "soldier") {
                        $auth->buyUnit($task["subject"], $task["origin"]);
                    } else {
                        $shortTarget = str_replace("Space", "", $task["subject"]);
                        $auth->buySpace($shortTarget, $task["origin"]);
                    }
                } elseif ($task["action"] == "build") {
                    $auth->build($task["subject"], $task["targetPos"], $task["author"]);
                } elseif ($task["action"] == "move") {
                    $arr = explode(',', $task["subject"]);
                    $targetType = $arr[0];
                    $targetAmount = $arr[1];
                    $auth->buyUnit($targetType, $task["targetOrigin"], $targetAmount);
                }
                $auth->removeTask($task["id"]);
            }
        }
    }

}