<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = "bills";
    protected $fillable = ['usage_id', 'user_id', 'month', 'year', 'total_meter', 'status'];
    protected $guard = [] ;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function usage()
    {
        return $this->belongsTo(Usage::class, 'usage_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
