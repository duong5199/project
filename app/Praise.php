<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Praise extends Model
{
    protected $table = 'praises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'employee_id',
        'reason',
        'method',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
