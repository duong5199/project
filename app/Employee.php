<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'image',
        'address',
        'position_id',
        'department_id',
        'status',
        'salary',
        'allowance',
        'code',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'employee_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class)->withDefault();
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault();
    }

    public function payroll()
    {
        return $this->hasMany(Payroll::class, 'employee_id', 'id');
    }

}
