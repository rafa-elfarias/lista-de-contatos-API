<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'company_id', 'name', 'last_name', 'birth_date', 'telephone', 'cell', 'email' 
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
