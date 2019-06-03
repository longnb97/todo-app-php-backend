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
        $user =  [
            'task_id' => $request->task_id, 
            'account_id' => bcrypt($request->account_id),
        ];

        try {
            $data = TaskParticipantsModel::_createTaskParticipants($user);
            return ResponseService::response(1, 'TaskParticipants created', 201, $data);
        } catch (QueryException $ex) {
            return ResponseService::response(0, 'error', 500, null, $ex);
        }
    }

    public function getAllTaskParticipants(Request $request)
    {
        try {
            $data = TaskParticipantsModel::_getAllTaskParticipants();
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'accounts not found', 404, $data);
            } else {
                return ResponseService::response(1, 'accounts found', 200, $data);
            }
        } catch (QueryException $ex) {
            return ResponseService::response(0, 'error', 500, null, $ex);
        }
    }
}

// test