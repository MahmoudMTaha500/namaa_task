<?php

namespace App\Services\Filter;

use App\Services\Interface\FilteringInterface;

class DataFilterManager implements FilteringInterface
{
    private array $filters = [];

    /**
     * Add a filter to the context.
     *
     * @param FilteringInterface $filter The filter to be added.
     */
    public function addFilter(FilteringInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    /**
     * Apply filters to the given data.
     *
     * @param array $data The data to be filtered.
     * @param Request $request The incoming HTTP request.
     * @return array The filtered data.
     */
    public function filter( $data,  $request): array
    {
        foreach ($this->filters as $filter) {
            $data = $filter->filter($data, $request);
        }
        return $data;
    }
    public static function getNames(): array
    {
        return [
             "DataProviderX", "DataProviderY"
        ];
    }
}
