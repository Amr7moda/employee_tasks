<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ["P_name", "user_id", "created_at"];


    // public function tasks()
    // {
    //     return $this->belongsTo(Task::class);
    // }
}
