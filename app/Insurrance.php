<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurrance extends Model
{
    protected $table = 'insurrances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'code',
        'bhxh',
        'bhyt',
        'address_active',
        'date_active',
        'date_expired',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
