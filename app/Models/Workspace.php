<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'lokasi',
        'bising',
    ];

    public function jabatan(){
        return $this->hasMany(Jabatan::class);
    }
}
