<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['task_title', 'task_description', 'employee_name', 'task_status'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
