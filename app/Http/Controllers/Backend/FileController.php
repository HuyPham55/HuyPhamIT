<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends BaseController
{
    //
    use HttpResponses;

    private string $disk = "public_relative";

    public function getList(Request $request) {
        return view('admin.files.list');
    }

    public function postImage(Request $request)
    {
        $disk = $this->disk;
        $directoryPrefix = config("filesystems.disks." . $disk . ".url");

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,ico,svg'
        ]);

        $file = $request->file('image');

        $fileName = alphanumericFileName($file->getClientOriginalName());

        $directory = $request->has('path')
            ? $request->input('path')
            : "photos/shares";
        $path = Storage::disk($disk)
            ->putFileAs(
                $directory, $file, $fileName
            );
        $relativePath = $directoryPrefix . "/" . $path;
        return $this->success([
            'path' => $relativePath
        ]);

    }
}
