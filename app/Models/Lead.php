<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lead extends Model
{
    protected $fillable = ['name','company','email','phone','notes','status','created_by'];

    public function creator(){ return $this->belongsTo(User::class, 'created_by'); }
    public function project(){ return $this->hasOne(Project::class); }
}

