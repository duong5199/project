<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Praise_discipline extends Model
{
    use Notifiable;

    protected $table = 'praise_discipline';

    protected $primaryKey = 'praise_discipline_id';

}
