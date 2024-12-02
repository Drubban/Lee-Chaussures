@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 px-3">
            <h6 class="mb-0">{{ __('Agregar producto') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
            
            <form action="{{ route('ShopStore') }}" method="POST" role="form text-left">
                @csrf
                <!-- Mensajes de error -->
                @if($errors->any())
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">{{ $errors->first() }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                @endif

                <!-- Mensaje de éxito -->
                @if(session('success'))
                <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                    <span class="alert-text text-white">{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
                @endif

                <div class="row">
                    <!-- Campo Nombre -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre" class="form-control-label">{{ __('Nombre') }}</label>
                            <input class="form-control @error('nombre') border border-danger rounded-3 @enderror"
                                type="text" placeholder="Nombre del producto" id="nombre" name="nombre"
                                value="{{ old('nombre') }}">
                            @error('nombre')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo Descripción -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion" class="form-control-label">{{ __('Modelo') }}</label>
                            <input class="form-control @error('Modelo') border border-danger rounded-3 @enderror"
                                type="text" placeholder="Descripción del producto" id="descripcion" name="descripcion"
                                value="{{ old('descripcion') }}">
                            @error('descripcion')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Campo Talla -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="talla" class="form-control-label">{{ __('Talla') }}</label>
                            <input class="form-control @error('talla') border border-danger rounded-3 @enderror"
                                type="text" placeholder="Talla del producto" id="talla" name="talla"
                                value="{{ old('talla') }}">
                            @error('talla')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo Precio -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio" class="form-control-label">{{ __('Precio') }}</label>
                            <input class="form-control @error('precio') border border-danger rounded-3 @enderror"
                                type="number" placeholder="Precio del producto" id="precio" name="precio"
                                value="{{ old('precio') }}" step="0.01">
                            @error('precio')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Campo Stock -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock" class="form-control-label">{{ __('Stock') }}</label>
                            <input class="form-control @error('stock') border border-danger rounded-3 @enderror"
                                type="number" placeholder="Cantidad en stock" id="stock" name="stock"
                                value="{{ old('stock') }}">
                            @error('stock')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Campo URL -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="url" class="form-control-label">{{ __('URL de imagen') }}</label>
                            <input class="form-control @error('url') border border-danger rounded-3 @enderror"
                                type="url" placeholder="URL de la imagen del producto" id="url" name="url"
                                value="{{ old('url') }}">
                            @error('url')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botón de guardar -->
                
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <a href="{{ route('Shop') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Guardar cambios' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection