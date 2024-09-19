@extends('admin.layout.layout')

@section('content')
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
            </div>
        </div>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="d-flex align-items-center flex-grow-1">
                            <h4 class="mb-0 mr-3">Lista</h4>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('cargoCreate') }}" wire:navigate class="btn btn-success ml-2"
                                style="min-width: 120px;">
                                <i class="fa-solid fa-plus"></i> Novo
                            </a>
                        </div>

                    </div>
                    <div class="row">
                        @if (session('success'))
                            <div class="alert alert-success alert-sm flex-grow-1 mb-0 mr-3 mt-3">
                                {{ session('success') }}
                                <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>


                <div class="card-body">
                    <table class="table-striped mb-2 table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">CARGO</th>
                                <th scope="col">DATA CRIAÇÃO</th>
                                <th scope="col">STATUS</th>
                                <th scope="col" class="text-right">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cargos as $cargo)
                                <tr class="{{ $cargo->status == 1 ? 'text-danger' : '' }}">
                                    <td scope="row">{{ $cargo->id }}</td>
                                    <td scope="row">{{ Str::limit($cargo->name, 20) }}</td>
                                    <td scope="row">{{ $cargo->created_at->diffForHumans() }}</td>
                                    <td scope="row">
                                        @if ($cargo->status == 0)
                                            Ativo
                                        @else
                                            Inativo
                                        @endif
                                    </td>
                                    <td scope="row" class="text-right">
                                        <a href="{{ route('cargoShow', $cargo) }}" style="text-decoration: none;">
                                            <i class="fa-regular fa-eye text-light mr-2"></i>
                                        </a>
                                        <a href="{{ route('cargoEdit', $cargo) }}">
                                            <i class="fa-regular fa-pen-to-square text-light mr-2"></i>
                                        </a>
                                        <form action="{{ route('cargoDestroy', $cargo) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background:none; border:none; color:white; cursor:pointer;">
                                                <i class="fa-regular fa-trash-can text-light"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th scope="row" colspan="5" class="text-center">Nada cadastrado</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <span>
                        {{ $cargos->links() }}
                    </span>
                </div>
            </div>
        </section>
    </div>
@endsection
