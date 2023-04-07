<?php

namespace App\School\Secretary\Enums;

enum ClassRoomErrorMessagesEnum: string
{
    case IDENTIFICATION_REQUIRED = 'identification is required';
    case QUANTITY_OF_VACANCIES_IS_REQUIRED = 'quantity of vacancies is required';
    case CANNOT_CHANGE_CLASS_ROOM_IF_STATUS_CLOSED = 'cannot change class room if status closed';
    case NUMBER_OF_VACANCIES_AVAILABLE_REACHED = 'number of vacancies available reached';
}
