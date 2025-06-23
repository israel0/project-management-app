<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;

class Task extends Model
{
    use HasUuid, HasFactory;



    protected $fillable = [
       'id', 'project_id', 'title', 'status', 'due_date'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
