@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Edit Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Edit Pengajuan Cuti</h4>
                    <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </button>
                </div>
                <div class="card-body">
                    <div class="row small" id="pegawaiDetails">
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted" id="pegawaiName">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>NIK:</strong></p>
                            <p class="text-muted" id="pegawaiNIK">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Divisi:</strong></p>
                            <p class="text-muted" id="pegawaiDivision">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Jabatan:</strong></p>
                            <p class="text-muted" id="pegawaiPosition">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form id="pengajuanCutiForm">
                        <input type="hidden" id="id_pegawai" name="id_pegawai" value="{{ Auth::id() }}">
                        <input type="hidden" id="id_cuti" name="id_cuti" value="{{ $cuti->id }}">

                        <div class="mb-3">
                            <label for="id_jenis_cuti" class="form-label">Jenis Cuti</label>
                            <select class="form-select" id="id_jenis_cuti" name="id_jenis_cuti" required>
                                <option value="">Pilih Jenis Cuti</option>
                                <!-- Opsi jenis cuti akan dimuat di sini -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $cuti->tanggal_mulai }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="{{ $cuti->tanggal_selesai }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="alasan" class="form-label">Alasan</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="3" required>{{ $cuti->alasan }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Perbarui Cuti</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0 small">Detail Jatah Cuti</h5>
                </div>
                <div class="card-body">
                    <div class="row small">
                        <div class="col-12 mb-2">
                            <p class="mb-1"><strong>Cuti Umum:</strong></p>
                            <p class="text-muted" id="jatahCutiUmum">-</p>
                        </div>
                        <div class="col-12 mb-2">
 <p class="mb-1"><strong>Cuti Menikah:</strong></p>
                            <p class="text-muted" id="jatahCutiMenikah">-</p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="mb-1"><strong>Cuti Melahirkan:</strong></p>
                            <p class="text-muted" id="jatahCutiMelahirkan">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 small">Panduan Pengajuan Cuti</h5>
                </div>
                <div class="card-body">
                    <p class="small">Silakan isi semua informasi yang diperlukan dengan benar. Pastikan Anda memiliki jatah cuti yang cukup sebelum mengajukan cuti.</p>
                    <p class="small">Jika Anda memiliki pertanyaan, silakan hubungi HRD.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Back button functionality
    document.getElementById('btnBack').addEventListener('click', function() {
        window.history.back();
    });

    async function fetchUserAndPegawai() {
        try {
            const userResponse = await fetch('http://127.0.0.1:8000/api/auth/me', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!userResponse.ok) {
                throw new Error('Gagal mengambil data user');
            }

            const userData = await userResponse.json();
            const idPegawai = userData.pegawai.id_pegawai;
            document.getElementById('id_pegawai').value = idPegawai;

            // Fetch detail pegawai
            const pegawaiResponse = await fetch(`http://127.0.0.1:8000/api/pegawai/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!pegawaiResponse.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const pegawaiData = await pegawaiResponse.json();
            document.getElementById('pegawaiName').textContent = pegawaiData.data.nama_lengkap;
            document.getElementById('pegawaiNIK').textContent = pegawaiData.data.nik;

            // Fetch jabatan
            const idJabatan = pegawaiData.data.id_jabatan;
            if (idJabatan) {
                const jabatanResponse = await fetch(`http://127.0.0.1:8000/api/jabatan/${idJabatan}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!jabatanResponse.ok) {
                    throw new Error('Gagal mengambil data jabatan');
                }

                const jabatanData = await jabatanResponse.json();
                document.getElementById('pegawaiPosition').textContent = jabatanData.nama_jabatan;

                // Fetch divisi
                const idDivisi = pegawaiData.data.id_divisi;
                if (idDivisi) {
                    const divisiResponse = await fetch(`http://127.0.0.1:8000/api/divisi/${idDivisi}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });

                    if (!divisiResponse.ok) {
                        throw new Error('Gagal mengambil data divisi');
                    }

                    const divisiData = await divisiResponse.json();
                    document.getElementById('pegawaiDivision').textContent = divisiData.nama_divisi;
                }
            }

            // Fetch Jatah Cuti
            fetchJatahCuti(idPegawai);

        } catch (error) {
            console.error('Error fetching data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }

    }

    async function fetchJatahCuti(idPegawai) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/jatah-cuti/check-jatah-cuti/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil jatah cuti');
            }

            const result = await response.json();
            
            if (result.status === 'success') {
                const data = result.data;
                
                document.getElementById('jatahCutiUmum').textContent = 
                    `Jatah: ${data.jatah_cuti_umum} | Sisa: ${data.sisa_cuti_umum}`;
                document.getElementById('jatahCutiMenikah').textContent = 
                    `Jatah: ${data.jatah_cuti_menikah} | Sisa: ${data.sisa_cuti_menikah}`;
                document.getElementById('jatahCutiMelahirkan').textContent = 
                    `Jatah: ${data.jatah_cuti_melahirkan} | Sisa: ${data.sisa_cuti_melahirkan}`;
            } else {
                throw new Error(result.message || 'Gagal mengambil jatah cuti');
            }
        } catch (error) {
            console.error('Error fetching jatah cuti:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    async function fetchJenisCuti() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/jenis-cuti', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil jenis cuti');
            }

            const data = await response.json();
            const jenisCutiSelect = document.getElementById('id_jenis_cuti');
            jenisCutiSelect.innerHTML = '<option value="">Pilih Jenis Cuti</option>';
            
            data.forEach(jenis => {
                const option = document.createElement('option');
                option.value = jenis.id || jenis.id_jenis_cuti;
                option.textContent = jenis.nama || jenis.nama_jenis_cuti;

                if (option.value === '{{ $cuti->id_jenis_cuti }}') {
                    option.selected = true;
                }

                jenisCutiSelect.appendChild(option);
            });

        } catch (error) {
            console.error('Error fetching jenis cuti:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    document.getElementById('pengajuanCutiForm').addEventListener('submit', async function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        
        const data = {
            id_cuti: formData.get('id_cuti'),
            id_pegawai: formData.get('id_pegawai'),
            id_jenis_cuti: formData.get('id_jenis_cuti'),
            tanggal_mulai: formData.get('tanggal_mulai'),
            tanggal_selesai: formData.get('tanggal_selesai'),
            alasan: formData.get('alasan')
        };

        // Debugging
        console.log('Data yang akan dikirim:', data);

        // Kode untuk mengirim data jika semua validasi berhasil
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/cuti/${data.id_cuti}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const responseData = await response.json();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Pengajuan cuti berhasil diperbarui'
                }).then(() => {
                    window.location.href = '/cuti-pribadi';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: responseData.message || 'Gagal memperbarui cuti'
                });
            }
        } catch (error) {
            console.error('Error updating cuti:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    });


    // Initialize fetching user, pegawai, jenis cuti, and jatah cuti
    fetchUserAndPegawai();
    fetchJenisCuti();
});
</script>
 @endpush
@endsection