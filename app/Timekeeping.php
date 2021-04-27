<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Timekeeping extends Model
{
    use Notifiable;

    protected $table = 'timekeeping_detail';

    protected $primaryKey = 'timekeeping_id';

}
