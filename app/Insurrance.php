<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Insurrance extends Model
{
    use Notifiable;

    protected $table = 'insurrance';

    protected $primaryKey = 'insurrance_id';

}
