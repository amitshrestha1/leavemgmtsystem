<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedMode extends Model
{
    use HasFactory;

    protected $fillable=[
        'mode_id',
        'status',
    ];

    public function holidaymode(){
        return $this->belongsTo(HolidayMode::class,'mode_id');
    }
}
