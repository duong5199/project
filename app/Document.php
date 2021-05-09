<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }
}
