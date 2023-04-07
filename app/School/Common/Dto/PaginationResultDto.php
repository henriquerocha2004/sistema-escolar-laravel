<?php

namespace App\School\Common\Dto;

class PaginationResultDto
{
    public int $totalRecords = 0;
    public array $data = [];

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'total_records' => $this->totalRecords,
        ];
    }
}
