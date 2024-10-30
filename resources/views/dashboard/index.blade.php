@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Dashboard</h1>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pegawai</h5>
                        <p class="card-text">{{ $stats['total_pegawai'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Gaji</h5>
                        <p class="card-text">{{ $stats['total_gaji'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Cuti</h5>
                        <p class="card-text">{{ $stats['total_cuti'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <canvas id="pegawaiPerDivisiChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <canvas id="statusCutiChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <canvas id="pelamarPerBulanChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    
    <script>
        const ctxPegawaiPerDivisi = document.getElementById('pegawaiPerDivisiChart').getContext('2d');
        const ctxStatusCuti = document.getElementById('statusCutiChart').getContext('2d');
        const ctxPelamarPerBulan = document.getElementById('pelamarPerBulanChart').getContext('2d');
    
        new Chart(ctxPegawaiPerDivisi, {
            type: 'bar',
            data: {
                labels: {{ json_encode($chartData['pegawaiPerDivisi']['labels']) }},
                datasets: [{
                    label: 'Jumlah Pegawai per Divisi',
                    data: {{ json_encode($chartData['pegawaiPerDivisi']['datasets'][0]['data']) }},
                    backgroundColor: {{ json_encode($chartData['pegawaiPerDivisi']['datasets'][0]['backgroundColor']) }},
                    borderColor: {{ json_encode($chartData['pegawaiPerDivisi']['datasets'][0]['borderColor']) }},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    
        new Chart(ctxStatusCuti, {
            type: 'pie',
            data: {
                labels: {{ json_encode($chartData['statusCuti']['labels']) }},
                datasets: [{
                    label: 'Status Cuti',
                    data: {{ json_encode($chartData['statusCuti']['datasets'][0]['data']) }},
                    backgroundColor: {{ json_encode($chartData['statusCuti']['datasets'][0]['backgroundColor']) }},
                    borderColor: {{ json_encode($chartData['statusCuti']['datasets'][0]['borderColor']) }},
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    
        new Chart(ctxPelamarPerBulan, {
            type: 'line',
            data: {
                labels: {{ json_encode($chartData['pelamarPerBulan']['labels']) }},
                datasets: [{
                    label: 'Pelamar per Bulan',
                    data: {{ json_encode($chartData['pelamarPerBulan']['datasets'][0]['data']) }},
                    backgroundColor: {{ json_encode($chartData['pelamarPerBulan']['datasets'][0]['backgroundColor']) }},
                    borderColor: {{ json_encode($chartData['pelamarPerBulan']['datasets'][0]['borderColor']) }},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>