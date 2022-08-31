<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopupPackage extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'packages';
}
