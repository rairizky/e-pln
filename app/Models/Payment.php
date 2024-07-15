<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";
    protected $fillable = ['bill_id', 'user_id', 'datetime', 'admin_charge', 'total_payment'];
    protected $guard = [] ;

    public function bill()
    {
        return $this->belongsTo(Bill::class, "bill_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
