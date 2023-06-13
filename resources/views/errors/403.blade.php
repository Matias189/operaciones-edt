@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="mb-3">
    </div>
@stop

@section('content')
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Error 403</h3>

            <p>
                Esta acción no esta autorizada.
            </p>
            <p>
                <a href="/departamento" class="btn btn-info">
                    <i class="fas fa-fw fa-arrow-left"></i> Volver atrás
                </a>
            </p>

        </div>

      </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
@stop
