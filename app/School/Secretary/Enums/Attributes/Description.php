<?php

namespace App\School\Secretary\Enums\Attributes;

use Attribute;

#[Attribute]
class Description
{
    public function __construct(
        public string $description
    ) {
    }
}
