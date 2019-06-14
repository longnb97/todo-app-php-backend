<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


use App\ProjectParticipant as ProjectParticipantsModel;
use App\Helpers\ResponseService as Client;
use App\Helpers\DebugService as Console;

class ProjectParticipantsController extends Controller
{
    public function getAccountAllProjects(Request $request, $userId)
    {
        try {
            $data = ProjectParticipantsModel::getProjects($userId);
            if ($data->isEmpty()) {
                return Client::response(0, 'project not found', 404, $data);
            } else {
                return Client::response(1, 'projects found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, $ex, 500, []);
        }
    }
    public function getProjectParticipants(Request $request, $projectId)
    {
        try {
            $data = ProjectParticipantsModel::getParticipants($projectId);
            if ($data->isEmpty()) {
                return Client::response(0, 'participants not found', 404, $data);
            } else {
                return Client::response(1, 'participants found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, $ex, 500, []);
        }
    }
    public function addParticipantToProject(Request $request){
        $newParticipant =  [
            'project_id' => $request->projectId,
            'account_id' => $request->accountId
        ];
        try {
            $data = ProjectParticipantsModel::createProjectParticipant($newParticipant);
            return Client::response(1, 'account added to project successfully', 200, $data);
        } catch (QueryException $ex) {
            return Client::response(0, $ex, 500, null);
        }
    }   

}
