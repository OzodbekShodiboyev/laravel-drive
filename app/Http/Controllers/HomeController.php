<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $currentFolderId = $request->query('folder_id');
        if ($currentFolderId) {
            $currentFolder = Folder::findOrFail($currentFolderId);
            $filesInCurrentFolder = File::where('folder_id', $currentFolder->id)->get();
        } else {
            // Handle the case where no specific folder is selected
            $currentFolder = null;
            $filesInCurrentFolder = collect(); // Create an empty collection
        }

        $rootFolders = $user->folders()->whereNull('parent_folder_id')->get();
        // $filesInCurrentFolder = File::where('folder_id', $currentFolder->id)->get();

        return view('home', compact('rootFolders', 'currentFolder', 'filesInCurrentFolder'));
    }
}
