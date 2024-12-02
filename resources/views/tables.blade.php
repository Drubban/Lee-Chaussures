@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Tabla de empleados</h6>
                        <a href="{{ route('tablesCreate') }}" class="btn btn-secondary">Nuevo Empleado</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre(s) / Apellido(s)</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Correo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Telefono</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estatus</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Con nosotros desde:</th>
                                        <th class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employeesAndAdmins as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="{{ route('tablesShow', ['id' => $user->id]) }}" class="mb-0 text-sm">{{ $user->name }}</a>
                                                    <p class="text-xs text-secondary mb-0">{{ $user->lastName }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 200px;">
                                                {{ $user->email }}
                                            </p>

                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->phone }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{ $user->status === 1 ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                {{ $user->status === 1 ? 'Activo' : 'Inactivo' }}
                                            </span>

                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/y') }}
                                            </span>
                                        </td>
                                        <td class="align">
                                            <a href="{{ route('tablesEdit', ['id' => $user->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user"> Edit</a>
                                            <a href="" class="text-secondary font-weight-bold text-xs"> | </a>
                                            <form action="{{ route('deleteUser', $user->id) }}" method="POST" style="display:inline;">
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
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabla de Clientes</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nombre</th>
                                        <th class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Apellido</th>
                                        <th
                                            class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Correo</th>
                                        <th
                                            class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Estatus</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Con nosotros desde:</th>
                                        <th
                                            class="text text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="{{ route('tablesShow', ['id' => $client->id]) }}" class="mb-0 text-sm">{{ $client->name }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $client->lastName }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $client->email }}</p>
                                        </td>
                                        <td class="align-middle text text-sm">
                                            <span class="badge badge-sm {{ $client->status === 1 ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                {{ $client->status === 1 ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($client->created_at)->format('d/m/y') }}</span>
                                        </td>
                                        <td class="align">
                                            <a href="{{ route('tablesEdit', ['id' => $client->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user"> Edit</a>
                                            <a href="" class="text-secondary font-weight-bold text-xs"> | </a>
                                            <form action="{{ route('deleteUser', $client->id) }}" method="POST" style="display:inline;">
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