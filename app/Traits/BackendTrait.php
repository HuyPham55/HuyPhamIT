<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

trait BackendTrait
{
    public function postAdd(Request $request): RedirectResponse
    {
        $begin = microtime(true);
        $flag = $this->model->saveModel($this->model, $request);
        $duration = microtime(true) - $begin;
        $ms = round($duration * 1000, 1);
        if ($flag instanceof \Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'flash_message' => env("APP_DEBUG") ? $flag->getMessage() : trans('label.something_went_wrong')
                ]);
        }
        $this->forgetCache();
        return redirect()->route($this->routeList)->with([
            'status' => 'success',
            'flash_message' => trans('label.notification.success') . " ({$ms}ms)"
        ]);
    }

    public function putEdit(Request $request, int $id): RedirectResponse
    {
        $begin = microtime(true);
        $model = $this->model->findOrFail($id);
        $flag = $this->model->saveModel($model, $request);
        $duration = microtime(true) - $begin;
        $ms = round($duration * 1000, 1);
        if ($flag instanceof \Exception) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'flash_message' => env("APP_DEBUG") ? $flag->getMessage() : trans('label.something_went_wrong')
                ]);
        }
        $this->forgetCache();
        return redirect()->intended(route($this->routeList))->with([
            'status' => 'success',
            'flash_message' => trans('label.notification.success') . " ({$ms}ms)"
        ]);
    }

    public function delete(Request $request)
    {
        $model = $this->model::findOrFail($request->post('item_id'));
        DB::beginTransaction();
        try {
            $flag = $model->delete();
            if ($flag) {
                DB::commit();
                $this->forgetCache();
                return $this->success(trans('label.deleted'));
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->error($exception->getMessage());
        }
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $this->validate($request, [
            'field' => 'required|in:status',
            'item_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $field = $request->post('field');
        $itemId = $request->post('item_id');
        $status = $request->post('status');

        if (in_array($status, [0, 1])) {
            $model = $this->model->findOrFail($itemId);
            $model->{$field} = $status;
            $model->save();
            $this->forgetCache();

            return $this->success();
        }
        return $this->error();
    }

    public function changeSorting(Request $request): JsonResponse
    {
        $this->validate($request, [
            'item_id' => 'required|integer',
            'sorting' => 'required|integer|min:0|integer',
        ]);

        try {
            $model = $this->model->findOrFail($request->integer('item_id'));
            $model->sorting = $request->integer('sorting');
            $model->save();
            $this->forgetCache();

            return $this->success();
        } catch (\Exception $exception) {
            return $this->error();
        }
    }

    protected function forgetCache()
    {

    }

    protected function success(string $title = "", string $message = ""): JsonResponse
    {
        $title = $title ?: __('label.notification.success');
        $message = $message ?: __('label.notification.success');
        return response()->json([
            'status' => 'success',
            'title' => $title,
            'message' => $message
        ]);
    }

    protected function error(string $title = "", string $message = ""): JsonResponse
    {
        $title = $title ?: __('label.error');
        $message = $message ?: trans('label.something_went_wrong');
        return response()->json([
            'status' => 'error',
            'title' => $title,
            'message' => $message
        ]);
    }
}
