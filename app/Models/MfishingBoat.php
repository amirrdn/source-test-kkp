<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MfishingBoat extends Model
{
    use HasFactory;

    protected $table    = 'fishing_boat';
    protected $fillable = ['boat_code', 'boat_name', 'address', 'size_boat', 'captain', 'member_count', 'images', 'license_number', 'status', 'reasson', 'user_id'];
}
