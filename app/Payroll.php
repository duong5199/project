<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $table = 'payrolls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salary',
        'days',
        'workdays',
        'sub_salary',
        'allowance',
        'ot_salary',
        'ot_hours',
        'ot_ratio',
        'owed_salary',
        'other_fees',
        'bhxh',
        'bhyt',
        'bhtn',
        'tax',
        'total_salary',
        'employee_id',
        'month'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
