<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $table = 'disciplines';

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
