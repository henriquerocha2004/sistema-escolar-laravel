<?php

namespace App\School\Secretary\Actions;

use App\School\Common\Dto\OutputDto;
use App\School\Common\Dto\PaginationParamsDto;
use App\School\Secretary\Dto\ClassRoomDto;
use App\School\Secretary\Repository\ClassRoomRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Throwable;

class ClassRoomActions
{
    public function __construct(
        private readonly ClassRoomRepositoryInterface $repository
    ) {
    }

    public function create(ClassRoomDto $classRoomDto): OutPutDto
    {
        $outPut = new OutPutDto();
        try {
            $this->repository->create($classRoomDto->createEntity());
            $outPut->status = 'OK';
            $outPut->message = 'classroom created with success';
        } catch (Throwable $throwable) {
            Log::error('failed to create classroom', [
                'message' => $throwable->getMessage(),
            ]);

            $outPut->error = true;
            $outPut->message = 'failed to create classroom';
        }

        return $outPut;
    }
    public function update(ClassRoomDto $classRoomDto): OutPutDto
    {
        $outPut = new OutPutDto();
        try {
            $this->repository->update($classRoomDto->createEntity());
            $outPut->status = 'OK';
            $outPut->message = 'classroom updated with success';
        } catch (Throwable $throwable) {
            Log::error('failed to create classroom', [
                'message' => $throwable->getMessage(),
            ]);
            $outPut->error = true;
            $outPut->message = 'failed to updated classroom';
        }

        return $outPut;
    }

    public function delete(string $id): OutPutDto
    {
        $outPut = new OutPutDto();
        try {
            $this->repository->delete($id);
            $outPut->status = 'OK';
            $outPut->message = 'classroom deleted with success';
        } catch (Throwable $throwable) {
            Log::error('failed to create classroom', [
                'message' => $throwable->getMessage(),
            ]);
            $outPut->error = true;
            $outPut->message = 'failed to deleted classroom';
        }

        return $outPut;
    }

    public function findById(string $id): OutPutDto
    {
        $outPut = new OutPutDto();
        try {
            $classRoom = $this->repository->findById($id);
            $outPut->status = 'OK';
            $outPut->data = $classRoom->toArray();
        } catch (Throwable $throwable) {
            Log::error('failed to create classroom', [
                'message' => $throwable->getMessage(),
            ]);
            $outPut->error = true;
            $outPut->message = 'failed to retrieve classroom';
        }

        return $outPut;
    }

    public function findAll(PaginationParamsDto $paginator): OutPutDto
    {
        $outPut = new OutPutDto();
        try {
            $result = $this->repository->findAll($paginator);
            $outPut->status = 'OK';
            $outPut->data = $result->toArray();
        } catch (Throwable $throwable) {
            Log::error('failed to create classroom', [
                'message' => $throwable->getMessage(),
            ]);
            $outPut->error = true;
            $outPut->message = 'failed to retrieve classrooms';
        }

        return $outPut;
    }
}
