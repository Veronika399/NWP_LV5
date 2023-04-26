<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'naziv_rada', 
        'naziv_rada_en', 
        'zadatak_rada',
        'tip_studija',
        'nastavnik_id',
        'assignee'
    ];

    public function students(){
        return $this->belongsToMany(User::class, "task_user", "task_id", "student_id");
    }

    public function getAssignee(){
        if($this->assignee!=null)
            return User::find($this->assignee);
        return null;
    }
}