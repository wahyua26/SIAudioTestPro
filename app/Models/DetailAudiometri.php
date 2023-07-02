<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAudiometri extends Model
{
    use HasFactory;

    public function audiometri(){
        return $this->belongsTo(Audiometri::class, 'audiometri_id');
    }
}
