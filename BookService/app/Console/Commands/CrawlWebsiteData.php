<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CrawlWebsiteData extends Command
{
    protected $signature = 'crawl:website-data';
    
    protected $description = 'Crawl data from website and save to Excel';

    public function handle()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://www.gutenberg.org/');

        $body = $response->getBody()->getContents();

        // Parse the HTML response and extract the data you need
        // For demonstration purposes, let's assume we are extracting book titles

        $pattern = '/<span class="title">(.*?)<\/span>/';
        preg_match_all($pattern, $body, $matches);

        $data = $matches[1];

        // Save the data to an Excel file
        $fileName = 'website_data.xlsx';
        $filePath = public_path($fileName);

        $excelData = new class($data) implements FromCollection, WithHeadings {
            private $data;

            public function __construct($data)
            {
                $this->data = $data;
            }

            public function collection()
            {
                return collect($this->data)->map(function ($item) {
                    return [$item];
                });
            }

            public function headings(): array
            {
                return ['Title'];
            }
        };

        Excel::store($excelData, $fileName);
        
        $this->info('Website data crawled and saved to Excel file: ' . $filePath);
    }
}
