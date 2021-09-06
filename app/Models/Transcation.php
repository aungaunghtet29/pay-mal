<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transcation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userTranscation(){
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function transcationSource(){
       return  $this->belongsTo(User::class , 'source_id' , 'id');
    }
}
