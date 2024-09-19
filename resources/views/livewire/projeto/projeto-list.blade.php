<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $viewName }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" wire:navigate>Dashboard</a></li>
                    </ol>
                </div>
            </div>
            {{-- {{ $query }} --}}
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center flex-grow-1">
                        <h4 class="mb-0 mr-3">Lista </h4>

                        @if (session('success'))
                            <div class="alert alert-success alert-sm flex-grow-1 mb-0 mr-0 mt-0"
                                style="min-width: 120px;">
                                {{ session('success') }}
                                <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex align-items-center ms-auto">
                        <input type="search" wire:model.live="search"
                            class="form-control border-primary mx-2 rounded border" style="width: 200px; height: 40px"
                            placeholder="Pesquisar..." />
                        <a href="{{ route('addProjeto') }}" wire:navigate class="btn btn-success ml-2"
                            style="min-width: 120px;">
                            <i class="fa-solid fa-plus"></i> Novo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="d-flex align-items-center">
                        <span>Registros por página</span>
                        <select wire:model.live="numberRows" wire:change="numberRows"
                            class="form-control border-primary form-select mx-2 rounded border" style="width: 100px;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center ms-auto">
                        <input type="checkbox" class="form-check-input" wire:model.live="active">
                        <span class="ms-2">Somente ativos</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table-bordered table-hover tablesorter table" id="myTable">
                        <thead class="sticky-thead">
                            <tr class="text-center align-middle">
                                <th scope="col" wire:click="sortingBy('id')"
                                    style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        ID
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="id" />
                                    </div>
                                </th>


                                <th scope="col" wire:click="sortingBy('name')"
                                    style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        PROJETO
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="name" />
                                    </div>
                                </th>


                                <th scope="col" wire:click="sortingBy('descricao')"
                                    style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        DESCRICAO
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="descricao" />
                                    </div>
                                </th>

                                <th scope="col" wire:click="sortingBy('created_by')"
                                    style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        CRIADO POR
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="created_by" />
                                    </div>
                                </th>

                                <th scope="col" wire:click="sortingBy('updated_by')"
                                    style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        ALTERADO POR
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="updated_by" />
                                    </div>
                                </th>

                                <th scope="col" class="text-center align-middle">STATUS</th>
                                <th scope="col" class="text-center align-middle">AÇÕES</th>

                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($projetos as $projeto)
                                <tr class="{{ $projeto->status == 1 ? 'text-danger' : '' }}">
                                    <td scope="row">{{ $projeto->id }}</td>
                                    <td scope="row">{{ $projeto->name }}</td>
                                    <td scope="row">{{ $projeto->descricao }}</td>
                                    {{-- <td class="text-center align-middle">{{ \Carbon\Carbon::parse($projeto->created_at)->format('d/m/Y') }} --}}
                                    <td class="text-left align-middle">{{ $projeto->criacao }} Em
                                        {{ \Carbon\Carbon::parse($projeto->created_at)->format('d/m/Y H:i') }}</td>
                                    <td class="text-left align-middle">{{ $projeto->edicao }} Em
                                        {{ \Carbon\Carbon::parse($projeto->updated_at)->format('d/m/Y H:i') }}</td>

                                    <td scope="row" class="text-center align-middle">
                                        @if ($projeto->status == 0)
                                            Ativo
                                        @else
                                            Inativo
                                        @endif
                                    </td>
                                    <td scope="row" class="text-center align-middle">
                                        <a href="/edit/projeto/{{ $projeto->id }}" wire:navigate
                                            style="text-decoration: none;">
                                            <i class="fa-regular fa-pen-to-square text-light"></i>
                                        </a>

                                        <button wire:click="deleteProjeto({{ $projeto->id }})" {{-- <button wire:click="confirmeDelete({{ $projeto->id }})" --}}
                                            style="background:none; border:none; color:white; cursor:pointer;">
                                            @if ($projeto->status == 0)
                                                <i class="fa-regular fa-trash-can text-danger"></i>
                                            @else
                                                <i class="fa-regular fa-trash-can text-success"></i>
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" colspan="7" class="text-center">Nada cadastrado</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <span>
                    {{ $projetos->links() }}
                </span>
            </div>
        </div>
    </section>
</div>
