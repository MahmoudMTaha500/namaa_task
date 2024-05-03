<?php

namespace App\Services\Interface;

interface FilteringInterface
{
    public function filter( $data,  $request): array;
}
