<?php

namespace App\Http\Livewire\ClassRoom;

use App\School\Common\Dto\PaginationParamsDto;
use App\School\Common\Enums\PaginationSortEnum;
use App\School\Secretary\Actions\ClassRoomActions;
use App\School\Secretary\Enums\ClassRoomStatusEnum;
use App\School\Secretary\Enums\ShiftEnum;
use Livewire\Component;

class Datatable extends Component
{
    private readonly ClassRoomActions $classRoomActions;
    public string $search = '';
    public int $page = 1;
    public int $limit = 10;
    public $classRooms;
    public string $status = '';
    public string $shift = '';
    public string $academicYear = '';
    public string $situationDesc = 'Status';
    public string $shiftDesc = 'Turno';
    public string $academicYearDesc = 'Ano Letivo';


    public function __construct()
    {
        $this->classRoomActions = app(ClassRoomActions::class);
    }

    /** @var array */
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'limit' => ['except' => 10],
        'status' => ['except' => ''],
        'shift' => ['except' => ''],
        'academicYear' => ['except' => ''],
    ];

    public function render()
    {
        $this->classRooms = $this->getData();
        return view('livewire.class-room.datatable', [
            'situations' => ClassRoomStatusEnum::getFriendlyProperties(),
            'shifts' => ShiftEnum::getFriendlyProperties(),
            'classRooms' => $this->classRooms,
            'academicYears' => $this->getAcademicYears(),
        ]);
    }

    public function convertShift(string $shift): string
    {
        $shift = ShiftEnum::tryFrom($shift);
        return $shift->getFriendlyProperty();
    }

    public function convertStatus(string $status): string
    {
        $status = ClassRoomStatusEnum::tryFrom($status);
        return $status->toTemplateHtml();
    }

    public function search(): void
    {
        $this->classRooms = $this->getData();
    }

    public function setSituation(string $value): void
    {
        $this->status = $value == ClassRoomStatusEnum::ALL->value ? '' : $value;
        $status = ClassRoomStatusEnum::tryFrom($value);
        $friendllyDesc = $status->getFriendlyProperty();
        $this->situationDesc = $friendllyDesc == 'Todos' ? 'Status' : $friendllyDesc;
        $this->search();
    }

    public function setShift(string $value): void
    {
        $this->shift = $value == ShiftEnum::ALL->value ? '' : $value;
        $shift = ShiftEnum::tryFrom($value);
        $friendllyDesc = $shift->getFriendlyProperty();
        $this->shiftDesc = $friendllyDesc == 'Todos' ? 'Turno' : $friendllyDesc;
        $this->search();
    }

    public function setAcademicYear(string $value): void
    {
        $this->academicYear = $this->academicYearDesc =  $value;
        $this->search();
    }

    public function create(): void
    {
        $this->emitTo('class-room.create', 'increment');
    }

    private function mountPagination(): PaginationParamsDto
    {
        $paginationDto = new PaginationParamsDto();
        $paginationDto->limit = $this->limit ?? 10;
        $paginationDto->search = $this->search ?? '';
        $paginationDto->sortField = 'open_date';
        $paginationDto->sort = PaginationSortEnum::DESC;
        $paginationDto->setPage($this->page);

        if (!empty($this->status)) {
            $paginationDto->addColumnSearch([
                'column' => 'status',
                'value' => $this->status,
            ]);
        }

        if (!empty($this->shift)) {
            $paginationDto->addColumnSearch([
                'column' => 'shift',
                'value' => $this->shift,
            ]);
        }

        if (!empty($this->academicYear)) {
            $paginationDto->addColumnSearch([
                'column' => 'academic_year',
                'value' => $this->academicYear,
            ]);
        }

        return $paginationDto;
    }

    private function getAcademicYears(): array
    {
        $result = $this->classRoomActions->getYearsAcademic();
        if ($result->error) {
            return [];
        }

        return $result->data;
    }

    private function getData(): array
    {
        $result = $this->classRoomActions->findAll(
            $this->mountPagination()
        );
        return $result->data;
    }
}
