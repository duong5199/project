<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'name',
        'type',
        'date_active',
        'date_expired',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
