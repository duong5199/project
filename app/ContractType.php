<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ContractType extends Model
{
    use Notifiable;

    protected $table = 'contract_type';

    protected $primaryKey = 'contract_type_id';

}
