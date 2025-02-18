@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
        {{-- Header Card --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <b><h2 class="card-title mb-1">Manajemen Pengajuan Cuti</h2></b>
                        <p class="card-text text-muted">Human Resource Management System SEB</p>
                    </div>
                    <div>
                        <i class="bi bi-calendar-week text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pengajuan Cuti</h4>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" id="tambahCutiBtn">
                                <i class="bi bi-plus-square me-2"></i>Tambah Pengajuan Cuti
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="periodeFilter">Filter Periode:</label>
                                <input type="month" id="periodeFilter" class="form-control">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button id="filterButton" class="btn btn-primary"><i class="bi bi-filter-square me-2"></i>Filter</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="cuti-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-hash me-1"></i>No</th>
                                        <th><i class="bi bi-person me-1"></i>Nama Pegawai</th>
                                        <th><i class="bi bi-card-list me-1"></i>Jenis Cuti</th>
                                        <th><i class="bi bi-calendar-event me-1"></i>Tanggal Mulai</th>
                                        <th><i class="bi bi-calendar-event me-1"></i>Tanggal Selesai</th>
                                        <th><i class="bi bi-check-square me-1"></i>Status</th>
                                        <th><i class="bi bi-gear me-1"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<script>
   // Constants
const API_CONFIG = {
    //baseUrl: 'http://127.0.0.1:8000/api',
    endpoints: {
        employees: '/api/pegawai',
        leaveTypes: '/api/jenis-cuti',
        leave: '/api/cuti'
    }
};

// State Management
let cutiTable;
let employeeNames = {};
let leaveTypes = {};

// Utility Functions
const getAuthHeaders = () => ({
    'Authorization': `Bearer ${localStorage.getItem('token')}`,
    'Accept': 'application/json'
});

const formatDate = (date) => {
    return date ? new Date(date).toLocaleDateString('id-ID') : '-';
};

const getStatusBadgeClass = (status) => {
    const statusClasses = {
        'pending': 'badge bg-warning',
        'disetujui': 'badge bg-success',
        'ditolak': 'badge bg-danger'
    };
    return statusClasses[status] || 'badge bg-secondary';
};

// API Functions
const fetchEmployeeNames = async () => {
    try {
        const response = await fetch(API_CONFIG.endpoints.employees, {
            method: 'GET',
            headers: getAuthHeaders()
        });
        
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const data = await response.json();
        data.data.forEach(employee => {
            employeeNames[employee.id_pegawai] = employee.nama_lengkap;
        });
    } catch (error) {
        console.error('Error fetching employee names:', error);
        showError('Gagal memuat nama pegawai: ' + error.message);
    }
};

const fetchLeaveTypes = async () => {
    try {
        const response = await fetch(API_CONFIG.endpoints.leaveTypes, {
            method: 'GET',
            headers: getAuthHeaders()
        });
        
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const data = await response.json();
        data.forEach(leaveType => {
            leaveTypes[leaveType.id_jenis_cuti] = leaveType.nama_jenis_cuti;
        });
    } catch (error) {
        console.error('Error fetching leave types:', error);
        showError('Gagal memuat jenis cuti: ' + error.message);
    }
};

// DataTable Configuration
const initializeDataTable = () => {
    cutiTable = $('#cuti-table').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        ajax: {
            url: API_CONFIG.endpoints.leave,
            // url: `${API_CONFIG.baseUrl}${API_CONFIG.endpoints.leave}`,
            type: 'GET',
            data: function(d) {
                const periode = document.getElementById('periodeFilter').value;
                const [year, month] = periode.split('-');
                const startDate = `${year}-${month}-01`;
                const lastDay = new Date(year, month, 0).getDate();
                const endDate = `${year}-${month}-${lastDay}`;
                
                return {
                    ...d,
                    start_date: startDate,
                    end_date: endDate
                };
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', `Bearer ${localStorage.getItem('token')}`);
            },
            headers: { 'Accept': 'application/json' },
            error: function(xhr, error, thrown) {
                console.error('Error fetching data:', error);
                showError('Gagal memuat data: ' + (xhr.responseJSON?.message || 'Unknown error'));
            }
        },
        columns: [
            {
                data: null,
                render: (data, type, row, meta) => meta.row + 1
            },
            {
                data: 'id_pegawai',
                render: data => employeeNames[data] || '-'
            },
            {
                data: 'id_jenis_cuti',
                render: data => leaveTypes[data] || '-'
            },
            {
                data: 'tanggal_mulai',
                render: formatDate
            },
            {
                data: 'tanggal_selesai',
                render: formatDate
            },
            {
                data: 'status',
                render: data => `<span class="${getStatusBadgeClass(data)}">${data}</span>`
            },
            {
                data: null,
                render: data => `
                    <a href="/cuti/${data.id_cuti}/view" 
                       class="btn btn-sm btn-icon btn-info" 
                       data-bs-toggle="tooltip" 
                       data-bs-placement="top" 
                       title="View">
                        <span class="btn-inner">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 4.5C7.5 4.5 3.5 8.5 2 12c1.5 3.5 5.5 7.5 10 7.5s8.5-4 10-7.5c-1.5-3.5-5.5-7.5-10-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5S9.5 7.5 12 7.5 16.5 9.5 16.5 12 14.5 16.5 12 16.5z" 
                                      stroke="currentColor" 
                                      stroke-width="1.5" 
                                      stroke-linecap="round" 
                                      stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>`
            }
        ],
        language: {
            processing: "Loading...",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Data tidak ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data yang tersedia",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            },
            search: "Cari:"
        }
    });
};

// Helper Functions
const showError = (message) => {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message
    });
};

const checkAuth = () => {
    const token = localStorage.getItem('token');
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda harus login untuk mengakses halaman ini.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
        return false;
    }
    return true;
};

// Event Handlers
const setupEventListeners = () => {
    document.getElementById('filterButton').addEventListener('click', () => cutiTable.ajax.reload());
    document.getElementById('periodeFilter').addEventListener('change', () => cutiTable.ajax.reload());
    document.getElementById('tambahCutiBtn').addEventListener('click', () => {
        window.location.href = "{{ route('cuti.create') }}";
    });
};

// Initialization
document.addEventListener('DOMContentLoaded', async function() {
    if (!checkAuth()) return;
    
    // Set default period filter to current month
    const today = new Date();
    const defaultPeriod = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}`;
    document.getElementById('periodeFilter').value = defaultPeriod;
    
    // Initialize application
    await Promise.all([fetchEmployeeNames(), fetchLeaveTypes()]);
    initializeDataTable();
    setupEventListeners();
});
    </script>

@endsection