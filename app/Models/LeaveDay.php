<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDay extends Model
{
    use HasFactory;

    public function leaveDays()
{
    return $this->hasMany(LeaveDay::class);
}
}

