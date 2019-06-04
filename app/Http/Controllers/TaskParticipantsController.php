<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Helpers\ResponseService;
use App\TaskParticipants as TaskParticipantsModel;


class TaskParticipantsController extends Controller
{
    public function createTaskParticipants(Request $request)
    {
        $current_timestamp =  date("Y-m-d H:i:s", time()); 
        $taskParticipants =  [
            'task_id' => $request->task_id, 
            'account_id' =>$request->account_id,
            'created_at' =>  $current_timestamp
        ];

        try {
            $data = TaskParticipantsModel::create($taskParticipants);
            return ResponseService::response(1, 'TaskParticipants created', 201, $taskParticipants);
        } catch (QueryException $ex) {
            return ResponseService::response(0, 'error', 500, null, $ex);
        }
    }

    public function getAllTaskParticipants(Request $request)
    {
        try {
            $data = TaskParticipantsModel::getAll();
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'accounts not found', 404, $data);
            } else {
                return ResponseService::response(1, 'accounts found', 200, $data);
            }
        } catch (QueryException $ex) {
            // return ResponseService::response(0, 'error', 500, null, $ex);
            return response()->json(['err'=>$ex, 'statusCode'=> 500]);
        }
    }

    public function getTaskParticipantsByTaskId($taskId)
    {
        try {
            $data = TaskParticipantsModel::getByTaskId($taskId);
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'accounts not found', 404, $data);
            } else {
                return ResponseService::response(1, 'accounts found', 200, $data);
            }
        } catch (QueryException $ex) {
            // return ResponseService::response(0, 'error', 500, null, $ex);
            return response()->json(['err'=>$ex, 'statusCode'=> 500]);
        }
    }

    public function getTaskParticipantsByAccountId($accountId)
    {
        try {
            $data = TaskParticipantsModel::getByAccountId($accountId);
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'accounts not found', 404, $data);
            } else {
                return ResponseService::response(1, 'accounts found', 200, $data);
            }
        } catch (QueryException $ex) {
            // return ResponseService::response(0, 'error', 500, null, $ex);
            return response()->json(['err'=>$ex, 'statusCode'=> 500]);
        }
    }
}

// test