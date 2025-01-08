@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Detail Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Detail Pengajuan Cuti</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-calendar2-week text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <div class="me-3">
                        <img src="{{ asset('assets/images/logo seb.png') }}" alt="Logo Perusahaan" class="mb-3" style="width: 100px;">
                    </div>
                    <div>
                        <h5>BPR Saraswati Eka Bumi</h5>
                        <p>Jalan By Pass Ngurah Rai No 233 Kuta Badung Bali</p>
                        <p>(0361) 756206, 763295</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Informasi Pengajuan Cuti</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="30%"><strong><i class="bi bi-layers-fill me-2"></i>Jenis Cuti</strong></td>
                                    <td>{{ $cuti->jenisCuti->nama_jenis_cuti }}</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-check-circle-fill me-2"></i>Status</strong></td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'menunggu' => 'badge bg-warning',
                                                'disetujui' => 'badge bg-success', 
                                                'ditolak' => 'badge bg-danger'
                                            ];
                                        @endphp
                                        <span class="{{ $statusClasses[$cuti->status] ?? 'badge bg-secondary' }}">
                                            {{ ucfirst($cuti->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <h4 class="text-center fw-bold mb-4">Periode Cuti</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50%">Tanggal Mulai</th>
                                        <th width="50%">Tanggal Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d F Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 bg-light p-4 rounded">
                            <h5 class="mb-3 fw-bold">
                                <i class="bi bi-chat-square-text me-2"></i>Alasan Cuti
                            </h5>
                            <p class="mb-0 ps-4">{{ $cuti->alasan }}</p>
                        </div>

                        @if($cuti->status !== 'menunggu')
                            <div class="mt-4 bg-light p-4 rounded">
                                <h5 class="mb-3 fw-bold">
                                    <i class="bi bi-pencil-square me-2"></i>Catatan {{ ucfirst($cuti->status) }}
                                </h5>
                                <p class="mb-0 ps-4">{{ $cuti->catatan ?? 'Tidak ada catatan' }}</p>
                            </div>
                        @endif

                        <div class="text-center mt-4">
                            <a href="{{ route('cuti_pribadi.index') }}" class="btn btn-primary px-4">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
    padding: 20px;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 20px;
}

.card-body {
    padding: 20px;
}

h4, h5 {
    color: #343a40;
    margin-bottom: 15px;
}

.table {
    width: 100%;
    margin-top: 15px;
}

.table th,
.table td {
    padding: 12px 15px;
    vertical-align: middle;
}

.table th {
    background-color: #f1f1f1;
}

.badge {
    padding: 8px 12px;
    font-size: 0.9rem;
}

.btn-primary {
    padding: 10px 25px;
    font-weight: 500;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endsection