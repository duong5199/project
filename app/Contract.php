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

    static public function LABEL_TYPE($value = null)
    {
        if (!empty($value)) {
            $label = '';
            switch ($value) {
                case 1:
                    $label = 'Không thời hạn';
                    break;
                case 2:
                    $label = 'Có thời hạn';
                    break;
                case 3:
                    $label = 'Thực tập';
                    break;
                case 4:
                    $label = 'Cộng tác viên';
                    break;
            }
            return $label;
        }
        return [
            1 => 'Không thời hạn',
            2 => 'Có thời hạn',
            3 => 'Thực tập',
            4 => 'Cộng tác viên'
        ];
    }
}
