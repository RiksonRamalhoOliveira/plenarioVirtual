<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class CargoController extends Controller
{

    use WithPagination;
    public $numberRows = 5;

    public $viewName = 'Cargo';

    public $search;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {

        $cargos = Cargo::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate($this->numberRows);
        return view('cargos.index', [
            'cargos' => $cargos,
            'viewName' => $this->viewName,
        ]);
    }



    public function create()
    {
        return view('cargos.create', [
            'viewName' => $this->viewName
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5|max:50|unique:cargos',
        ], $this->getMessages());

        $request->user()->cargos()->create($validated);

        // return redirect()->route('cargoIndex')->with('success', $this->viewName . ' criado com sucesso!');

        session()->flash('success', $this->viewName . ' cadastrado com sucesso');

        return $this->redirect('/cargoIndex',navigate:true);
    }


    public function show(Cargo $cargo)
    {

        return view('cargos.show', [
            'cargo' => $cargo,
        ]);
    }


    public function edit(Cargo $cargo)
    {
        // $this->authorize('update',$cargo);
        return view('cargos.edit', [
            'cargo' => $cargo,
            'viewName' => $this->viewName,
        ]);
    }


    public function update(Request $request, Cargo $cargo)
    {
        // $this->authorize('update',$cargo);
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:50', Rule::unique('cargos')->ignore($cargo->id)],
            'usuario_alteracao_id' => ['required', 'integer'],
        ], $this->getMessages());

        $cargo->update($validated);
        session()->flash('success', $this->viewName . ' cadastrado com sucesso');


        return redirect()->route('cargoIndex')->with('success', $this->viewName . ' editado com sucesso!');

    }


    public function destroy(Cargo $cargo)
    {
        // Atualize o status do cargo (0 = ativo, 1 = inativo)
        $cargo->update(['status' => $cargo->status == 1 ? 0 : 1]);

        // Determine a mensagem de sucesso com base no novo status
        $statusMessage = $cargo->status == 0 ? 'ativado' : 'inativado';

        return redirect()->route('cargoIndex')->with('success', $this->viewName . " $statusMessage com sucesso!");
    }

    protected function getMessages()
    {
        return [
            'name.required' => 'O nome do ' . $this->viewName . ' é obrigatório.',
            'name.min' => 'O nome do ' . $this->viewName . ' tem que ter no mínimo 5 caracteres.',
            'name.max' => 'O nome do ' . $this->viewName . ' tem que ter no máximo 50 caracteres.',
            'name.unique' => $this->viewName . ' já cadastrado.',
        ];
    }
}
