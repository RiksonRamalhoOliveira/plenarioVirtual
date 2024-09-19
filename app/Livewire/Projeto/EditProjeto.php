<?php

namespace App\Livewire\Projeto;

use App\Models\Projeto;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EditProjeto extends Component
{
    public $projeto_id;


    #[Rule('required|string|min:5|max:50|unique:projetos,except,id')]
    public $name;

    #[Rule('required|string|min:5|max:255')]
    public $descricao;

    public $viewName = 'Projeto';

    public function mount($id)
    {
        $this->projeto_id = $id;
        $projeto = Projeto::findOrFail($id);

        // Load existing project data
        $this->name = $projeto->name;
        $this->descricao = $projeto->descricao;
    }

    public function render()
    {
        return view('livewire.projeto.edit-projeto')->layout('layouts.theme');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:50|unique:projetos,name,' . $this->projeto_id,
            'descricao' => 'required|string|min:5|max:255',
        ];
    }

    public function update()
    {

        $validated = $this->validate();
        $validated['updated_by'] = Auth::user()->id ;

        try {

            $projeto = Projeto::findOrFail($this->projeto_id);
            $projeto->update($validated);

            session()->flash('success', $this->viewName . ' editado com sucesso');
            // return redirect()->route('projetoList');
            return $this->redirect('/projetos', navigate: true);

        } catch (\Exception $e) {

            session()->flash('error', 'Erro ao editar ' . $this->viewName);

        }
    }

    protected function getMessages()
    {
        return [
            'name.required' => 'O nome do ' . $this->viewName . ' é obrigatório.',
            'name.min' => 'O nome do ' . $this->viewName . ' tem que ter no mínimo 5 caracteres.',
            'name.max' => 'O nome do ' . $this->viewName . ' tem que ter no máximo 50 caracteres.',
            'name.unique' => $this->viewName . ' já cadastrado.',
            'descricao.required' => 'A descrição do ' . $this->viewName . ' é obrigatória.',
            'descricao.min' => 'A descrição do ' . $this->viewName . ' tem que ter no mínimo 5 caracteres.',
            'descricao.max' => 'A descrição do ' . $this->viewName . ' tem que ter no máximo 255 caracteres.',
        ];
    }
}
