<?php

namespace App\Livewire\Cargo;

use App\Models\Cargo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class CargoList extends Component
{
    use WithPagination;

    // public $cargos;

    protected $paginationTheme = 'bootstrap';
    public $numberRows = 5;

    public $viewName = 'Cargo';

    public $search = '';
    public $active;
    public $sortBy = 'id';
    public $sortAsc = false;

    protected $queryString = [
        'active' => ['except' => false],
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],

    ];





    public function render()
    {
        // dd(now()->toDate());

        $cargos = Cargo::where('cargos.name', 'like', '%' . $this->search . '%')
            ->join('users as creator', 'creator.id', '=', 'cargos.created_by')
            ->leftJoin('users as editor', 'editor.id', '=', 'cargos.updated_by')
            ->select(
                'cargos.*',
                'creator.name as criacao',
                'editor.name as edicao'
            )
            ->where(function ($query) {
                $query->where('cargos.name', 'like', '%' . $this->search . '%');
            })
            ->when($this->active, function ($query) {
                $query->active();
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC': 'DESC');


            $query = $cargos->toSql();
            $cargos = $cargos->paginate($this->numberRows);

        return view('livewire..cargo.cargo-list', [
            'cargos' => $cargos,
            'viewName' => $this->viewName,
        ])->layout('layouts.theme');
    }

    public function updatingActive()
    {
        $this->resetPage();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortingBy($field)
    {
        if($field == $this->sortBy){
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
        // $this->sortBy = 'projetos.'.$field;
    }

    public function deleteCargo($id)
    {

        $cargo = Cargo::findOrFail($id);
        $cargo->status = $cargo->status == 1 ? 0 : 1;
        $cargo->updated_by = Auth::user()->id;

        $cargo->save();

        $statusMessage = $cargo->status == 0 ? 'ativado' : 'inativado';

        session()->flash('success', $this->viewName . ' ' . $statusMessage . ' com sucesso');

        return $this->redirect('/cargos', navigate: true);
    }
}
