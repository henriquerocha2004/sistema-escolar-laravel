<?php

namespace App\Repository;

use App\Models\ClassRoomModel;
use App\School\Secretary\Entities\ClassRoom;
use App\School\Common\Dto\PaginationParamsDto;
use App\School\Common\Dto\PaginationResultDto;
use App\School\Secretary\Enums\ClassRoomStatusEnum;
use App\School\Secretary\Enums\ShiftEnum;
use App\School\Secretary\Exceptions\ClassRoomException;
use App\School\Secretary\Repository\ClassRoomRepositoryInterface;
use DateTimeImmutable;
use Exception;

class ClassRoomRepository implements ClassRoomRepositoryInterface
{
    public function create(ClassRoom $classRoom): void
    {
        ClassRoomModel::query()->create($classRoom->toArray());
    }

    public function update(ClassRoom $classRoom): void
    {
        $class = $classRoom->toArray();

        ClassRoomModel::query()
            ->where('id', $class['id'])
            ->update($class);
    }

    public function delete(string $id): void
    {
        ClassRoomModel::query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * @throws ClassRoomException
     * @throws Exception
     */
    public function findById(string $id): ClassRoom|null
    {
        /** @var ClassRoomModel $class */
        $class = ClassRoomModel::query()->find($id);
        if (is_null($class)) {
            return null;
        }

        return new ClassRoom(
            identification: $class->identification,
            numberOfVacancies: $class->number_of_vacancies,
            shift: ShiftEnum::from($class->shift),
            level: $class->level,
            localization: $class->localization,
            vacanciesOccupied: $class->vacancies_occupied,
            status: ClassRoomStatusEnum::from($class->status),
            openDate: new DateTimeImmutable($class->open_date),
            id: $class->id
        );
    }

    public function findAll(PaginationParamsDto $pagination): PaginationResultDto
    {
        $classRom = ClassRoomModel::query()
            ->take($pagination->limit)
            ->offset($pagination->getOffset())
            ->orderBy($pagination->sortField, $pagination->sort->value);

        $classRomCount = ClassRoomModel::query();

        if ($pagination->search) {
            $classRom->where('identification', 'like', "%$pagination->search%")
                ->orWhere('localization', 'like', "%$pagination->search%")
                ->orWhere('level', 'like', "%$pagination->search%");

            $classRomCount->where('identification', 'like', "%$pagination->search%")
                ->orWhere('localization', 'like', "%$pagination->search%")
                ->orWhere('level', 'like', "%$pagination->search%");
        }

        if ($pagination->hasColumnSearchParams()) {
            foreach ($pagination->getColumnsSearch() as $columnSearch) {
                $classRom->where($columnSearch->column, $columnSearch->value);
                $classRomCount->where($columnSearch->column, $columnSearch->value);
            }
        }

        $result = new PaginationResultDto();
        $result->totalRecords = $classRomCount->count();
        $result->data = $classRom->get()->toArray();

        return $result;
    }

    public function getYearsAcademic(): array
    { 
        return ClassRoomModel::query()
            ->distinct()
            ->get('academic_year')
            ->toArray();
    }
}
