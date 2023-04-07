<?php

namespace App\School\Common\Dto;

use App\School\Common\Enums\PaginationSortEnum;

class PaginationParamsDto
{
    public int $limit = 10;
    public int $offset = 0;
    public PaginationSortEnum $sort = PaginationSortEnum::ASC;
    public string $sortField = 'id';
    public string $search = '';
    /** @var SearchColumnsParamsDto[]  */
    private array $columnSearch = [];

    public function addColumnSearch(array $dataColumn): void
    {
        foreach ($dataColumn as $data) {
            $columnSearchDto = new SearchColumnsParamsDto();
            $columnSearchDto->column = $data['column'];
            $columnSearchDto->value = $data['value'];
            $this->columnSearch[] = $columnSearchDto;
        }
    }

    public function hasColumnSearchParams(): bool
    {
        return count($this->columnSearch) >= 1;
    }

    /** @return SearchColumnsParamsDto[] */
    public function getColumnsSearch(): array
    {
        return $this->columnSearch;
    }
}
