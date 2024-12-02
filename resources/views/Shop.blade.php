@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Tabla de Productos</h6>
                        <a href="{{ route('ShopAdd') }}" class="btn btn-secondary">Nuevo Producto</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripción</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Precio</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Talla</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <a href="{{ route('ShopShow', ['id' => $producto->id]) }}" class="mb-0 text-sm">{{ $producto->nombre }}</a>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">{{ $producto->descripcion }}</td>
                                        <td class="align-middle text-center">{{ $producto->precio }}</td>
                                        <td class="align-middle text-center">{{ $producto->talla }}</td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('ShopEdit', $producto->id) }}" class="text-secondary font-weight-bold text-xs">Editar</a> |
                                            <form action="{{ route('deleteShop', $producto->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="text-secondary font-weight-bold text-xs" onclick="event.preventDefault(); this.closest('form').submit();">Eliminar</a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection