<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFolders extends Model
{
    protected $fillable = ['created_by', 'permission_id', 'folder_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function permissions()
    {
        return $this->belongsTo(Permissions::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
    public function files()
    {
        return $this->hasMany(Files::class);
    }

}
