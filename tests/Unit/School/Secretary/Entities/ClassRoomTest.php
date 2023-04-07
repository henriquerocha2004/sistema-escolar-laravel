<?php

use App\School\Secretary\Entities\ClassRoom;
use App\School\Secretary\Enums\ClassRoomErrorMessagesEnum;
use App\School\Secretary\Enums\ClassRoomStatusEnum;
use App\School\Secretary\Enums\ShiftEnum;
use App\School\Secretary\Exceptions\ClassRoomException;

test('should create class room', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );
    expect($classRoom->toArray())->toHaveCount(9);
});

test('should return error if try create classroom with 0 vacancies', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        0,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );
})->throws(
    ClassRoomException::class,
    ClassRoomErrorMessagesEnum::QUANTITY_OF_VACANCIES_IS_REQUIRED->value
);

test('should return error if there is an attempt to change the quantity of vacancies in classroom closed', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        10,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );
    $classRoom->changeStatus(ClassRoomStatusEnum::CLOSED);
    $classRoom->changeQuantityOfVacancies(20);
})->throws(
    ClassRoomException::class,
    ClassRoomErrorMessagesEnum::CANNOT_CHANGE_CLASS_ROOM_IF_STATUS_CLOSED->value
);

test('should increase quantity of vacancy available', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );

    $classRoom->changeQuantityOfVacancies(5);
    $data = $classRoom->toArray();
    expect($data['number_of_vacancies'])->toBe(5);
});

test('should decrease quantity of vacancies available', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );
    $classRoom->increaseOccupiedVacancies(20);
    $classRoom->decreaseOccupiedVacancies(5);

    $data = $classRoom->toArray();
    expect($data['vacancies_occupied'])->toBe(15);
});

test('should return error if quantity of occupied is greater then quantity of vacancy available', function () {
    $classRoom = new ClassRoom(
        'ES-MT1',
        30,
        ShiftEnum::MORNING,
        'GRUPO 01',
        'Corredor 5'
    );

    $classRoom->increaseOccupiedVacancies(32);
})->throws(
    ClassRoomException::class,
    ClassRoomErrorMessagesEnum::NUMBER_OF_VACANCIES_AVAILABLE_REACHED->value
);
