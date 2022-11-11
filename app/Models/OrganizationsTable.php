<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationsTable extends Model
{
    protected $table = 'Organizations';
    protected $primaryKey = 'OrgID';
    public $timestamps = false;
}
