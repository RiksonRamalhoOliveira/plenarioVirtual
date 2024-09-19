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
                        <a href="{{ route('projetoList') }}" wire:navigate class="btn btn-primary btn">
                            <i class="fa-solid fa-list"></i> Listar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit="saveProjeto">

                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger">*</span> Projeto :</label>
                        <input type="text" class="form-control bg-dark text-white" wire:model="name"
                            id="name" name="name" placeholder="Nome do Projeto" autocomplete="off">
                        @error('name')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                        <div class="mb-3">
                            <label  class="form-label"><span class="text-danger">*</span>Descrição :</label>
                            <textarea class="form-control" wire:model="descricao"
                            id="descricao" name="descricao" placeholder="Descrição do Projeto" autocomplete="off" rows="3"></textarea>
                            @error('descricao')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                          </div>

                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
    </section>
</div>
