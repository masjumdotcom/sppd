<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'jabatan',
        'pangkat',
        'status',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
