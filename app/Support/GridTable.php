<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Renders a sortable, filterable, paginated HTML table from data returned by
 * the CPNC API (sibling Laravel 13 project). The API already applies
 * pagination, sorting and filtering; this class only formats the result.
 *
 * Expected payload (the API paginator JSON):
 *   { data: [...], total, per_page, current_page, last_page, ... }
 *
 * GET parameters used to render the UI:
 *   page, per_page, sort=<column>&dir=asc|desc, filter[<column>]=<value>
 *
 * Column configuration:
 *   ['name' => 'id_client', 'label' => 'ID', 'width' => '10px', 'sortable' => true]
 *   ['name' => 'nama_client', 'label' => 'Nama', 'sortable' => true,
 *    'filter' => 'master_client.nama_client']        // DB column sent to the API
 *   ['name' => 'Action', 'label' => 'Action', 'html' => fn($row) => ...]
 *
 * Options:
 *   'name'             grid name (used as the <table id>)
 *   'per_page_options' selectable rows per page (default [10,50,100,1000])
 *   'add_button'       ['label' => ..., 'url' => ...] rendered on the right
 *   'toolbar_buttons'  extra buttons in the toolbar
 */
class GridTable
{
    /** @var array decoded API payload */
    protected $payload;

    /** @var array */
    protected $columns;

    /** @var array */
    protected $options;

    public function __construct(array $payload, array $columns, array $options = [])
    {
        $this->payload = $payload;
        $this->columns = $columns;
        $this->options = $options;
    }

    /**
     * Build a table from the API paginator payload.
     */
    public static function fromApi(array $payload, array $columns, array $options = [])
    {
        return new static($payload, $columns, $options);
    }

    /**
     * Render the table HTML.
     */
    public function render(): string
    {
        $request = request();

        // The API returns associative arrays; the blade and the action
        // callbacks expect objects (e.g. $src->id_client).
        $rows = array_map(function ($row) {
            return (object) $row;
        }, $this->payload['data'] ?? []);

        $paginator = new LengthAwarePaginator(
            $rows,
            (int) ($this->payload['total'] ?? count($rows)),
            (int) ($this->payload['per_page'] ?? 15),
            (int) ($this->payload['current_page'] ?? 1),
            ['path' => $request->path(), 'query' => $request->query()]
        );

        $data = [
            'id'              => $this->options['id'] ?? str_replace(' ', '', $this->options['name'] ?? 'grid'),
            'columns'         => $this->columns,
            'paginator'       => $paginator,
            'sort'            => $request->query('sort'),
            'dir'             => in_array(strtolower((string) $request->query('dir', 'asc')), ['asc', 'desc']) ? strtolower((string) $request->query('dir', 'asc')) : 'asc',
            'filters'         => is_array($request->input('filter', [])) ? $request->input('filter', []) : [],
            'per_page_options'=> $this->options['per_page_options'] ?? [10, 50, 100, 1000],
            'sort_urls'       => $this->buildSortUrls($request),
            'add_button'      => $this->options['add_button'] ?? null,
            'toolbar_buttons' => $this->options['toolbar_buttons'] ?? [],
        ];

        return view('layout.partials.grid_table', $data)->render();
    }

    /**
     * Build sort toggle URLs that preserve current filters and per-page setting.
     */
    protected function buildSortUrls($request): array
    {
        $urls = [];
        $currentSort = $request->query('sort');
        $currentDir = strtolower((string) $request->query('dir', 'asc'));

        foreach ($this->columns as $column) {
            if (empty($column['sortable'])) {
                continue;
            }

            $newDir = ($currentSort === $column['name'] && $currentDir === 'asc') ? 'desc' : 'asc';

            $params = $request->except(['page', 'sort', 'dir']);
            $params['sort'] = $column['name'];
            $params['dir'] = $newDir;

            $urls[$column['name']] = $request->url().'?'.http_build_query($params);
        }

        return $urls;
    }
}
