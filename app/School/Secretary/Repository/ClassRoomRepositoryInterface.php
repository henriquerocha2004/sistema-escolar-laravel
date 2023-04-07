<?php

namespace App\School\Secretary\Repository;

use App\School\Common\Dto\PaginationParamsDto;
use App\School\Common\Dto\PaginationResultDto;
use App\School\Secretary\Entities\ClassRoom;

interface ClassRoomRepositoryInterface
{
    public function create(ClassRoom $classRoom): void;
    public function update(ClassRoom $classRoom): void;
    public function delete(string $id): void;
    public function findById(string $id): ClassRoom|null;
    public function findAll(PaginationParamsDto $pagination): PaginationResultDto;
}
