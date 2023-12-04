<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Thk\Buscheck;
use App\Models\Admin\Comment;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Post extends Model
{
    use HasFactory;

    protected $fillable = ['post_date','title', 'content', 'photo', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function uploadPhoto(UploadedFile $photo)
    {
        $photoPath = $photo->store('uploads', 'public');
        $this->photo = $photoPath;
        $this->save();
    }

    public function getPhotoUrl()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }

    public function buschecks()
    {
        return $this->belongsTo(Buscheck::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
