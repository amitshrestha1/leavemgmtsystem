<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLeaveBalance extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'user_id',
        'leave_type_id',
        'remaining_days'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function leaveEntitlement()
    {
        return $this->hasOne(LeaveEntitlement::class, 'user_id', 'user_id')
            ->where('leave_type_id', $this->leave_type_id);
    }
}
