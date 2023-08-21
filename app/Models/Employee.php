<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
        protected $fillable = ['fname', 'lname','company','email', 'phone'];

    public function company_details()
    {
        return $this->belongsTo(Company::class,'company');
    }
}
