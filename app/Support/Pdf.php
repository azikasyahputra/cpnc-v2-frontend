<?php

namespace App\Support;

use Barryvdh\DomPDF\Facade\Pdf as DomPdfFacade;

/**
 * dompdf-backed PDF facade.
 *
 * Controllers call PDF::loadView(...)->setPaper(...)->stream()/download(),
 * which is DomPDF's native API. This thin wrapper keeps the rest of the app
 * resolving PDF through App\Support\Pdf (see config/app.php aliases) without
 * any controller changes.
 */
class Pdf
{
    /** @var string */
    protected $view;

    /** @var array */
    protected $data = [];

    /** @var array */
    protected $mergeData = [];

    /** @var string|array */
    protected $paper = 'a4';

    /** @var string */
    protected $orientation = 'portrait';

    public static function loadView($view, $data = [], $mergeData = [])
    {
        return new static($view, $data, $mergeData);
    }

    public function setPaper($paper, $orientation = 'portrait')
    {
        $this->paper = $paper;
        $this->orientation = $orientation;

        return $this;
    }

    public function stream($filename = 'document.pdf')
    {
        return $this->build()->stream($filename);
    }

    public function download($filename = 'document.pdf')
    {
        return $this->build()->download($filename);
    }

    public function output()
    {
        return $this->build()->output();
    }

    /**
     * Build the DomPDF instance for the configured view/data.
     *
     * @return \Barryvdh\DomPDF\PDF
     */
    protected function build()
    {
        return DomPdfFacade::loadView($this->view, $this->data, $this->mergeData)
            ->setPaper($this->paper, $this->orientation);
    }
}
