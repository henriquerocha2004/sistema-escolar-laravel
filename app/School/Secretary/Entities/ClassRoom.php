<?php

namespace App\School\Secretary\Entities;

use App\School\Secretary\Enums\ClassRoomErrorMessagesEnum;
use App\School\Secretary\Enums\ClassRoomStatusEnum;
use App\School\Secretary\Enums\ShiftEnum;
use App\School\Secretary\Exceptions\ClassRoomException;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;

class ClassRoom
{
    /**
     * @throws ClassRoomException
     */
    public function __construct(
        private string $identification,
        private int $numberOfVacancies,
        private ShiftEnum $shift,
        private string $level,
        private string $localization = '',
        private int $vacanciesOccupied = 0,
        private ClassRoomStatusEnum $status = ClassRoomStatusEnum::OPEN,
        private DateTimeImmutable $openDate = new DateTimeImmutable('now'),
        private string $id = ''
    ) {
        if (empty($id)) {
            $this->id = Uuid::uuid4();
        }
        $this->validate();
    }

    /**
     * @throws ClassRoomException
     */
    public function changeIdentification(string $newIdentification): void
    {
        $this->checkIfClassRoomIsClosed();
        $this->identification = $newIdentification;
    }

    /**
     * @throws ClassRoomException
     */
    public function changeQuantityOfVacancies(int $value): void
    {
        $this->checkIfClassRoomIsClosed();
        $this->numberOfVacancies = $value;
    }

    public function changeStatus(ClassRoomStatusEnum $status): void
    {
        $this->status = $status;
    }

    /**
     * @throws ClassRoomException
     */
    public function changeLocalization(string $newLocalization): void
    {
        $this->checkIfClassRoomIsClosed();
        $this->localization = $newLocalization;
    }

    /**
     * @throws ClassRoomException
     */
    public function changeLevel(string $newLevel): void
    {
        $this->checkIfClassRoomIsClosed();
        $this->level = $newLevel;
    }

    /**
     * @throws ClassRoomException
     */
    public function changeShift(ShiftEnum $newShift): void
    {
        $this->checkIfClassRoomIsClosed();
        $this->shift = $newShift;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @throws ClassRoomException
     */
    public function increaseOccupiedVacancies(int $value): void
    {
        $this->checkIfClassRoomIsClosed();
        if ($value > $this->numberOfVacancies) {
            throw new ClassRoomException(ClassRoomErrorMessagesEnum::NUMBER_OF_VACANCIES_AVAILABLE_REACHED->value);
        }

        $this->vacanciesOccupied += $value;
    }

    /**
     * @throws ClassRoomException
     */
    public function decreaseOccupiedVacancies(int $value): void
    {
        $this->checkIfClassRoomIsClosed();
        $this->vacanciesOccupied -= $value;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'identification' => $this->identification,
            'vacancies_occupied' => $this->vacanciesOccupied,
            'status' => $this->status->value,
            'open_date' => $this->openDate->format('Y-m-d H:i:s'),
            'number_of_vacancies' => $this->numberOfVacancies,
            'shift' => $this->shift->value,
            'localization' => $this->localization,
            'level' => $this->level,
        ];
    }

    /**
     * @throws ClassRoomException
     * @throws Exception
     */
    public function changeOpenDate(string $date): void
    {
        $this->checkIfClassRoomIsClosed();
        $this->openDate = new DateTimeImmutable($date);
    }

    /**
     * @throws ClassRoomException
     */
    private function checkIfClassRoomIsClosed(): void
    {
        if ($this->status == ClassRoomStatusEnum::CLOSED) {
            throw new ClassRoomException(ClassRoomErrorMessagesEnum::CANNOT_CHANGE_CLASS_ROOM_IF_STATUS_CLOSED->value);
        }
    }

    /**
     * @throws ClassRoomException
     */
    private function validate(): void
    {
        if ($this->numberOfVacancies < 1) {
            throw new ClassRoomException(ClassRoomErrorMessagesEnum::QUANTITY_OF_VACANCIES_IS_REQUIRED->value);
        }
    }
}
