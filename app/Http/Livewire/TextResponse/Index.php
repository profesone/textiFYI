<?php

namespace App\Http\Livewire\TextResponse;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\TextResponse;
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
            'except' => 'client.client_name',
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

    public function mount($client_name = '')
    {
        $this->sortBy            = 'client.client_name';
        $this->search            = $client_name;
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new TextResponse())->orderable;
    }

    public function render()
    {
        $query = TextResponse::with(['client', 'keywords', 'mainKeyword', 'team'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $textResponses = $query->paginate($this->perPage);

        return view('livewire.text-response.index', compact('query', 'textResponses'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('text_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TextResponse::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(TextResponse $textResponse)
    {
        abort_if(Gate::denies('text_response_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $textResponse->delete();
    }
}
