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
            <h3 class="card-title"><i class="fas fa-fw fa-clipboard"></i> Solicitud N° {{$petition->id}}</h3>
        </div>
        
        <div class="card-body">
                
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <strong>Fecha Ingreso : </strong> {{\Carbon\Carbon::parse($petition->date)->format('d/m/Y - H:i')}}</li> 

                @if($petition->status->name == 'Guardado')
                    <li class="list-group-item"> <strong>Estado : </strong> <span class="badge bg-gradient-secondary">{{$petition->status->name}}</span></li> 
                @elseif($petition->status->name == 'Pendiente')
                    <li class="list-group-item"></i> <strong>Estado : </strong> <span class="badge bg-gradient-warning">{{$petition->status->name}}</span></li> 
                @elseif($petition->status->name == 'Aprobado')
                    <li class="list-group-item"> <strong>Estado : </strong> <span class="badge bg-gradient-success">{{$petition->status->name}}</span></li> 
                @elseif($petition->status->name == 'Rechazado')
                    <li class="list-group-item"> <strong>Estado : </strong> <span class="badge bg-gradient-danger">{{$petition->status->name}}</span></li> 
                @elseif($petition->status->name == 'Completado')
                    <li class="list-group-item"> <strong>Estado : </strong> <span class="badge bg-gradient-primary">{{$petition->status->name}}</span></li> 
                @endif

                <li class="list-group-item"> <strong>Nombre : </strong> {{$petition->name}}</li> 
                
                <li class="list-group-item"> <strong>Email : </strong> {{$petition->email}}</li> 

                <li class="list-group-item"> <strong>Departamento : </strong> {{$petition->department->name}}</li> 

                @if($petition->phone !='')
                    <li class="list-group-item"> <strong>Teléfono : </strong> {{$petition->phone}}</li>
                @endif

                <li class="list-group-item"> <strong>Categoría : </strong> {{$petition->category->name}}</li>

                <li class="list-group-item"> <strong>Descripción : </strong> {{$petition->description}}</li>
                
                @if($petition->scheduledate !='')
                    <li class="list-group-item"> <strong>Fecha Programación : </strong> {{$petition->scheduledate}} - {{$petition->time}}</li>
                @else
                    <li class="list-group-item"> <strong>Fecha Programación : </strong> Sin fecha programación</li>
                @endif

                @if($petition->fixedlocation !='')
                    <li class="list-group-item"> <strong>Ubicación : </strong> {{$petition->fixedlocation}}</li>
                @endif

                @if($petition->startinglocation !='')
                    <li class="list-group-item"> <strong>Ubicación inicial: </strong> {{$petition->startinglocation}}</li>
                @endif

                @if($petition->endlocation !='')
                    <li class="list-group-item"> <strong>Ubicación Final: : </strong> {{$petition->endlocation}}</li>
                @endif

                @if($petition->latitude !='' && $petition->longitude !='')
                    <li class="list-group-item"> <strong>Geolocalización : </strong> {{$petition->latitude}}, {{$petition->longitude}}</li>
                @else
                    <li class="list-group-item"> <strong>Geolocalización : </strong> Geolocalización no proporcionada</li>
                @endif

                @if($petition->file !='')
                    <li class="list-group-item"> <strong>Documento : </strong> <a href="/Files/{{$petition->file}}" target="blank_" id="file"> Ver documento</a></li>
                @endif

                @if($petition->rejectionreason !='')
                    <li class="list-group-item"> <strong>Motivo Rechazo : </strong> {{$petition->rejectionreason}}</li>
                @endif

                @if($petition->executiondate !='')
                    <li class="list-group-item"> <strong>Fecha Ejecución : </strong> {{$petition->executiondate}}</li>
                @endif

                @if($petition->resolution !='')
                    <li class="list-group-item"> <strong>Resolución : </strong> {{$petition->resolution}}</li>
                @endif

                @if($petition->evidence !='')
                    <li class="list-group-item"> <strong>Evidencia : </strong> <a href="/Evidence/{{$petition->evidence}}" target="blank_" id="evidence">Ver evidencia</a></li>
                @endif
            </ul> 
        

        </div>
        

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