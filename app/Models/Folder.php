<?php

namespace App\Models;

use Illuminate\Http\File;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';
    protected $fillable = [
        'name',
        'parent_id',
        'created_by',
        // Add user_id column
        // Add other columns as needed
    ];

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'user_folders', 'folder_id', 'permission_id')
            ->withPivot('created_by');
    }
    // public function userFolders()
    // {
    //     return $this->hasMany(UserFolders::class, 'folder_id');
    // }
    // public function creator()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }
}
