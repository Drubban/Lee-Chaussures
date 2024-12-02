@extends('layouts.user_type.auth')

@section('content')
<!-- <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg "> -->
    <div class="container mt-5">
        <h2>Editar Usuario</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tablesUpdate', $usuario->id) }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
            </div>

            <div class="form-group">
                <label for="lastName">Apellido</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName', $usuario->lastName) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
            </div>

            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $usuario->phone) }}" required>
            </div>

            <div class="form-group">
                <label for="location">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $usuario->location) }}">
            </div>

            <div class="form-group">
                <label for="about_me">Acerca de mí</label>
                <textarea class="form-control" id="about_me" name="about_me">{{ old('about_me', $usuario->about_me) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Estado</label>
                <select class="form-control" id="status" name="status">
                    <option value="Activo" {{ $usuario->status === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $usuario->status === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Contraseña (dejar en blanco si no se desea cambiar)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            <a href="{{ route('tables') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
<!-- </main> -->

@endsection