<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Subscription extends Model
{
    protected $fillable = ['user_id','service_id','start_date','end_date','status'];
    public function user(){ return $this->belongsTo(User::class); }
    public function service(){ return $this->belongsTo(Service::class); }
}


