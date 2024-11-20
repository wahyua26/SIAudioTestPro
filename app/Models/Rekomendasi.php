<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'bulan',
        'tahun',
        'tingkatBising',
        'rataHasil',
        'rataUsia',
        'rekomendasi',
    ];

    public function workspace(){
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }
}
