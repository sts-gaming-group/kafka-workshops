<?php

namespace App\Producer;

class ExampleDto
{
    public int $id;

    /**
     * @param $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
}