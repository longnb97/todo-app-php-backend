<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project as ProjectModel;

use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\TryCatch;

class ProjectController extends Controller
{

    // $table->increments('projectId');
    // $table->string('name');
    // $table->string('type'); // kieu project ...
    // $table->string('description')->default(' ');
    // $table->string('accountId')->nullable();
    // $table->string('participants'); // nguoi tham gia 
    // $table->date('dueDate')->nullable();
    public function message($success, $message, $statusCode, $data = 'none', $err = 'none')
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'statusCode' => $statusCode,
            'data' => $data,
            'err' => $err
        ];
        return $response;
    }

    public function createProject(Request $request)
    {
        $project =  [
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'accountId' => $request->accountId,
            'participants' => $request->participants,
            'dueDate' => $request->dueDate,
        ];

        try {
            $data = ProjectModel::createProject($project);
            $response = $this->message(1, 'project created', 201, $data);
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, null, $ex);
        }
        return response()->json($response);
    }

    public function getAllProjects(Request $request)
    {
        try {
            $data = ProjectModel::getAll();
            if ($data->isEmpty()) {
                $response = $this->message(0, 'projects not found', 404, $data);
            } else {
                $response = $this->message(1, 'project found', 200, $data);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, null, $ex);
        }
        return response()->json($response);
    }

    public function getProjectById(Request $request, $id)
    {
        try {
            $data = ProjectModel::getById($id);
            if ($data->isEmpty()) {
                $response = $this->message(0, 'project not found', 404, $data);
            } else {
                $response = $this->message(1, 'project found', 200, $data);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, [], $ex);
        }
        return response()->json($response);
    }
    public function deleteProjectById(Request $request, $id)
    {
        try {
            $data = ProjectModel::getById($id);
            if ($data->isEmpty()) {
                $response = $this->message(0, 'project not found', 404, $data);
            } else {
                $deleteQuery = ProjectModel::deleteProject($id);
                $response = $this->message(1, 'deleted', 200);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, [], $ex);
        }
        return response()->json($response);
    }

    public function getAccountAllProjects(Request $request, $userId)
    {
        $project =  [
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'accountId' => $request->accountId,
            'participants' => $request->participants,
            'dueDate' => $request->dueDate,
        ];
        try {
            $data = ProjectModel::getAccountProjects($project);
            if ($data->isEmpty()) {
                $response = $this->message(0, 'project not found', 404, $data);
            } else {
                $response = $this->message(1, 'project found', 200, $data);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, [], $ex);
        }
        return response()->json($response);
    }

    public function changeProjectProperties(Request $request, $id)
    {
        $project =  [
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'accountId' => $request->accountId,
            'participants' => $request->participants,
            'dueDate' => $request->dueDate,
        ];
        try {
            $data = ProjectModel::getById($id);
            if ($data->isEmpty()) {
                $response = $this->message(0, 'projects not found', 404, $data);
            } else {
                $update = ProjectModel::changeProperties($project, $id);
                $response = $this->message(1, 'updated', 200, $update);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, [], $ex);
        }
        return response()->json($response);
    }

    // public function addParticipant(Request $request, $id)
    // {
    //     try {
    //         $data = AccountModel::getById($id);
    //         if ($data->isEmpty()) {
    //             $response = $this->message(0, 'project not found', 404, $data);
    //         } else {
    //             $deleteQuery = AccountModel::deleteAccount($id);
    //             $response = $this->message(1, 'deleted', 200);
    //         }
    //     } catch (QueryException $ex) {
    //         $response = $this->message(0, 'error', 500, [], $ex);
    //     }
    //     return response()->json($response);
    // }
}
