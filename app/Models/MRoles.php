<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MRoles extends Model
{
    use HasFactory;
    protected $table    = 'roles';
    protected $fillable = ['name'];
}
