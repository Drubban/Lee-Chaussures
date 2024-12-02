@extends('layouts.user_type.auth')

@section('content')

<div class="row mt-4">
  <div class="col-lg-8 mx-auto">
    <div class="card">
      <div class="card-body p-4">
        <h4 class="text-center mb-4">¡Bienvenido!</h4>
        <p class="text-center">
          Esta aplicación ha sido desarrollada utilizando las siguientes herramientas:
        </p>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Frameworks Utilizados
            <span class="badge bg-primary">Laravel + Bootstrap</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Versión de Laravel
            <span class="badge bg-primary">5.8.5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Versión de PHP
            <span class="badge bg-primary">8.2.12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Versión de Composer
            <span class="badge bg-primary">2.7.7</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Sistema Operativo
            <span class="badge bg-secondary">Windows 10/11</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Arquitectura de Software
            <span class="badge bg-success">Capas</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Gestor de Base de Datos
            <span class="badge bg-info">MySQL</span>
          </li>
        </ul>

        <div class="mt-4">
          <h5 class="text-center">Herramientas utilizadas</h5>
          <div class="mt-3">
            <h6>¿Qué es Visual Studio Code?</h6>
            <p>
              Visual Studio Code es un editor de código fuente desarrollado por Microsoft. Es ligero, extensible, 
              y soporta múltiples lenguajes de programación, incluyendo PHP, JavaScript, y más. Ofrece integración 
              con control de versiones y herramientas como Git.
            </p>
          </div>
          <div class="mt-3">
            <h6>¿Qué es MySQL?</h6>
            <p>
              MySQL es un sistema de gestión de bases de datos relacional (RDBMS) de código abierto. 
              Es ampliamente utilizado en aplicaciones web para almacenar y gestionar datos estructurados. 
              Ofrece rapidez, fiabilidad y facilidad de uso.
            </p>
          </div>
          <div class="mt-3">
            <h6>¿Qué es Laravel?</h6>
            <p>
              Laravel es un framework PHP diseñado para facilitar el desarrollo de aplicaciones web con una arquitectura 
              robusta y elegante. Ofrece herramientas como el enrutamiento, el ORM Eloquent, y la migración de bases de datos, 
              haciendo que el desarrollo sea más rápido y eficiente.
            </p>
          </div>
          <div class="mt-3">
            <h6>¿Qué es Composer?</h6>
            <p>
              Composer es un gestor de dependencias para PHP que permite instalar, actualizar y gestionar librerías 
              y paquetes requeridos en un proyecto. Facilita la integración y uso de código externo, como el framework Laravel.
            </p>
          </div>
        </div>

        <div class="mt-5">
          <h5 class="text-center">Pasos para instalar el proyecto</h5>
          <ol>
            <li>Bajar GitHub Desktop y clonar el repositorio:
              <br>
              <code>https://github.com/Drubban/Lee-Chaussures.git</code>
            </li>
            <li>Instalar XAMPP (versión superior a 8.0).</li>
            <li>Configurar la variable de entorno `Path` con la ruta: <code>C:\xampp\php\</code>.</li>
            <li>Abrir una terminal en PowerShell como administrador y ejecutar:
              <ul>
                <li>
                  <code>
                    Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows'))
                  </code>
                </li>
                <li><code>composer global require laravel/installer</code></li>
              </ul>
            </li>
            <li>En otra terminal de PowerShell, dirigirse al repositorio clonado. Ejemplo:
              <ul>
                <li><code>cd E:\Data\GithubProjekts\Lee-Chaussures</code></li>
              </ul>
            </li>
            <li>Ejecutar los siguientes comandos:
              <ul>
                <li><code>npm install</code></li>
                <li><code>composer install</code></li>
                <li><code>php artisan key:generate</code></li>
                <li><code>php artisan migrate</code></li>
                <li><code>php artisan serve</code></li>
              </ul>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
