<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    public function show($id)
    {
        $folder = Folder::findOrFail($id);
        $subfolders = $folder->subfolders;

        return view('home', compact('folder', 'subfolders'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $newFolder = new Folder([
            'name' => $request->input('name'),
            'parent_folder_id' => $request->input('parent_folder_id'),
            'user_id' => $user->id,
        ]);

        $newFolder->save();

        return redirect()->route('home');
    }
}
