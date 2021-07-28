<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'office_id',
        'user_id_auth',
        'user_id_finance',
        'user_id_pjb_finance',
        'num_validate',
        'nomor',
        'transportasi',
        'dasar',
        'acara',
        'cost',
        'from',
        'place_name',
        'to',
        'date_start',
        'date_end',
        'place_issue',
        'date_issue',
        'redaktur',
        'user_id',
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_auth()
    {
        return $this->belongsTo(User::class, 'user_id_auth');
    }

    public function user_finance()
    {
        return $this->belongsTo(User::class, 'user_id_finance');
    }

    public function user_pjb_finance()
    {
        return $this->belongsTo(User::class, 'user_id_pjb_finance');
    }
}
