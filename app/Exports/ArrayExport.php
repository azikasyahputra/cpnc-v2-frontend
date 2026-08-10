<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

/**
 * Generic XLSX export built from a pre-assembled array of rows.
 *
 * Replaces the removed maatwebsite/excel 2.x flow:
 *   Excel::create($name, fn) -> $excel->sheet(...)->fromArray(...)->download('xlsx')
 *
 * Heading rows (if any) are expected to already be the first row(s) of $rows.
 */
class ArrayExport implements FromArray, WithTitle
{
    /** @var array */
    protected $rows;

    /** @var string */
    protected $title;

    /** @var string */
    protected $sheetTitle;

    /**
     * @param  array  $rows  full worksheet grid (headings + data rows)
     * @param  string  $title  spreadsheet filename/description
     * @param  string  $sheetTitle  worksheet name (<= 31 chars)
     */
    public function __construct(array $rows, string $title, string $sheetTitle = 'Sheet1')
    {
        $this->rows = $rows;
        $this->title = $title;
        $this->sheetTitle = $sheetTitle;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->rows;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->sheetTitle;
    }
}
