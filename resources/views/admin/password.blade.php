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
            <h3 class="card-title"><i class="fas fa-fw fa-lock"></i> Cambiar contraseña</h3>
        </div>

        <form action="{{route('user.changePassword')}}" id="change_password_form" method="post">
            @csrf
            <div class="card-body">
                    
                <div class="mb-3">
                    <label for="old_password">Contraseña actual</label>
		            <input type="password" name="old_password" class="form-control required" id="old_password" >  
                </div>

                <div class="mb-3">
                    <label for="password">Nueva contraseña</label>
                    <input type="password" name="new_password" class="form-control required" id="new_password" >
                </div>

                <div class="mb-3">
                    <label for="confirm_password">Confirmar nueva contraseña</label>
                    <input type="password" name="confirm_password" class="form-control required" id="confirm_password" >
                </div>

            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Cambiar contraseña</button>
                <a href="/operaciones" class="btn bg-gradient-secondary float-right mr-2">Cancelar</a>
            </div>

        </form>

    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

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

<!-- JQuery Localization message-->
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/localization/messages_es.js"></script>

<!-- SweetAlert2-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Validar según categoría

    $(document).ready(function(){      
            $("#change_password_form").validate({    

            rules: {
                old_password:{
                    minlength:6,
                    maxlength:15
                },

                new_password:{
                    minlength:6,
                    maxlength:15
                },

                confirm_password:{
                    minlength:6,
                    maxlength:15,
                    equalTo: "#new_password"
                },
                
            }
        });
    });
</script>

@if (session('successAlert') == 'success')
<script>
    Swal.fire(
    'Exito!',
    'Contraseña actualizada correctamente',
    'success'
    )
</script>
@endif


@if (session('errorAlert') == 'error')
<script>
    Swal.fire({
    title: 'Error!',
    text: 'Contraseña anterior no coincide',
    icon: 'error',
    confirmButtonText: 'OK'
    })
</script>
@endif
    
@stop