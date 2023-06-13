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
            <h3 class="card-title"><i class="fas fa-fw fa-pencil-alt"></i> Editar solicitud</h3>
        </div>

        <form action="/departamento/{{$petition->id}}" method="POST" enctype="multipart/form-data" id="formEdit">
            @csrf @method('PUT')
            <div class="card-body">
                    
                <div class="mb-3">
                    <label for="" class="form-label">Categoría</label>
                    <select class="form-control required" name="category_id" id="category_id">
                    <option value="">Seleccione una categoría </option>
                    @foreach ($categorys as $category)
                        <option value= "{{$category->id}}" {{ ($category->id == $petition->category_id) ? 'selected' : ''}}  >{{$category->name}} </option>
                    @endforeach
                    </select>
                </div>
                

                <div class="mb-3">
                    <label for="" class="form-label">Descripción</label>
                    <textarea class="form-control required" rows="2" id="description" name="description">{{$petition->description}}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Teléfono (Opcional)</label> 
                            <input id="phone" name="phone" type="text" class="form-control number" value="{{$petition->phone}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Adjuntar archivo (Opcional) </label>
                            <input id="file" name="file" type="file" class="form-control" value="{{$petition->evidence}}">
                            @if($petition->file !='')
                            <a href="/Files/{{$petition->file}}" target="blank_" id="file">Documento actual</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3" id="divscheduledate">

                            <div class="form-group">
                                <label for="" class="form-label">Fecha Programación</label> <label id="opcional">(Opcional)</label>
                                <input id="scheduledate" name="scheduledate" type="text" class="form-control" autocomplete="off" value="{{$petition->scheduledate}}" readonly>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3" id="divtime">

                            <label for="" class="form-label">Horario</label> <label id="opcional2">(Opcional)</label>
                            <div class="form-group d-flex align-items-center">
                                <input id="time" name="time" type="text" class="form-control" autocomplete="off" value="{{$petition->time}}" readonly>
                                <button type="button" class="btn btn-sm btn-primary ml-2" id="btnClear">Limpiar</button>
                            </div>
                            <div id="time-error" class="error"></div>
                        </div>
                    </div>
                </div>


                <div class="mb-3" id="divfixedlocation">
                    <label for="" class="form-label">Ubicación</label>
                    <input id="fixedlocation" name="fixedlocation" type="text" class="form-control required" value="{{$petition->fixedlocation}}">
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3" id="divstartinglocation">
                            <label for="" class="form-label">Ubicación inicial</label>
                            <input id="startinglocation" name="startinglocation" type="text" class="form-control" value="{{$petition->startinglocation}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3" id="divendlocation">
                            <label for="" class="form-label">Ubicación final</label>
                            <input id="endlocation" name="endlocation" type="text" class="form-control" value="{{$petition->endlocation}}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <h5><i class="fas fa-map-marker-alt"></i> Geolocalización (Opcional)</h5>
                </div>

                <div class="row">
                    <div class="col form-group">
                        <div class="mb-3">

                            <div class="form-group">
                                <label for="" class="form-label">Latitud</label>
                                <input id="latitude" name="latitude" type="text" class="form-control" value="{{$petition->latitude}}">
                            </div>

                        </div>
                    </div>

                    <div class="col form-group">
                        <div class="mb-3">

                            <label for="" class="form-label">Longitud</label>
                            <div class="form-group d-flex align-items-center">
                                <input id="longitude" name="longitude" type="text" class="form-control" value="{{$petition->longitude}}">
                                @if($petition->longitude !='' && $petition->latitude !='' )
                                <button id="recharge" type="button" class="btn btn-sm btn-primary ml-2" style="white-space: nowrap;"><i class="fas fa-sync"></i> Cargar coordenadas</button>
                                @endif
                            </div>
            
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                    <small class="form-text text-muted">Establezca latitud y longitud a través del puntero del mapa</small>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
                <a href="/departamento" class="btn bg-gradient-secondary float-right mr-2">Cancelar</a>
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
     display:inline-table;
     font-weight: normal !important;
    }

    #time-error{
        margin-top: -17px;
    }

    #scheduledate{
        background-color: white;
    }

    #time{
        background-color: white;
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

<!-- JQuery DateTimePicker js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js" integrity="sha512-+UiyfI4KyV1uypmEqz9cOIJNwye+u+S58/hSwKEAeUMViTTqM9/L4lqu8UxJzhmzGpms8PzFJDzEqXL9niHyjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- JQuery DateTimePicker css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<script>
// Fecha Programación

    $.datetimepicker.setLocale('es');
    $('#scheduledate').datetimepicker({
        minDateTime:new Date(),
        format:'d/m/Y',
        disabledWeekDays:[0,6],
        yearStart: new Date(),
        timepicker:false
    });

    $('#time').datetimepicker({
        defaultTime:'09:00',
        format: 'H:i',
        minTime:'09:00',
        maxTime:'17:10',
        step:10,
        datepicker:false,
    });

    $(document).ready(function() {
        $('#btnClear').click(function() {
            $('#scheduledate').val('');
            $('#time').val('');
        });
    });
</script>


