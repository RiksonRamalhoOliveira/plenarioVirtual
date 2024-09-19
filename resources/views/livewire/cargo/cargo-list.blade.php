<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h1 class="m-0"><i class="fa-solid fa-person-digging nav-icon"></i> {{ $viewName }}</h1>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" wire:navigate>Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center flex-grow-1">
                        <h4 class="mb-0 mr-3">Lista</h4>

                        @if (session('success'))
                            <div class="alert alert-success alert-sm flex-grow-1 alert-dismissible mb-0 mr-0 mt-0"
                                style="min-width: 120px;"> {{ Auth::user()->name }},
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
                        <a href="{{ route('addCargo') }}" wire:navigate class="btn btn-success ml-2"
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
                                <th scope="col" wire:click="sortingBy('id')" style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        ID
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="id" />
                                    </div>
                                </th>
                                <th scope="col" wire:click="sortingBy('name')" style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        CARGO
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="name" />
                                    </div>
                                </th>

                                <th scope="col" wire:click="sortingBy('created_at')" style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        CRIADO POR
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="created_at" />
                                    </div>
                                </th>


                                <th scope="col" wire:click="sortingBy('updated_by')" style="background:none; color:white; cursor:pointer;">
                                    <div style="display: inline-flex; align-items: center;">
                                        ALTERADO POR
                                        <x-sort-icon :sortBy="$sortBy" :sortAsc="$sortAsc" sortField="updated_by" />
                                    </div>
                                </th>
                                <th scope="col">STATUS</th>
                                <th scope="col">AÇÕES</th>
                            </tr>




                        </thead>
                        <tbody>
                            @forelse ($cargos as $cargo)
                                <tr class="{{ $cargo->status == 1 ? 'text-danger' : '' }}">
                                    <td scope="row">{{ $cargo->id }}</td>
                                    <td scope="row">{{ $cargo->name }}</td>

                                    {{-- <td class="text-center align-middle">{{ \Carbon\Carbon::parse($cargo->created_at)->format('d/m/Y') }}</td> --}}
                                    <td class="text-left align-middle">{{ $cargo->criacao }} Em
                                        {{ \Carbon\Carbon::parse($cargo->created_at)->format('d/m/Y H:i') }}</td>
                                    <td class="text-left align-middle">{{ $cargo->edicao }} Em
                                        {{ \Carbon\Carbon::parse($cargo->updated_at)->format('d/m/Y H:i') }}</td>
                                    <td scope="row" class="text-center align-middle">
                                        @if ($cargo->status == 0)
                                            Ativo
                                        @else
                                            Inativo
                                        @endif
                                    </td>
                                    <td scope="row" class="text-center align-middle">
                                        <a href="/edit/cargo/{{ $cargo->id }}" wire:navigate
                                            style="text-decoration: none;">
                                            <i class="fa-regular fa-pen-to-square text-light"></i>
                                        </a>
                                        <button wire:click="deleteCargo({{ $cargo->id }})" data-bs-toggle="modal"
                                            data-bs-target="#modal-cargo-desativar"
                                            style="background:none; border:none; color:white; cursor:pointer;">
                                            {{-- <button  data-bs-toggle="modal" data-bs-target="#modal-cargo-desativar" style="background:none; border:none; color:white; cursor:pointer;"> --}}
                                            @if ($cargo->status == 0)
                                                <i class="fa-regular fa-trash-can text-danger"></i>
                                            @else
                                                <i class="fa-regular fa-trash-can text-success"></i>
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" colspan="9" class="text-center">Nada cadastrado</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <span>
                    {{ $cargos->links() }}
                </span>
            </div>
        </div>
    </section>

    {{-- <livewire:cargo.modal-cargo-desativar/> --}}

</div>
