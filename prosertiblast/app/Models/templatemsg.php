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
class templatemsg extends Authenticatable
{
    protected $table = 'kodevouchercdl2022';
    protected $fillable = [
        'idtemplate',
        'noreg',
        'voucher_code',
        'nama',
        'tema',
        'email',
        'status'
    ];
    protected $primaryKey = 'idtemplate';
    public $timestamps = false;
}
