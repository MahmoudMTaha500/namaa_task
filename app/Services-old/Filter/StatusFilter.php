<?php

namespace App\Services\Filter;

use App\Services\Interface\FilteringInterface;

class StatusFilter implements FilteringInterface
{
    /**
     * Filter data based on status code.
     *
     * @param array $data The data to be filtered.
     * @param $request.
     * @return array The filtered data.
     */
    public function filter($data, $request): array
    {
        $statusCode = $request['statusCode'];

        if ($statusCode) {
            return $this->applyStatusCodeFilter($data, $statusCode);
        }

        return $data;
    }

    /**
     * Apply status code filter to the data.
     *
     * @param array $data The data to be filtered.
     * @param string $statusCode The status code to filter by.
     * @return array The filtered data.
     */
    private function applyStatusCodeFilter(array $data, string $statusCode): array
    {
        return array_filter($data, function($item) use ($statusCode) {
            return $item['status'] == $statusCode;
        });
    }
}
