<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static create(array $array)
 */
class Portal extends Authenticatable
{
    protected $table = 'reminder';
    protected $fillable = [
        'idreminder',
        'subject',
        'datescheduling',
        'timescheduling',
        'inputdate',
        'emailpeserta',
        'pesan',
        'kelaspelatihan',
        'status',
        'datetimeschedule',
        'lastsendtime',
        'statusvoucher',
        'errorlog'
    ];
    protected $primaryKey = 'idreminder';
}
