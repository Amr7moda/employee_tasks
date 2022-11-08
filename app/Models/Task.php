<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ["task_name", "project_id", "user_id", "submit", "details"];


    //create relation with forign key in project table
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id','id');
    }

    //create relation with user key in project table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
