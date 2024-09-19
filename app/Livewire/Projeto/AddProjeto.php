<?php

namespace App\Livewire\Projeto;

use App\Models\Projeto;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class AddProjeto extends Component
{

    #[Rule('required|string|min:5|max:50|unique:projetos')]
    public $name = "";

    #[Rule('required|string|min:5|max:255')]
    public $descricao = "";

    public $viewName = 'Projeto';

    public function render()
    {
        return view('livewire..projeto.add-projeto', [
            'viewName' => $this->viewName,
        ])->layout('layouts.theme');
    }

    public function saveProjeto()
    {
        $validated = $this->validate();
        $validated['created_by'] = Auth::user()->id;

        try {
            $projeto = Projeto::create($validated);

            session()->flash('success', $this->viewName . ' cadastrado com sucesso');

            return $this->redirect('/projetos', navigate: true);
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

            'descricao.required' => 'A descrição do ' . $this->viewName . ' é obrigatório.',
            'descricao.min' => 'A descrição ' . $this->viewName . ' tem que ter no mínimo 5 caracteres.',
            'descricao.max' => 'A descrição ' . $this->viewName . ' tem que ter no máximo 50 caracteres.',

        ];
    }
}
