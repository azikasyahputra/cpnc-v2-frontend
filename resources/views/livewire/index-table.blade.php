@php
    $lastIdx = count($columns) - 1;
    $filterable = array_values(array_filter($columns, function ($col) {
        return isset($col['filter']);
    }));
@endphp

<div>
@if (count($filterable) > 0)
<div class="card mb-3">
    <div class="card-body">
        <div class="row g-3">
            @foreach ($filterable as $column)
                <div class="col-md-3 col-sm-6">
                    <label class="form-label mb-1">{{ $column['label'] }}</label>
                    <input type="text" wire:model.debounce.500ms="filters.{{ $column['name'] }}" class="form-control form-control-sm" placeholder="{{ $column['label'] }}">
                </div>
            @endforeach
            <div class="col-md-2 col-sm-6 d-flex align-items-end gap-2">
                <button type="button" wire:click="search" class="btn btn-sm btn-primary"><i class="bx bx-search me-1"></i>Search</button>
                <button type="button" wire:click="resetFilters" class="btn btn-sm btn-outline-secondary"><i class="bx bx-reset me-1"></i>Reset</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-1">
                    <small class="text-dark">Show</small>
                    <select wire:model="perPage" class="form-select form-select-sm" style="width:80px;">
                        @foreach ($per_page_options as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                @foreach ($toolbar_buttons as $button)
                    <a href="{{ $button['url'] }}" class="btn btn-sm {{ $button['class'] ?? 'btn-secondary' }}">{!! $button['label'] !!}</a>
                @endforeach
            </div>
            <div class="d-flex align-items-center gap-3 ms-md-auto">
                @if ($add_button)
                    <a href="{{ $add_button['url'] }}" class="btn btn-sm btn-primary">
                        <i class="bx bx-plus me-1"></i>{{ $add_button['label'] }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover" id="{{ $id }}">
            <thead style="background-color: #696cff;">
                <tr>
                    @foreach ($columns as $i => $column)
                        <th class="text-white" style="font-weight:600;font-size:12px;{{ isset($column['width']) ? 'width:'.$column['width'].';' : '' }}{{ $i === $lastIdx && $column['name'] === 'Action' ? 'position:sticky;right:0;background:#696cff;box-shadow:inset 0 0 0 9999px #696cff;z-index:2;' : '' }}">
                            @if (! empty($column['sortable']))
                                <a href="#" wire:click.prevent="sortBy('{{ $column['name'] }}')" class="text-white">{{ $column['label'] }}
                                    @if ($sort === $column['name'])
                                        <i class="bx bx-sort-{{ $dir === 'desc' ? 'desc' : 'asc' }}"></i>
                                    @endif
                                </a>
                            @else
                                {{ $column['label'] }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($rows as $row)
                    <tr>
                        @foreach ($columns as $i => $column)
                            <td @if ($i === $lastIdx && $column['name'] === 'Action') style="position:sticky;right:0;background:#fff;z-index:1;" @endif>
                                @if (! empty($column['html']))
                                    {!! $column['html']($row) !!}
                                @else
                                    {{ $row->{$column['name']} ?? '' }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="text-center py-5 text-muted">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($total > 0)
    <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="gotoPage(1)"><i class="bx bx-chevrons-left"></i></a>
                </li>
                <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $page - 1 }})"><i class="bx bx-chevron-left"></i></a>
                </li>
                @php
                    $start = max(1, $page - 2);
                    $end = min($lastPage, $start + 4);
                    $start = max(1, $end - 4);
                @endphp
                @for ($p = $start; $p <= $end; $p++)
                    <li class="page-item {{ $p === $page ? 'active' : '' }}">
                        <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $p }})">{{ $p }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $page >= $lastPage ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $page + 1 }})"><i class="bx bx-chevron-right"></i></a>
                </li>
                <li class="page-item {{ $page >= $lastPage ? 'disabled' : '' }}">
                    <a class="page-link" href="#" wire:click.prevent="gotoPage({{ $lastPage }})"><i class="bx bx-chevrons-right"></i></a>
                </li>
            </ul>
        </nav>
        <small class="text-muted">Showing {{ $from }} - {{ $to }} of {{ $total }}</small>
    </div>
    @endif
</div>
</div>
