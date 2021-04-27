<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contract extends Model
{
    use Notifiable;

    protected $table = 'contract';

    protected $primaryKey = 'contract_id';

}
