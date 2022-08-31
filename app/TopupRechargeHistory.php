<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopupRechargeHistory extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'end_user_recharge_histories';
}