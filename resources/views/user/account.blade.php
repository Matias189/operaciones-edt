@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="mb-1">
</div>
@stop

@section('content')
<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-gradient-lightblue shadow">
            <h3 class="card-title"><i class="fas fa-fw fa-user"></i> Información del perfil</h3>
        </div>
        
        <form>
            <div class="card-body">
                
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input class="form-control" type="text" value ="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input class="form-control" type="text" value="{{ Auth::user()->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Departamento</label>
                    <input class="form-control" type="text" value="{{ Auth::user()->department->name }}" readonly>
                </div>

            </div>
        </form>

        <div class="card-footer">
            <a href="/departamento" class="btn bg-gradient-primary float-right">Volver</a>
        </div>

    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop