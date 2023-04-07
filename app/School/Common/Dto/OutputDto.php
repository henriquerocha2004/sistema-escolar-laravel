<?php

namespace App\School\Common\Dto;

class OutputDto
{
    public bool $error = false;
    public string $status = '';
    public string $message = '';
    public array $data = [];
}
