@extends('layouts.master')

@section('title')
Tambah Jabatan
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Jabatan</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-bank2 text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Jabatan</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="createJabatanForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="nama_jabatan">Nama Jabatan</label>
                                    <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                                    <div class="invalid-feedback" id="nama_jabatan_error"></div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label" for="id_divisi">Divisi</label>
                                    <select class="form-control" id="id_divisi" name="id_divisi" required>
                                        <option value="">Pilih Divisi</option>
                                    </select>
                                    <div class="invalid-feedback" id="id_divisi_error"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="gaji_pokok">Gaji Pokok</label>
                                    <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" required min="0">
                                    <div class="invalid-feedback" id="gaji_pokok_error"></div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" for="tarif_lembur_per_hari">Tarif Lembur per Hari</label>
                                    <input type="number" class="form-control" id="tarif_lembur_per_hari" name="tarif_lembur_per_hari" required min="0">
                                    <div class="invalid-feedback" id="tarif_lembur_per_hari_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 position-absolute bottom-0 end-0 m-4">
                            <div class="col-12">
                                <a href="{{ route('master_data.jabatan.index') }}" class="btn btn-danger me-2">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get token from localStorage
    const token = localStorage.getItem('token');

    // Check if token exists, if not redirect to login
    if (!token) {
        window.location.href = '/login';
        return;
    }

    // Initialize elements
    const form = document.getElementById('createJabatanForm');
    const gajiPokokInput = document.getElementById('gaji_pokok');
    const tarifLemburInput = document.getElementById('tarif_lembur_per_hari');

    // Function to format currency inputs
    function formatCurrency(input) {
        // Ubah type input menjadi "text" untuk menangani format currency
        input.setAttribute('type', 'text');
        
        input.addEventListener('input', function(e) {
            // Remove non-digit characters
            let value = this.value.replace(/\D/g, '');
            
            // Batasi panjang input jika diperlukan (opsional)
            // Misalnya untuk 15 digit (triliunan rupiah)
            if (value.length > 15) {
                value = value.slice(0, 15);
            }
            
            // Format the number with thousand separator
            if (value) {
                value = new Intl.NumberFormat('id-ID').format(value);
            }
            
            // Update the input value
            this.value = value;
        });

        input.addEventListener('blur', function(e) {
            if (this.value === '') {
                this.value = '0';
            }
        });

        // Tambahkan event untuk hanya mengizinkan input angka dan beberapa tombol kontrol
        input.addEventListener('keydown', function(e) {
            // Allow: backspace, delete, tab, escape, enter, dots
            if ([46, 8, 9, 27, 13, 110, 190].indexOf(e.keyCode) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            // Ensure that it is a number and stop the keypress if not
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) &&
                (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

    // Function to clear error messages and invalid classes
    function clearErrors() {
        const errorElements = document.querySelectorAll('.invalid-feedback');
        errorElements.forEach(element => element.textContent = '');
        const inputElements = form.querySelectorAll('.form-control');
        inputElements.forEach(element => element.classList.remove('is-invalid'));
    }

    // Function to display error messages
    function displayErrors(error) {
        if (error.errors) {
            Object.keys(error.errors).forEach(key => {
                const element = document.getElementById(`${key}_error`);
                const input = document.getElementById(key);
                if (element && input) {
                    element.textContent = error.errors[key][0];
                    input.classList.add('is-invalid');
                }
            });
        }
    }

    // Fetch divisions for select dropdown
    fetch('/api/divisi', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(divisions => {
        const selectElement = document.getElementById('id_divisi');
        divisions.forEach(division => {
            const option = document.createElement('option');
            option.value = division.id_divisi;
            option.textContent = division.nama_divisi;
            selectElement.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error fetching divisions:', error);
        Swal.fire('Error', 'Gagal mengambil data divisi', 'error');
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        clearErrors();
        
        // Get form data and clean the currency format
        const formData = {
            nama_jabatan: document.getElementById('nama_jabatan').value,
            id_divisi: document.getElementById('id_divisi').value,
            gaji_pokok: document.getElementById('gaji_pokok').value.replace(/\D/g, ''),
            tarif_lembur_per_hari: document.getElementById('tarif_lembur_per_hari').value.replace(/\D/g, '')
        };

        // Send POST request
        fetch('/api/jabatan', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data jabatan berhasil ditambahkan',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("master_data.jabatan.index") }}';
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            displayErrors(error);
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data',
                footer: error.message || 'Silakan coba lagi nanti'
            });
        });
    });

    // Handle reset button
    form.addEventListener('reset', function(e) {
        clearErrors();
        // Reset nilai input currency ke 0
        gajiPokokInput.value = '0';
        tarifLemburInput.value = '0';
    });

    // Initialize currency formatting for both inputs
    formatCurrency(gajiPokokInput);
    formatCurrency(tarifLemburInput);

    // Set initial values if needed
    gajiPokokInput.value = '0';
    tarifLemburInput.value = '0';
});
</script>
@endpush