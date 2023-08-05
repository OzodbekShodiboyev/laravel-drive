<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['name', 'parent_folder_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentFolder()
    {
        return $this->belongsTo(Folder::class, 'parent_folder_id');
    }

    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_folder_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
