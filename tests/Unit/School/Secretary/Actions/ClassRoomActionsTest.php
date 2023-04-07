<?php

use App\Repository\ClassRoomRepository;
use App\School\Secretary\Actions\ClassRoomActions;
use App\School\Secretary\Dto\ClassRoomDto;

test('should create classroom', function () {
    $dto = new ClassRoomDto();
    $dto->identification = 'ROOM_A3';
    $dto->level = 'GRUPO 01';
    $dto->numberOfVacancies = 25;
    $dto->shift = 'morning';

    $repository = $this->createMock(ClassRoomRepository::class);
    $repository->expects($this->once())
        ->method('create');

    $action = new ClassRoomActions($repository);
    $output = $action->create($dto);
    expect($output->status)
        ->toBe('OK')
        ->and($output->error)
        ->toBe(false);
});
