<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use App\Traits\BackendTrait;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    //
    use BackendTrait;

    public function __construct(
        protected Contact $model,
        protected string  $pathView = 'admin.contacts',
    )
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $contacts = $this->model
            ->filter($request->all())
            ->orderBy('created_at', 'DESC')
            ->orderBy('id')
            ->paginate();

        if (!session()->has('flash_message')) {
            $inactiveCount = $this->model->where('is_read', 0)->count();
            if ($inactiveCount) {
                session()->flash('flash_message', $inactiveCount . " unread items(s)");
                session()->flash('status', 'warning');
            }
        }

        return view("{$this->pathView}.list", compact('contacts'));
    }

    public function show(Request $request)
    {
        $contact = $this->model::findOrFail($request->input('item_id'));
        $contact->is_read = true;
        $contact->save();

        return view("{$this->pathView}.modal", compact('contact'))->render();
    }

    public function changeFavourite(Request $request)
    {
        $this->validate($request, [
            'field' => 'required|in:favourite',
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
            return $this->success();
        }
        return $this->error();
    }
}
