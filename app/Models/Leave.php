<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Leave extends Model
{
    use HasFactory;
    protected $fillable=[
        'type_id',
        'type',
        'reason',
        'from',
        'to',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function types(){

        return $this->belongsTo(LeaveType::class,'type_id');
    }
}