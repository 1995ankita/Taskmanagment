<?php

namespace App\Models;

use App\Models\UserFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Files extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $fillable = [
        'uuid',
        'folder_id',
        'path',
        'name',
        'display_name',
        'extension',
        'created_by', // Add created_by to the fillable array
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function permissions()
    {
        return $this->hasMany(UserFiles::class, 'file_id');
    }
}
