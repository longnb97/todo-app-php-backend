<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\TryCatch;

use App\Project as ProjectModel;
use App\ProjectParticipant;
use App\Helpers\ResponseService as Client;
use App\Helpers\DebugService as Console;

class ProjectController extends Controller
{

    // $table->increments('projectId');
    // $table->string('name');
    // $table->string('type'); // kieu project ...
    // $table->string('description')->default(' ');
    // $table->string('accountId')->nullable();
    // $table->string('participants'); // nguoi tham gia 
    // $table->date('dueDate')->nullable();

    public function createProject(Request $request)
    {
        $project =  [
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'account_id' => $request->accountId,
            'due_date' => $request->dueDate,
        ];

        try {
            $data1 = ProjectModel::createProject($project);
            $lastestProject = ProjectModel::getLastRow();
            $pp =  [
                'project_id' => $lastestProject->id,
                'account_id' => $lastestProject->account_id
            ];
            $data2 = ProjectParticipant::createProjectParticipant($pp);
            return Client::response(1, 'project created', 201, $data1);
        } catch (QueryException $ex) {
            return Client::response(0, $ex, 500, null);
        }
    }

    public function getAllProjects(Request $request)
    {
        try {
            $data = ProjectModel::getAll();
            if ($data->isEmpty()) {
                return Client::response(0, 'projects not found', 404, $data);
            } else {
                return Client::response(1, 'project found', 200, $data);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, null, $ex);
        }
    }

    public function getProjectById(Request $request, $id)
    {
        try {
            $data = ProjectModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'project not found', 404, $data);
            } else {
                return Client::response(1, 'project found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }
    public function deleteProjectById(Request $request, $id)
    {
        //Console::log('aaa');
        try {
            $data = ProjectModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'project not found', 404, $data);
            } else {
                $deleteQuery = ProjectModel::deleteProject($id);
                return Client::response(1, 'deleted', 200);
            }
        } catch (QueryException $ex) {
            return Client::response(0, $ex, 500, []);
        }
    }

    public function getAccountCreatedProjects(Request $request, $userId)
    {
        try {
            $data = ProjectModel::getAccountProjects($userId);
            if ($data->isEmpty()) {
                return Client::response(0, 'project not found', 404, $data);
            } else {
                return Client::response(1, 'projects found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function changeProjectProperties(Request $request, $id)
    {
        $project =  [
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'account_id' => $request->accountId,
            'due_date' => $request->dueDate,
        ];
        try {
            $data = ProjectModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'projects not found', 404, $data);
            } else {
                $update = ProjectModel::changeProperties($project, $id);
                return Client::response(1, 'updated', 200, $update);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }
}
