<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Notifications\Notifiable;

class BatakChars extends Model
{
    use Uuids, Notifiable;
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'char_name',
        'class',
        'unicode',
        'image'
    ];
}
