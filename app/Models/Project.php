<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

  
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'user_projects', 'project_id', 'user_id')
                    ->withPivot('role');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects')
                    ->withPivot('role');
    }
}
