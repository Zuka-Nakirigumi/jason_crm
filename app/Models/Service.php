<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Service extends Model
{
    protected $fillable = ['name','description','price','active'];
    public function projects(){ return $this->belongsToMany(Project::class, 'project_service')->withPivot('quantity','unit_price')->withTimestamps(); }
    public function subscriptions(){ return $this->hasMany(Subscription::class); }
}


