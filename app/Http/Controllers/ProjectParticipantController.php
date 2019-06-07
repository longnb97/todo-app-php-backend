<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Helpers\ResponseService;
use App\ProjectParticipant as ProjectParticipantModel;

class ProjectParticipantController extends Controller
{
    public function createProjectParticipant(Request $request)
    {
        $current_timestamp =  date("Y-m-d H:i:s", time());
        $newProjectParticipant =  [
            'project_id' => $request->project_id,
            'account_id' => $request->account_id,
            'created_at' =>  $current_timestamp
        ];

        try {
            $data = ProjectParticipantModel::create($newProjectParticipant);
            return ResponseService::response(1, 'ProjectParticipant created', 201, $newProjectParticipant);
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }

    public function getAllProjectParticipant(Request $request)
    {
        try {
            $data = ProjectParticipantModel::getAll();
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'ProjectParticipants not found', 404, $data);
            } else {
                return ResponseService::response(1, 'ProjectParticipant found', 200, $data);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }

    public function getProjectParticipantByTaskId($projectId)
    {
        // lọc các công việc theo task
        try {
            $data = ProjectParticipantModel::getByProjectId($projectId);
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'Project Participant not found', 404, $data);
            } else {
                return ResponseService::response(1, 'Project Participant found', 200, $data);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }

    public function getProjectParticipantByAccountId($accountId)
    {
        // user có những task nào
        try {
            $data = ProjectParticipantModel::getByAccountId($accountId);
            if ($data->isEmpty()) {
                return ResponseService::response(0, 'Project Participant not found', 404, $data);
            } else {
                return ResponseService::response(1, 'Project Participant found', 200, $data);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }


    public function deleteProjectParticipant($taskId, $accountId)
    {
        try {
            $data = ProjectParticipantModel::deleteById($taskId, $accountId);
            if ($data === 0) {
                return ResponseService::response(0, 'Project Participant not found', 404, $data);
            } else {
                $recordDeleted = [
                    'task_id' => $taskId,
                    'account_id' => $accountId,
                ];
                return ResponseService::response(1, 'delete success', 200, $recordDeleted);
            }
        } catch (QueryException $exception) {
            return ResponseService::response(0, $exception->getMessage(), 500, null);
        }
    }
}
