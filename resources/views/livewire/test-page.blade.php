@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cargo</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                            <h4 class="mr-3 mb-0">Lista</h4>
                            @if (session('success'))
                                <div class="alert alert-success alert-sm mb-0 mr-3 flex-grow-1" style="min-width: 120px;">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('cargoCreate') }}" class="btn btn-success ml-2" style="min-width: 120px;">
                                <i class="fa-solid fa-plus"></i> Novo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <span>
                        {{-- {{ $cargos->links() }} --}}
                    </span>
                </div>
            </div>
        </section>
    </div>
@endsection
