<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'address',
        'post_code',
        'contact_phone',
        'contact_email',
        'contact_web',
        'auth_user_id',
        'finance_user_id',
        'pjb_finance_user_id',
        'region',
        'region_sys',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
