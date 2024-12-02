@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Crear Nuevo Empleado</h6>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <form action="{{ route('tablesStore') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Apellido</label>
                                <input type="text" name="lastName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Ubicación</label>
                                <input type="text" name="location" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="about_me">Acerca de mí</label>
                                <textarea name="about_me" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Estatus</label>
                                <select name="status" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userType">Tipo de Usuario</label>
                                <select name="userType" class="form-control" required>
                                    <option value="Cliente">Cliente</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Trabajador">Trabajador</option>
                                </select>
                            </div>
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <a href="{{ route('tables') }}" class="btn btn-secondary">Volver</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection