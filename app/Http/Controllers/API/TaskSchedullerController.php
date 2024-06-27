<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\JsonResponse;


class TaskSchedullerController extends Controller
{
    /**
     * @param Illuminate\Http\Request
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function storeSchedule(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, 'error' => $validator->errors()]);
        }
        try {
            $task = Task::create(['title' => $request->title]);
            return AppBaseController::success("Task List.", $task);
        } catch (Exception $e) {
            return AppBaseController::error($e->getMessage());
        }
    }

    /** @return Illuminate\Contracts\Routing\ResponseFactory::json */
    public function listSchedule(): JsonResponse
    {
        try {
            $tasks = Task::latest()->get();
            return AppBaseController::success("All Task List.", $tasks);
        } catch (Exception $e) {
            return AppBaseController::error($e->getMessage());
        }
    }

    /**
     * @param Illuminate\Http\Request
     * @param mixed $id
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function updateSchedule(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        try {
            $existTask = Task::find($id);
            if ($existTask) {
                $existTask->update(['title' => $request->title]);
                $updatedTask = Task::find($id);
                return AppBaseController::success("Task update.", $updatedTask);
            } else {
                return AppBaseController::error("The task is not found");
            }
        } catch (Exception $e) {
            return AppBaseController::error($e->getMessage());
        }
    }

    /**
     * @param mixed $id
     * @return Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function deleteSchedule($id = null)
    {
        if ($id == null) {
            return AppBaseController::error("Please id filed is required.");
        }
        try {
            $existTask = Task::find($id);
            if ($existTask) {
                $existTask->delete();
                return AppBaseController::success("Task deleted.");
            } else {
                return AppBaseController::error("Task not found for delete record.");
            }
        } catch (Exception $e) {
            return AppBaseController::error($e->getMessage());
        }
    }

    /** @return Illuminate\Contracts\Routing\ResponseFactory::json  */
    public function deleteAllTask()
    {
        try {
            Task::truncate();
            return AppBaseController::success("All Tasks deleted.");
        } catch (Exception $e) {
            return AppBaseController::error($e->getMessage());
        }
    }
}
