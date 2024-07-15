<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;

    protected $table = "usages";
    protected $fillable = ['user_id', 'month', 'year', 'start_meter', 'end_meter'];
    protected $guard = [] ;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bills() {
        return $this->hasMany(Bill::class);
    }
}
