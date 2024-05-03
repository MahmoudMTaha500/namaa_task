<?php

namespace App\Services;

use App\Services\Interface\DataProviderInterface;
use Illuminate\Support\Facades\Storage;

class DataProviderY implements DataProviderInterface
{

    protected array $statusCode = [
        '100' => 'authorised',
        '200' => 'decline',
        '300' => 'refunded'
    ];

    /**
     * Get data from DataProviderY.
     *
     * @return array The data from DataProviderY.
     */
    public function getData(): array
    {
        $filePath = storage_path('DataProviderY.json');
        $dataProviderY = FileReader::read($filePath);

        return $this->transformData($dataProviderY);
    }

    /**
     * Transform raw data from DataProviderY.
     *
     * @param array $data The raw data from DataProviderY.
     * @return array The transformed data.
     */
    private function transformData(array $data): array
    {
        return array_map(function ($item) {
            return [
                'parentEmail' => $item['email'],
                'amount' => $item['balance'],
                'currency' => $item['currency'],
                'status' => $this->statusCode[$item['status']],
                'created_at' => $item['created_at'],
                'id' => $item['id'],
                'provider' => 'DataProviderY',
            ];
        }, $data);
    }
}
