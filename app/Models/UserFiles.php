<?php

namespace App\Models;

use Illuminate\Http\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFiles extends Model
{
    use HasFactory;

    protected $table = 'user_files';
    protected $fillable = ['created_by', 'permission_id', 'file_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function permissions()
    {
        return $this->belongsTo(Permissions::class);
    }
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
}
