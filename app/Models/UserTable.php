<?php
namespace App\Models;

use Database\Factories\UserTableFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;



class UserTable extends Authenticatable
{   
    use HasFactory;
    protected $table = 'Users';
    protected $primaryKey = 'Username';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
