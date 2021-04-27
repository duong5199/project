<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SalaryProcess extends Model
{
    use Notifiable;

    protected $table = 'salary_process';

    protected $primaryKey = 'salary_process_id';

}
