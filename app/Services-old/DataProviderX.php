<?php

namespace App\Services;

use App\Services\Interface\DataProviderInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Services\FileReader;
class DataProviderX  implements DataProviderInterface
{

    protected array $statusCode = [
        '1' => 'authorised',
        '2' => 'decline',
        '3' => 'refunded'
    ];

    /**
     * Get data from DataProviderX.
     *
     * @return array The data from DataProviderX.
     */
    public function getData(): array
    {
        $filePath = storage_path('DataProviderX.json');
        $dataProviderX = FileReader::read($filePath);
        return $this->transformData($dataProviderX);
    }

    /**
     * Transform raw data from DataProviderX.
     *
     * @param array $data The raw data from DataProviderX.
     * @return array The transformed data.
     */
    private function transformData(array $data): array
    {
        return array_map(function ($item) {
            return [
                'parentEmail' => $item['parentEmail'],
                'amount' => $item['parentAmount'],
                'currency' => $item['Currency'],
                'status' => $this->statusCode[$item['statusCode']],
                'created_at' => $item['registerationDate'],
                'id' => $item['parentIdentification'],
                'provider' => 'DataProviderX',
            ];
        }, $data);
    }
}
