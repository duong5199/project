<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employees extends Model
{
    use Notifiable;

    protected $table = 'employees';

    protected $primaryKey = 'employee_id';

}
