@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="container-fluid">
    <a href="departamento/create" class="btn bg-gradient-lightblue shadow"> Solicitar Requerimiento</a>
</div>
@stop

@section('content')

<div class="container-fluid">

    <table id="petitionsForm" class="table table-striped rounded rounded-3 overflow-hidden shadow" style="width:100%">

        <thead class="bg-gradient-lightblue">
            <tr>
                <th class="font-weight-normal">ID</th>
                <th class="font-weight-normal">Categoría</th>
                <th class="font-weight-normal">Fecha Programación</th>
                <th class="font-weight-normal">Estado</th>
                <th class="font-weight-normal" style="text-align:center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($petitions as $petition)
            <tr>
                <td>{{$petition->id}}</td>
                <td>{{$petition->category->name}}</td>

                @if($petition->scheduledate !='')
                <td>{{$petition->scheduledate}} - {{$petition->time}}</td>
                @else
                <td>Sin fecha programación</td>
                @endif
                
                @if($petition->status->name == 'Pendiente')
                <td><span class="badge bg-gradient-warning">{{$petition->status->name}}</span></td>
                @elseif($petition->status->name == 'Aprobado')
                <td><span class="badge bg-gradient-success" >{{$petition->status->name}}</span></td>
                @elseif($petition->status->name == 'Rechazado')
                <td><span class="badge bg-gradient-danger">{{$petition->status->name}}</span></td>
                @elseif($petition->status->name == 'Completado')
                <td><span class="badge bg-gradient-primary">{{$petition->status->name}}</span></td>
                @elseif($petition->status->name == 'Guardado')
                <td><span class="badge bg-gradient-secondary">{{$petition->status->name}}</span></td>
                @endif

                <td width="150px">   
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{route('departamento.show', $petition->id)}}" class="btn bg-gradient-primary btn-sm"><i class="fas fa-eye"></i></a>

                        @if($petition->status->name == 'Guardado')
                        <a href="/departamento/{{$petition->id}}/edit" class="btn bg-gradient-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>

                        <form action="{{route('departamento.sendForm', $petition->id)}}" method="POST" class="sendForm">
                            @csrf @method('PUT')
                            <button type="submit" class="btn bg-gradient-info btn-sm"><i class="fas fa-share-square"></i></button>
                        </form>  
                    <div>
                    @endif 
                </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

<!-- DataTable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

@stop

@section('js')
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- DataTable js-->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert2-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function () {
    $('#petitionsForm').DataTable({
        "order": [[ 0, "desc" ]],
        "lengthMenu":[[6,10,15],[6,10,15]],
        stateSave: true,
        language: {
        url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-CL.json'
        }
    });
});
</script>

<script>
    $('.sendForm').submit(function(e){
        e.preventDefault();

        Swal.fire({
        title: '¿Enviar Solicitud?', 
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#0275d8',
        cancelButtonColor: '#999999',
        confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>


@if (session('formAlert') == 'formStore')
<script>
    Swal.fire(
    'Guardado!',
    'Puedes editar la solicitud antes de enviarla',
    'success'
    )
</script>
@endif

@if (session('sendAlert') == 'send')
<script>
    Swal.fire(
    'Enviado!',
    'Solicitud enviada',
    'success'
    )
</script>
@endif

@stop