<script>
// Ocultar campos segun categoría

    $(function()
    {
        $('#divscheduledate').hide();
        $('#divtime').hide();
        $('#divstartinglocation').hide();
        $('#divendlocation').hide();
        $('#opcional').hide();
        $('#opcional2').hide();

        if ($('#category_id').val()== 4 ||  $('#category_id').val()== 5 ){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divstartinglocation').show();
                $('#divendlocation').show();
                $('#divfixedlocation').hide();
                $('#opcional').hide();
                $('#opcional2').hide();
                $('#fixedlocation').val('');

            }else if ($('#category_id').val()== 6){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divfixedlocation').show();
                $('#divstartinglocation').hide();
                $('#divendlocation').hide();

            }else if ($('#category_id').val()== 11){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divfixedlocation').show();
                $('#divstartinglocation').hide();
                $('#divendlocation').hide();
                $('#opcional').show();
                $('#opcional2').show();
                    
            }else if ($('#category_id').val()== 10){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divstartinglocation').show();
                $('#divendlocation').show();
                $('#divfixedlocation').hide();
                $('#opcional').show();
                $('#opcional2').show();
                $('#fixedlocation').val('');
            }
            else{
                $('#divscheduledate').hide();
                $('#divtime').hide();
                $('#divstartinglocation').hide();
                $('#divendlocation').hide();
                $('#divfixedlocation').show();  
                $('#scheduledate').val(''); 
                $('#startinglocation').val(''); 
                $('#endlocation').val(''); 
            }
            
        $('#category_id').change (function()
        {
            if ($('#category_id').val()== 4 ||  $('#category_id').val()== 5 ){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divstartinglocation').show();
                $('#divendlocation').show();
                $('#divfixedlocation').hide();
                $('#opcional').hide();
                $('#opcional2').hide();
                $('#fixedlocation').val('');

            }else if ($('#category_id').val()== 6){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divfixedlocation').show();
                $('#divstartinglocation').hide();
                $('#divendlocation').hide();

            }else if ($('#category_id').val()== 11){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divfixedlocation').show();
                $('#divstartinglocation').hide();
                $('#divendlocation').hide();
                $('#opcional').show();
                $('#opcional2').show();
                    
            }else if ($('#category_id').val()== 10){
                $('#divscheduledate').show();
                $('#divtime').show();
                $('#divstartinglocation').show();
                $('#divendlocation').show();
                $('#divfixedlocation').hide();
                $('#opcional').show();
                $('#opcional2').show();
                $('#fixedlocation').val('');
            }
            else{
                $('#divscheduledate').hide();
                $('#divtime').hide();
                $('#divstartinglocation').hide();
                $('#divendlocation').hide();
                $('#divfixedlocation').show();  
                $('#scheduledate').val(''); 
                $('#startinglocation').val(''); 
                $('#endlocation').val(''); 
            }

        });
    });
</script>


<script>
// Validar según categoría

    $(document).ready(function(){      
            $("#formEdit").validate({    

            rules: {
                phone:{
                    minlength:9,
                    maxlength:9
                },

                file:{
                    maxsize: 5000000
                },

                geolocation:{
                    minlength:10,
                    maxlength:100
                },

                fixedlocation:{
                    minlength:10,
                    maxlength:150
                },

                description:{
                    minlength: 10,
                    maxlength: 255
                },

                latitude:{
                    maxlength: 100
                },

                longitude:{
                    maxlength: 100
                },
                
                scheduledate:{
                    required:function (){
                        return $("#category_id").val()==4 || $('#category_id').val() ==5 || $('#category_id').val() ==6 || $("#time").val().length > 0;
                    }
                },

                time:{
                    required:function (){
                        return $("#category_id").val()==4 || $('#category_id').val() ==5 || $('#category_id').val() ==6 || $("#scheduledate").val().length > 0;
                    }
                },

                startinglocation:{
                    minlength: 10,
                    maxlength:150,
                    required:function (){
                        return $("#category_id").val()==4 || $('#category_id').val() ==5 || $('#category_id').val() ==10;
                    }
                },
                endlocation:{
                    minlength: 10,
                    maxlength:150,
                    required:function (){
                        return $("#category_id").val()==4 || $('#category_id').val() ==5 || $('#category_id').val() ==10;
                    }
                }
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") === "time") {
                    error.appendTo("#time-error");
                }else{
                    error.insertAfter(element);
                }
            },

            messages:{
                file: "No exceder los 5 MB"
            }
        });
    });
</script>


<script>
// Ocultar mensajes después de validación

    $(function()
        {
            $("label.error").hide();
            $(".error").removeClass("error");
                
            $('#category_id').change (function()
                {
                if ($('#category_id').val()== 1 || $('#category_id').val()==2 || $('#category_id').val()==3 || $('#category_id').val()==4 || $('#category_id').val()==5 || $('#category_id').val()==6  
                || $('#category_id').val()==7 || $('#category_id').val()==8  || $('#category_id').val()==9 || $('#category_id').val()==10 || $('#category_id').val()==11) 
                
                {
                    $("label.error").hide();
                    $(".error").removeClass("error");

                }

            });
                
        });
</script>


<script>
// Mapa de función editar

    $('#recharge').click(function(){
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();

        coordinates ={
            lng: longitude,
            lat: latitude
        }
        generarMapa(coordinates);
    });

    function initMap(){
        var latitude= -41.32730574592135;
        var longitude= -72.98160494602068;
        
        coordinates ={
            lng: longitude,
            lat: latitude
        }

        generarMapa(coordinates);
    }

    function generarMapa(coordinates){
        var map= new google.maps.Map(document.getElementById('map'),
        {
            zoom:13,
            center: new google.maps.LatLng(coordinates.lat, coordinates.lng)
        });

        marcador = new google.maps.Marker({
            map: map,
            draggable: true,
            position: new google.maps.LatLng(coordinates.lat, coordinates.lng)

        }); 

        marcador.addListener('dragend', function(event){
            document.getElementById('latitude').value = this.getPosition().lat();
            document.getElementById('longitude').value = this.getPosition().lng();
        })
    }
</script>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>
@stop