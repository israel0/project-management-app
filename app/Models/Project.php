<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;

class Project extends Model
{
    use HasUuid, HasFactory;

    protected $fillable = [
       'id', 'title', 'description', 'deadline'
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function tasks()
    {
       return $this->hasMany(Task::class);
    }


}
