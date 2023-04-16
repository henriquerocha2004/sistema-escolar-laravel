<?php

namespace App\Models;

use App\School\Secretary\Enums\ClassRoomStatusEnum;
use App\School\Secretary\Enums\ShiftEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $identification
 * @property mixed $number_of_vacancies
 * @property mixed $shift
 * @property mixed $level
 * @property mixed $localization
 * @property mixed $vacancies_occupied
 * @property mixed $status
 * @property mixed $open_date
 * @property mixed $id
 * @method static first()
 */
class ClassRoomModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $table = 'classroom';

    protected $casts = [
        'status' => ClassRoomStatusEnum::class,
        'shift' => ShiftEnum::class,
    ];

    protected $fillable = [
        'id',
        'identification',
        'number_of_vacancies',
        'shift',
        'level',
        'localization',
        'vacancies_occupied',
        'status',
        'open_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
