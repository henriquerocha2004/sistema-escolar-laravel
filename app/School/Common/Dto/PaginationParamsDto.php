<?php

namespace App\School\Common\Dto;

use App\School\Common\Enums\PaginationSortEnum;

class PaginationParamsDto
{
    public int $limit = 10;
    private int $offset = 0;
    public PaginationSortEnum $sort = PaginationSortEnum::ASC;
    public string $sortField = 'id';
    public string $search = '';
    /** @var SearchColumnsParamsDto[]  */
    private array $columnSearch = [];

    public function addColumnSearch(array $dataColumn): void
    {
        $columnSearchDto = new SearchColumnsParamsDto();
        $columnSearchDto->column = $dataColumn['column'];
        $columnSearchDto->value = $dataColumn['value'];
        $this->columnSearch[] = $columnSearchDto;
    }

    public function setPage(int $page): void
    {
        if (empty($page)) {
            return;
        }

        $this->offset = ($page * $this->limit) - $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
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
