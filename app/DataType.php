<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DataType extends Model
{
    use Notifiable;

    protected $table = 'data_type';

    protected $primaryKey = 'data_id';

}
