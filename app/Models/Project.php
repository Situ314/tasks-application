<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description'
    ];

    public function tasks(){
        return $this->hasMany(Task::class,'project_id','id');
    }

    public function tasks_completed(){
        return $this->tasks()->where('status_id','=', 3);
    }

    public function get_completion(){
        $tasks = $this->tasks()->count();
        $completed = $this->tasks_completed()->count();

        return $completed * 100 / $tasks;
    }
}
