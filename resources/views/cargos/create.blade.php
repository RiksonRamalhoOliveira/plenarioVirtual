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
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4>Cadastrar</h4>
                        </div>
                        <div>

                            <a href="{{ route('cargoIndex') }}" wire:navigate class="btn btn-warning btn"><i
                                    class="fa-solid fa-angles-right"></i> Listar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('cargoStore') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><span class="text-danger">*</span>Cargo:</label>
                            <input type="text" class="form-control bg-dark text-black" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Nome do cargo" autocomplete="off">

                            @error('name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
