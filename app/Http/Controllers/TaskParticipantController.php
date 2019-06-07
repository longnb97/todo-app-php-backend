<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Helpers\ResponseService;
use App\TaskParticipant as TaskParticipantModel;
use App\ProjectParticipant as ProjectParticipantModel;

class TaskParticipantController extends Controller
{
    public function createTaskParticipant(Request $request)
    {
        $current_timestamp =  date("Y-m-d H:i:s", time());
        $newTaskParticipant =  [
            'task_id' => $request->task_id,
            'account_id' => $request->account_id,
            'created_at' =>  $current_timestamp
        ];
        
        // checkAccountInProject($projectId, $accountId)
        try {
            $data = TaskParticipantModel::create($newTaskParticipant);
            return ResponseService::response(1, 'Task Participant created', 201, $newTaskParticipant);
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }

    public function getAllTaskParticipant(Request $request)
    {
        try {
            $data = TaskParticipantModel::getAll();
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'Task Participant not found', 404, $data);
            } else {
                return ResponseService::response(1, 'Task Participant found', 200, $data);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }

    // check account in project
    public static function checkAccountInProject($projectId, $accountId)
    {
        // user có những task nào
        try {
            $data = ProjectParticipantModel::checkAccountInProject($projectId, $accountId);
            if ($data->isEmpty()) {
                return false;
            } else {
                return true;
            }
        } catch (QueryException $exception) {
            return false;
        }
    }


    public function getTaskParticipantByTaskId($taskId)
    {
        // lọc các công việc theo task
        try {
            $data = TaskParticipantModel::getByTaskId($taskId);
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'Task Participant not found', 404, $data);
            } else {
                return ResponseService::response(1, 'Task Participant found', 200, $data);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }

    public function getTaskParticipantByAccountId($accountId)
    {
        // user có những task nào
        try {
            $data = TaskParticipantModel::getByAccountId($accountId);
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'Task Participant not found', 404, $data);
            } else {
                return ResponseService::response(1, 'Task Participant found', 200, $data);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }

    public function deleteTaskParticipant($taskId, $accountId)
    {
        try {
            $data = TaskParticipantModel::deleteById($taskId, $accountId);
            if ($data === 0) {
                return ResponseService::response(0, 'Task Participant not found', 404, $data);
            } else {
                $recordDeleted = [
                    'task_id' => $taskId,
                    'account_id' => $accountId,
                ];
                return ResponseService::response(1, 'success', 200, $recordDeleted);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }
}

// test
