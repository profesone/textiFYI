<?php

namespace App\Http\Livewire\TextifyiNumber;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\TextifyiNumber;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithSorting, WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'textifyi_numbers',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'textifyi_numbers';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new TextifyiNumber())->orderable;
    }

    public function render()
    {
        $query = TextifyiNumber::with(['agency'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $textifyiNumbers = $query->paginate($this->perPage);

        return view('livewire.textifyi-number.index', compact('query', 'textifyiNumbers'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('textifyi_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TextifyiNumber::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(TextifyiNumber $textifyiNumber)
    {
        abort_if(Gate::denies('textifyi_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $textifyiNumber->delete();
    }
}
