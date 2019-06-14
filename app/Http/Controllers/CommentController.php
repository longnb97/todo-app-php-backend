<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment as CommentModel;
use App\Helpers\DebugService as Console;
use App\Helpers\ResponseService as Client;

class CommentController extends Controller
{
    // [
    //     'account_id' => 1,
    //     //'type' => 'text',
    //     'content' => 'lam ngu vcl, dap hết đi làm lại đê',
    //     'task_id' => 1,
    // ]

    public function createTaskComment(Request $request)
    {
        $comment =  [
            'account_id' => $request->account_id,
            'type' => $request->type,
            'content' => $request->content,
            'task_id' => $request->task_id
        ];
        try {
            $data = CommentModel::createComment($comment);
            Console::log('1111111');
            return Client::response(1, 'comment created', 201, $data);
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, null, $ex);
        }
    }

    public function getAllComments(Request $request)
    {
        try {
            $data = CommentModel::getAll();
            if ($data->isEmpty()) {
                return Client::response(0, 'comments not found', 404, $data);
            } else {
                return Client::response(1, 'comment found', 200, $data);
            }
        } catch (QueryException $ex) {
            $response = $this->message(0, 'error', 500, null, $ex);
        }
    }

    public function getCommentById(Request $request, $id)
    {
        try {
            $data = CommentModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'comment not found', 404, $data);
            } else {
                return Client::response(1, 'comment found', 200, $data);
            }
        } catch (QueryException $ex) {
            return ResponseSClientervice::response(0, 'error', 500, [], $ex);
        }
    }
    public function deleteCommentById(Request $request, $id)
    {
        //Console::log('aaa');
        try {
            $data = CommentModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'comment not found', 404, $data);
            } else {
                $deleteQuery = CommentModel::deleteComment($id);
                return Client::response(1, 'deleted', 200);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    //xem lai
    public function getAccountAllComments(Request $request, $userId)
    {
        try {
            $data = CommentModel::getAccountComments($userId);
            if ($data->isEmpty()) {
                return Client::response(0, 'comments not found', 404, $data);
            } else {
                return Client::response(1, 'comments found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function getTaskAllComments(Request $request, $taskId)
    {
        try {
            $data = CommentModel::getTaskComments($taskId);
            if ($data->isEmpty()) {
                return Client::response(0, 'comments not found', 404, $data);
            } else {
                return Client::response(1, 'comments found', 200, $data);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }

    public function changeCommentProperties(Request $request, $id)
    {
        $project =  [
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'account_id' => $request->accountId,
            'due_date' => $request->dueDate,
        ];
        try {
            $data = CommentModel::getById($id);
            if ($data->isEmpty()) {
                return Client::response(0, 'comments not found', 404, $data);
            } else {
                $update = CommentModel::changeProperties($project, $id);
                return Client::response(1, 'updated', 200, $update);
            }
        } catch (QueryException $ex) {
            return Client::response(0, 'error', 500, [], $ex);
        }
    }
}
