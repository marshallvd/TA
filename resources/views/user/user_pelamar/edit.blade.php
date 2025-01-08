@extends('layouts.app')
@extends('layouts.master')

@section('title', 'Edit Pelamar')

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen User Pelamar</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-postcard-heart text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Pelamar</h4>
                </div>
                <div class="card-body">
                    <form id="editPelamarForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="pelamarId" name="id" value="{{ $pelamar->id_pelamar }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" 
                                    value="{{ $pelamar->nama }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" 
                                    value="{{ $pelamar->email }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" 
                                    value="{{ $pelamar->no_hp }}">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SMA" {{ $pelamar->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="D3" {{ $pelamar->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>Diploma (D3)</option>
                                    <option value="S1" {{ $pelamar->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                    <option value="S2" {{ $pelamar->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                                    <option value="S3" {{ $pelamar->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $pelamar->alamat }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="pengalaman_kerja" class="form-label">Pengalaman Kerja</label>
                                <textarea class="form-control" id="pengalaman_kerja" name="pengalaman_kerja" rows="3">{{ $pelamar->pengalaman_kerja }}</textarea>
                            </div>
                        </div>

                        <!-- Updated Button Section -->
                        <div class="row mt-3 position-absolute bottom-0 end-0 m-4">
                            <div class="col-12">
                                <a href="{{ route('pelamar.index') }}" class="btn btn-danger me-2">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="reset" class="btn btn-warning me-2">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
        return;
    }

    document.getElementById('editPelamarForm').addEventListener('submit', async function(event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        const id = document.getElementById('pelamarId').value;
        const data = Object.fromEntries(formData);
        
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/pelamar/${id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Error: ${errorText}`);
            }

            const result = await response.json();

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data pelamar berhasil diperbarui.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "{{ route('pelamar.index') }}";
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat memperbarui data pelamar: ' + error.message,
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>

@endsection