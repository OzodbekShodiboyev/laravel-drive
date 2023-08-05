<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $folder = Folder::findOrFail($request->input('folder_id'));

        // Handle file upload and storage
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $filename = $uploadedFile->getClientOriginalName();
            $path = $uploadedFile->store('uploads', 'public'); // Adjust the storage path as needed

            $newFile = new File([
                'name' => $filename,
                'path' => $path,
                'folder_id' => $folder->id,
                'user_id' => $user->id,
            ]);

            $newFile->save();
        }

        return redirect()->route('home', ['folder_id' => $folder->id]);
    }
}
