<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\ResponseService as Client;
use App\Helpers\DebugService as Console;
use App\Task as TaskModel;

class TaskController extends Controller
{


    // $table->increments('id');
    // $table->string('owner'); // nguoi tao
    // $table->string('participants'); // nguoi tham gia => luu id ngu?i tham gia, phân cách = ,
    // $table->date('dueDate'); //ngay het han
    // $table->string('projectId'); //projectId
    // $table->string('status'); // doing, done , ...
    // $table->string('description')->default(' ');

    public function createTask(Request $request)
    {
        $task =  [
            'owner' => $request->owner,
            'due_date' => $request->dueDate,
            'project_id' => $request->projectId,
            'status' => $request->status,
            'description' => $request->description,
        ];
        // //$token = JWTAuth::($user);
        // //$user['token'] = $token;

        try {
            $data = TaskModel::createTask($task);
            return Client::response(1, 'task created', 201, $data);
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, null, $ex);
        }
    }

    public function getAllTasks(Request $request)
    {
        try {
            $data = TaskModel::getAll();
            if ($data->isEmpty()) {
                return Client::response(0, 'tasks not found', 404, $data);
            } else {
                return Client::response(1, 'tasks found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, null, $ex);
        }
    }

    public function getTaskById(Request $request, $taskId)
    {
        try {
            $data = TaskModel::getById($taskId);
            if ($data->isEmpty()) {
                return Client::response(0, 'task not found', 404, $data);
            } else {
                return Client::response(1, 'task found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function deleteTaskById(Request $request, $taskId)
    {
        try {
            $data = TaskModel::getById($taskId);
            if ($data->isEmpty()) {
                return Client::response(0, 'task not found', 404, $data);
            } else {
                $deleteQuery = TaskModel::deleteTask($taskId);
                return Client::response(1, ' task deleted', 200);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function getProjectAllTasks(Request $request, $projectId){
        try {
            $data = TaskModel::getProjectTasks($projectId);
            if ($data->isEmpty()) {
                return Client::response(0, 'project not found', 404, $data);
            } else {
                return Client::response(1, 'project found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function changeTaskProperties(Request $request, $taskId){
        $task =  [
            'owner' => $request->owner,
            'due_date' => $request->dueDate,
            'project_id' => $request->projectId,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $request->image
        ];
        try {
            $data = TaskModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'tasks not found', 404, $data);
            } else {
                $update = TaskModel::changeProperties($task, $id);
                return Client::response(1, 'updated', 200, $update);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }
}
