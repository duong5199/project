<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class WorkProcess extends Model
{
    use Notifiable;

    protected $table = 'work_process';

    protected $primaryKey = 'work_process_id';

}
