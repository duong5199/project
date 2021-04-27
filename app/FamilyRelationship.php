<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FamilyRelationship extends Model
{
    use Notifiable;

    protected $table = 'family_relationship';

    protected $primaryKey = 'family_relationship_id';

}
