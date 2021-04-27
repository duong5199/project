<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Department extends Model
{
    use Notifiable;

    protected $table = 'department';

    protected $primaryKey = 'department_id';

}
