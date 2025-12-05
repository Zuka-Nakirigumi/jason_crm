<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Project extends Model
{
    protected $fillable = ['lead_id','title','description','owner_id','manager_id','approval_status','manager_notes'];

    public function lead(){ return $this->belongsTo(Lead::class); }
    public function owner(){ return $this->belongsTo(User::class,'owner_id'); }
    public function manager(){ return $this->belongsTo(User::class,'manager_id'); }
    public function services(){ return $this->belongsToMany(Service::class,'project_service')->withPivot('quantity','unit_price')->withTimestamps(); }
}


