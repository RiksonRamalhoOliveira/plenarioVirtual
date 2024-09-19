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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{ route('cargoIndex') }}"><i class="fa-solid fa-angles-left"></i>Voltar</a></li> --}}

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4>Editar</h4>
                        </div>
                        <div>
                            <a href="{{ route('cargoIndex') }}"class="btn btn-warning btn"><i
                                    class="fa-solid fa-angles-left"></i>Listar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    {{-- <form wire:submit="saveCargo"> --}}
                        <form method="POST" action="{{ route('cargoUpdate', $cargo) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label"><span class="text-danger">*</span>Cargo:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $cargo->name }}" placeholder="Nome do cargo" autocomplete="off">
                                @error('name')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" class="form-control" id="usuario_alteracao_id" name="usuario_alteracao_id" value=" {{ Auth::user()->id }} " placeholder="Nome do cargo" autocomplete="off">
                            <button type="submit"  class="btn btn-success">Salvar</button>
                        </form>
                </div>
            </div>
            {{-- </div> --}}
        </section>
    </div>
@endsection
