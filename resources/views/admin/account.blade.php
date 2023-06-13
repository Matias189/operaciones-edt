@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="mb-1">
</div>
@stop

@section('content')

<div class="container-fluid">

    <div class="card card-primary card-tabs shadow">

        <div class="card-header p-0 pt-1 bg-gradient-lightblue">

            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Administrador</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Requerimientos</a>
                </li>

            </ul>

        </div>

        <div class="card-body">

            <div class="tab-content" id="custom-tabs-one-tabContent">

                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                    <form>
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
                    </form>

                </div>

                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                    <div class="row">

                        <div class="col-md-7">

                            <div class="card">
                                <div class="card-header bg-gradient-lightblue shadow">
                                    <h3 class="card-title"><i class="far fa-chart-bar mr-1"></i> Gráfico de Barras</h3>
                                </div>
                                
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-5">

                            <div class="info-box mb-3 bg-gradient-warning shadow">
                                <span class="info-box-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Requerimientos pendientes</span>
                                    <span class="info-box-number">2</span>
                                </div>
                            </div>

                            <div class="info-box mb-3 bg-gradient-success shadow">
                                <span class="info-box-icon">
                                    <i class="fas fa-check-circle"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Requerimientos aprobados</span>
                                    <span class="info-box-number">2</span>
                                </div>
                            </div>

                            <div class="info-box mb-3 bg-gradient-danger shadow">
                                <span class="info-box-icon">
                                    <i class="fas fa-times-circle"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Requerimientos rechazados</span>
                                    <span class="info-box-number">2</span>
                                </div>
                            </div>

                            <div class="info-box mb-3 bg-gradient-info shadow">
                                <span class="info-box-icon">
                                    <i class="fas fa-check-double"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Requerimientos completados</span>
                                    <span class="info-box-number">2</span>
                                </div>
                            </div>


                        </div>

                    </div>
                
                </div>

            </div>

        </div>

        <div class="card-footer">
            <a href="/operaciones" class="btn bg-gradient-primary float-right">Volver</a>
        </div>
        
    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<!-- ChartJs -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- ChartJs Datalabels -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Gráfico de barras -->

<script>
$(document).ready(function() { 

    var cData = JSON.parse(`<?php echo $data; ?>`)

    const ctx = document.getElementById('barChart').getContext('2d');

    const myChart = new Chart(ctx, {
        plugins: [ChartDataLabels],
        type: 'bar',
        data: {
            labels:cData.label,
            datasets:[{
                label: 'Requerimientos',
                data:cData.data,
                backgroundColor: '#6495ED',
                //borderColor:'#6495ED',
                borderWidth: 1
            }]   
        }, 

        options: {
            scales: {
                y: {
                    suggestedMin: 0,
                    ticks: {
                        precision: 0
                    }
                }
            },

            plugins: {
                tooltip: {
                    enabled:true
                },
                datalabels:{
                    align: 'center',
                    color: "#ffffff",
                    formatter: (value, context) => {
                        const datapoints= context.chart.data.datasets[0].data;
                        function totalSum(total, datapoint){
                            return total + datapoint;
                        }
                        const totalvalue= datapoints.reduce(totalSum, 0);
                        const percentageValue= (value/totalvalue * 100).toFixed(1);
                        const display = [`${percentageValue}%`]
                        return display;
                    }
                }
            },
        }

    });

});
</script>

@stop