<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['description', 'tarefa_id'];
    public function tarefa()
    {
        return $this->belongsTo('App\Models\Tarefa\Tarefa', 'tarefa_id');
    }
}
