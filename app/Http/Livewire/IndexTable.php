<?php

namespace App\Http\Livewire;

use App\Support\ApiClient;
use Livewire\Component;

/**
 * Reactive index/table for a CPNC module.
 *
 * Per-module subclasses define the module path, sort, add button and the
 * column config (including action closures) via columns(). The API is the
 * data source: every state change re-fetches a page from ApiClient.
 */
abstract class IndexTable extends Component
{
    /** API path, e.g. 'klien' */
    protected $module;

    /** <table id> */
    protected $name = 'grid';

    /** [column, dir] applied when no sort is requested */
    protected $defaultSort = null;

    /** selectable rows per page */
    protected $perPageOptions = [10, 15, 50, 100, 1000];

    /** current filter values: column => value */
    public $filters = [];

    public $sort = null;

    public $dir = 'asc';

    public $perPage = 15;

    public $page = 1;

    /** grouping filter (order/invoice/trucking group pages) */
    public $group = null;

    /** fetched rows (objects) */
    public $rows = [];

    public $total = 0;

    public $lastPage = 1;

    protected $queryString = [
        'filters' => ['as' => 'filter', 'except' => []],
        'sort' => ['except' => null],
        'dir' => ['except' => 'asc'],
        'perPage' => ['as' => 'per_page', 'except' => 15],
        'page' => ['except' => 1],
        'group' => ['except' => null],
    ];

    /**
     * Column configuration.
     */
    abstract protected function columns(): array;

    /**
     * ['label' => ..., 'url' => ...] rendered top-right (override per module).
     */
    protected function addButton()
    {
        return null;
    }

    /**
     * Extra toolbar buttons: [['label'=>..,'url'=>..,'class'=>..]].
     */
    protected function toolbarButtons()
    {
        return [];
    }

    public function mount()
    {
        if ($this->defaultSort && ! $this->sort) {
            [$this->sort, $this->dir] = $this->defaultSort;
        }
    }

    public function updatedFilters()
    {
        $this->page = 1;
    }

    public function updatedPerPage()
    {
        $this->page = 1;
    }

    public function search()
    {
        $this->page = 1;
    }

    public function resetFilters()
    {
        $this->filters = [];
        $this->page = 1;
    }

    public function sortBy($column)
    {
        if ($this->sort === $column) {
            $this->dir = $this->dir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort = $column;
            $this->dir = 'asc';
        }
        $this->page = 1;
    }

    public function gotoPage($page)
    {
        $this->page = max(1, min((int) $page, (int) $this->lastPage));
    }

    public function render()
    {
        $params = [
            'page' => (int) $this->page,
            'per_page' => (int) $this->perPage,
        ];

        if ($this->sort) {
            $params['sort'] = $this->sort;
            $params['dir'] = $this->dir;
        }

        if ($this->group) {
            $params['group'] = $this->group;
        }

        $filtered = array_filter($this->filters, function ($value) {
            return $value !== '' && $value !== null;
        });

        if ($filtered) {
            $params['filter'] = $filtered;
        }

        $payload = ApiClient::get($this->module, $params);

        $this->rows = array_map(function ($row) {
            return (object) $row;
        }, $payload['data'] ?? []);

        $this->total = (int) ($payload['total'] ?? count($this->rows));
        $this->perPage = (int) ($payload['per_page'] ?? $this->perPage);
        $this->lastPage = max(1, (int) ceil($this->total / max(1, $this->perPage)));
        $this->page = max(1, min((int) ($payload['current_page'] ?? $this->page), $this->lastPage));

        return view('livewire.index-table', [
            'id' => $this->name,
            'columns' => $this->columns(),
            'rows' => $this->rows,
            'sort' => $this->sort,
            'dir' => $this->dir,
            'filters' => $this->filters,
            'per_page_options' => $this->perPageOptions,
            'add_button' => $this->addButton(),
            'toolbar_buttons' => $this->toolbarButtons(),
            'total' => $this->total,
            'from' => $this->total ? ($this->page - 1) * $this->perPage + 1 : null,
            'to' => min($this->total, $this->page * $this->perPage),
            'lastPage' => $this->lastPage,
        ]);
    }
}
