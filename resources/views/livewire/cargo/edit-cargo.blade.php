<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $viewName }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Dashboard
                            </a></li>
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
                        <h4>Editar</h4>
                    </div>
                    <div>
                        <a href="/cargos" wire:navigate class="btn btn-primary btn">
                            {{-- <i class="fa-solid fa-angles-right"></i> Listar --}}
                            <i class="fa-solid fa-list"></i> Listar
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <label class="form-label"><span class="text-danger">*</span>Cargos :</label>
                        <input type="text" class="form-control bg-dark text-black"
                        wire:model="name" id="name"
                        value="{{ $name }}"
                            name="name" placeholder="Nome do cargo" autocomplete="off">

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


