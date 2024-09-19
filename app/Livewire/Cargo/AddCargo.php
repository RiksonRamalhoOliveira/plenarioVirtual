<?php
namespace App\Livewire\Cargo;

use App\Models\Cargo;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class AddCargo extends Component
{
    #[Rule('required|string|min:5|max:50|unique:cargos')]
    public $name = "";

    public $viewName = 'Cargo';

    public function render()
    {
        return view('livewire.cargo.add-cargo', [
            'viewName' => $this->viewName,
        ])->layout('layouts.theme');
    }

    public function saveCargo()
    {
        $validated = $this->validate();
        $validated['created_by'] = Auth::user()->id ;

        try {

            $cargo = Cargo::create($validated);

            session()->flash('success', $this->viewName . ' cadastrado com sucesso');

            return $this->redirect('/cargos',navigate:true);

        } catch (\Exception $e) {
            dd($e);

        }
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
