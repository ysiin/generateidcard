<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datakaryawan extends Model
{
    use HasFactory;
    protected $table = 'datakaryawan';
    protected $fillable = ['nama', 'nip', 'foto'];
}
