@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="container-fluid">
    <a href="operaciones/create" class="btn bg-gradient-lightblue shadow"> Ingresar Requerimiento</a>
</div>
@stop

@section('content')
<div class="container-fluid">

    <table id="petitions" class="table table-striped rounded rounded-3 overflow-hidden shadow">

        <thead class="bg-gradient-lightblue">
            <tr>
                <th class="font-weight-normal">ID</th>
                <th class="font-weight-normal">Nombre</th>
                <th class="font-weight-normal">Categoría</th>
                <th class="font-weight-normal">Fecha Programación</th>
                <th class="font-weight-normal">Estado</th>
                <th class="font-weight-normal" style="text-align:center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($petitions as $petition)

            @if($petition->status->name != 'Guardado')
            <tr>
                <td>{{$petition->id}}</td>
                <td><i class="fas fa-fw fa-user"></i> {{$petition->name}}</td>
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
                @endif
                <td>
                    <div class="btn-toolbar d-flex justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-3" role="group" aria-label="First group">
                            <a href="{{route('operaciones.show', $petition->id)}}" class="btn bg-gradient-primary btn-sm"><i class="fas fa-eye"></i></a>
                        </div>
                        
                        @if($petition->status->name == 'Pendiente')

                        <div class="btn-group mr-3" role="group" aria-label="Second group">
                            <form action="{{route('operaciones.approve', $petition->id)}}" method="POST" class="approveForm">
                                @csrf @method('PUT')
                                <button type="submit" class="btn bg-gradient-success btn-sm"><i class="fas fa-check-circle"></i></button>
                            </form>  
                        </div>                       

                        <div class="btn-group mr-3" role="group" aria-label="Third group">
                            <a href="" class="btn bg-gradient-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectedForm{{$petition->id}}"><i class="fas fa-times-circle"></i></a> 
                        </div>
                            <div class="modal fade" id="rejectedForm{{$petition->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-danger" id="mh1">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-times-circle"></i>  Rechazar Requerimiento</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('operaciones.update', $petition->id)}}" method="POST" id="v">
                                            @csrf @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="font-weight-normal"> Motivo Rechazo:</label>
                                                    <textarea class="form-control" id="rejectionreason" name="rejectionreason" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Confirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                     

                        @elseif($petition->status->name == 'Aprobado')
                    
                        <div class="btn-group mr-2" role="group" aria-label="Fourth group">
                            <a href="" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#resolutionForm{{$petition->id}}"><i class="fas fa-check-double"></i></a> 
                        </div>

                            <div class="modal fade" id="resolutionForm{{$petition->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-info" id="mh2">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-check-double"></i>  Completar Requerimiento</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('operaciones.resolution', $petition->id)}}" method="POST" enctype="multipart/form-data" id="form2">
                                            @csrf @method('PUT')
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label for="" class="font-weight-normal">Fecha Ejecución</label>
                                                    <div class="d-flex align-items-center">
                                                        <input type="text" id="executiondate" name="executiondate" class="form-control" autocomplete="off" onkeydown="event.preventDefault()" required>
                                                        <button class="btn btn-sm btn-primary ml-2" name="btnClear">Limpiar</button>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="" class="font-weight-normal">Evidencia</label>
                                                        <input type="file" id="evidence" name="evidence" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="" class="font-weight-normal">Resolución: </label>
                                                        <textarea class="form-control" id="resolution" name="resolution" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Confirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        @endif 
                    </div>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
        
    </table>
    
</div>
    
@stop

@section('css')
<!-- DataTable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

<!-- JQuery DateTimePicker css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"/>

<style>
label.error{
    color: #FF0000; 
    width:50%;
    display:inline-table;
    font-weight: normal !important;
    }
</style>
@stop

@section('js')

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- JQuery Validate-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<!-- JQuery Validate Additional Methods -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- JQuery Localization message-->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/localization/messages_es.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<!-- DataTable js-->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert2-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- JQuery DateTimePicker js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>


<script>
    $(document).ready(function () {
        $('#petitions').DataTable({
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
// Fecha Programación
    $.datetimepicker.setLocale('es');

    $("input[name='executiondate']").datetimepicker({
        minDateTime:new Date(),
        format:'d/m/Y',
        disabledWeekDays:[0,6],
        yearStart: new Date(),
        timepicker:false
    });

    $(document).ready(function() {
        $("button[name='btnClear']").click(function() {
            $("input[name='executiondate']").val('');
        });
    });
</script>

<script>
    $('.approveForm').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: '¿Aprobar Requerimiento?', 
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3A8A35',
        cancelButtonColor: '#999999',
        confirmButtonText: 'Confirmar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>



@if (session('petitionAlert') == 'petitionStore')
<script>
    Swal.fire(
    'Ingresado!',
    'Requerimiento ingresado',
    'success'
    )
</script>
@endif


@if (session('approveAlert') == 'approve')
<script>
    Swal.fire(
    'Aprobado!',
    'Requerimiento aprobado',
    'success'
    )
</script>
@endif


@if (session('completeAlert') == 'complete')
<script>
    Swal.fire(
    'Completado!',
    'Requerimiento completado',
    'success'
    )
</script>
@endif


@if (session('rejectAlert') == 'reject')
<script>
    Swal.fire({
    title: 'Rechazado!',
    text: 'Requerimiento rechazado',
    icon: 'error',
    confirmButtonText: 'OK'
    })
</script>
@endif
                
@stop