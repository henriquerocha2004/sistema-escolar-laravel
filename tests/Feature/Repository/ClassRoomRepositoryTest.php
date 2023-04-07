<?php

use App\Models\ClassRoomModel;
use App\Repository\ClassRoomRepository;
use App\School\Common\Dto\PaginationParamsDto;
use App\School\Common\Enums\PaginationSortEnum;
use App\School\Secretary\Entities\ClassRoom;
use App\School\Secretary\Enums\ShiftEnum;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should create classroom in database', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );

    $repository = new ClassRoomRepository();
    $repository->create($classRoom);
    $this->assertDataBaseHas('classroom', $classRoom->toArray());
});

test('should update classroom', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );

    $repository = new ClassRoomRepository();
    $repository->create($classRoom);

    $classRoomModel = ClassRoomModel::query()->first();
    $classRoom->setId($classRoomModel->id);
    $classRoom->changeLevel('GRUPO 02');

    $repository->update($classRoom);

    $this->assertDatabaseHas('classroom', $classRoom->toArray());
});

test('should delete classroom', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );

    $repository = new ClassRoomRepository();
    $repository->create($classRoom);
    $classRoomModel = ClassRoomModel::query()->first();

    $repository->delete($classRoomModel->id);

    $this->assertEmpty(ClassRoomModel::query()->first());
});

test('should return classroom by Id', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );

    $repository = new ClassRoomRepository();
    $repository->create($classRoom);
    $classRoomModel = ClassRoomModel::first();

    $classRoomRepo = $repository->findById($classRoomModel->id);
    $classArray = $classRoom->toArray();
    $classArrayRepo = $classRoomRepo->toArray();
    $this->assertEquals($classArray, $classArrayRepo);
});

test('should test search classroom with pagination', function () {
    ClassRoomModel::factory()->count(50)->create();

    $repository = new ClassRoomRepository();
    $paginationDto = new PaginationParamsDto();

    $result = $repository->findAll($paginationDto);
    expect($result->totalRecords)->toBe(50)
        ->and($result->data)->toHaveCount(10);
});
