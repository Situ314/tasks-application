<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'priority',
        'status_id',
        'start_date',
        'final_date',
        'user_id',
        'project_id'
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'final_date' => 'datetime:Y-m-d',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function status(){
        return $this->belongsTo(Status::class,'status_id','id');
    }
}
