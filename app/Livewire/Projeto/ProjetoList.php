<?php

namespace App\Livewire\Projeto;

use App\Models\Projeto;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ProjetoList extends Component
{


    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $numberRows = 5;

    public $viewName = 'Projeto';

    public $search = '';
    public $active ;
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
        $projetos = Projeto::join('users as creator', 'creator.id', '=', 'projetos.created_by')
        ->leftJoin('users as editor', 'editor.id', '=', 'projetos.updated_by')
        ->select('projetos.*', 'creator.name as criacao', 'editor.name as edicao')
        ->when($this->search,function ($query) {
            $query->where('projetos.name', 'like', '%' . $this->search . '%')
                  ->orWhere('descricao', 'like', '%' . $this->search . '%');
        })
        ->when($this->active, function ($query) {
            $query->active(); // no model
        })
        ->orderBy($this->sortBy, $this->sortAsc ? 'ASC': 'DESC');


        $query = $projetos->toSql();
        $projetos = $projetos->paginate($this->numberRows);


        return view('livewire..projeto.projeto-list', [
            'projetos' => $projetos,
            'viewName' => $this->viewName,
            'query' => $query,
        ])->layout('layouts.theme');
    }

    public function updatingActive(){
        $this->resetPage();
    }

    public function updatingSearch(){
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

    public function confirmeDelete(Projeto $projeto){
        dd('aqui', $projeto);
    }

    public function deleteProjeto($id)
    {

        $projeto = Projeto::findOrFail($id);
        $projeto->status = $projeto->status == 1 ? 0 : 1;
        $projeto->updated_by = Auth::user()->id;

        $projeto->save();

        $statusMessage = $projeto->status == 0 ? 'ativado' : 'inativado';

        session()->flash('success', $this->viewName . ' ' . $statusMessage . ' com sucesso');

        return $this->redirect('/projetos', navigate: true);
    }
}
