<?php

namespace App\School\Secretary\Dto;

use App\School\Secretary\Entities\ClassRoom;
use App\School\Secretary\Enums\ClassRoomStatusEnum;
use App\School\Secretary\Enums\ShiftEnum;
use App\School\Secretary\Exceptions\ClassRoomException;

class ClassRoomDto
{
    public string $id = '';
    public string $status = '';
    public string $openDate = '';
    public string $identification = '';
    public int $numberOfVacancies = 0;
    public string $shift = '';
    public string $level = '';
    public string $localization = '';

    /**
     * @throws ClassRoomException
     */
    public function createEntity(): ClassRoom
    {
        $classRoom = new ClassRoom(
            $this->identification,
            $this->numberOfVacancies,
            ShiftEnum::from($this->shift),
            $this->level
        );

        if ($this->status) {
            $classRoom->changeStatus(ClassRoomStatusEnum::from($this->status));
        }

        if (!empty($this->id)) {
            $classRoom->setId($this->id);
        }

        if (!empty($this->openDate)) {
            $classRoom->changeOpenDate($this->openDate);
        }

        if (!empty($this->localization)) {
            $classRoom->changeLocalization($this->localization);
        }

        if (!empty($this->level)) {
            $classRoom->changeLevel($this->level);
        }

        return $classRoom;
    }
}
