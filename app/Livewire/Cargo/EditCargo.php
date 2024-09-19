<?php

namespace App\Livewire\Cargo;

use App\Models\Cargo;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EditCargo extends Component
{
    public $cargo_id;

    #[Rule('required|string|min:5|max:50|unique:cargos,except,id')]
    public $name;
    public Cargo $cargo_data;
    public $viewName = 'Cargo';


    public function mount($id)
    {
        $this->cargo_id = $id;
        $this->cargo_data = Cargo::where('id', $id)->first();
        $this->name = $this->cargo_data->name;
    }
    public function render()
    {
        return view('livewire..cargo.edit-cargo')->layout('layouts.theme');
    }


    public function update()
    {

        $validated = $this->validate();
        $validated['updated_by'] = Auth::user()->id ;

        $this->cargo_data->name = $this->name;


        try {

            $cargo = Cargo::findOrFail($this->cargo_id);
            $cargo->update($validated);

            session()->flash('success', $this->viewName . ' editado com sucesso');

            return $this->redirect('/cargos', navigate: true);

        } catch (\Exception $e) {
            dd($e);

        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:5|max:50|unique:cargos,name,' . $this->cargo_id,
        ];
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
