@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Edit User
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Informasi User</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="userForm">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="userId" name="id_user">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Pegawai:</label>
                                    <select class="form-control" name="id_pegawai" id="pegawaiSelect" required>
                                        <option value="">Pilih Pegawai</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Role:</label>
                                    <select class="form-control" name="id_role" id="roleSelect" required>
                                        <option value="">Pilih Role</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Password Baru (Kosongkan jika tidak ingin mengubah):</label>
                                    <input type="password" class="form-control" name="password" minlength="8">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Status:</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Data User</button>
                            <a type="button" class="btn btn-secondary mt-3" href="/user">Tutup</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi variabel dan konstanta
    const token = localStorage.getItem('token');
    const userId = window.location.pathname.split('/').pop();
    const pegawaiSelect = document.getElementById('pegawaiSelect');
    const roleSelect = document.getElementById('roleSelect');
    const userForm = document.getElementById('userForm');
    const API_URL = 'http://127.0.0.1:8000/api';

    // Fungsi untuk cek token
    function checkToken() {
        if (!token) {
            Swal.fire({
                icon: 'error',
                title: 'Authentication Error',
                text: 'Token tidak ditemukan. Silakan login kembali.'
            }).then(() => {
                window.location.href = '/login';
            });
            return false;
        }
        return true;
    }

    // Fungsi untuk mengambil data user yang akan diedit
    async function fetchUserData() {
        if (!checkToken()) return;

        try {
            const response = await fetch(`${API_URL}/users/${userId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            
            const data = await response.json();
            console.log('User Data Response:', data);
            
            if (!response.ok) {
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }

            // Fetch pegawai dan role data secara berurutan
            await fetchPegawai(data.id_pegawai);
            await fetchRole(data.id_role);
            
            // Populate form dengan data user
            populateForm(data);
            
        } catch (error) {
            console.error('Error in fetchUserData:', error);
            handleFetchError(error);
        }
    }

    // Fungsi untuk mengisi form dengan data yang ada
    function populateForm(data) {
        // Handle jika data adalah object atau nested dalam property
        const userData = data.data || data;

        document.getElementById('userId').value = userData.id_user;
        document.querySelector('input[name="email"]').value = userData.email || '';
        document.querySelector('select[name="status"]').value = userData.status || '';
        
        // Set selected values untuk pegawai dan role
        if (userData.id_pegawai) {
            pegawaiSelect.value = userData.id_pegawai;
        }
        if (userData.id_role) {
            roleSelect.value = userData.id_role;
        }
    }

    // Fungsi untuk mengambil data pegawai
    async function fetchPegawai(selectedPegawaiId) {
        if (!checkToken()) return;

        try {
            const response = await fetch(`${API_URL}/pegawai`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            
            console.log('Pegawai API Response:', response);
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to fetch pegawai');
            }
            
            const responseData = await response.json();
            console.log('Pegawai Data:', responseData);

            // Handle berbagai kemungkinan struktur data
            const pegawaiData = responseData.data || responseData || [];
            const pegawaiArray = Array.isArray(pegawaiData) ? pegawaiData : [pegawaiData];
            
            pegawaiSelect.innerHTML = '<option value="">Pilih Pegawai</option>';
            pegawaiArray.forEach(pegawai => {
                if (!pegawai || (!pegawai.id_pegawai && !pegawai.nama_lengkap)) {
                    console.warn('Invalid pegawai object:', pegawai);
                    return;
                }

                const option = document.createElement('option');
                option.value = pegawai.id_pegawai;
                option.textContent = pegawai.nama_lengkap;
                if (pegawai.id_pegawai == selectedPegawaiId) {
                    option.selected = true;
                }
                pegawaiSelect.appendChild(option);
            });

            console.log('Pegawai select populated successfully');

        } catch (error) {
            console.error('Error in fetchPegawai:', error);
            handleFetchError(error);
        }
    }

    // Fungsi untuk mengambil data role
    async function fetchRole(selectedRoleId) {
        if (!checkToken()) return;

        try {
            console.log('Fetching roles with token:', token);
            
            const response = await fetch(`${API_URL}/role`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || response.statusText);
            }
            
            const responseData = await response.json();
            console.log('Role API Raw Response:', responseData);
            
            // Handle berbagai kemungkinan struktur data
            let roleData;
            if (responseData.data) {
                roleData = responseData.data;
            } else if (Array.isArray(responseData)) {
                roleData = responseData;
            } else if (typeof responseData === 'object') {
                roleData = [responseData];
            } else {
                throw new Error('Unexpected role data format');
            }

            // Pastikan roleData adalah array
            const roleArray = Array.isArray(roleData) ? roleData : [roleData];
            
            roleSelect.innerHTML = '<option value="">Pilih Role</option>';
            
            roleArray.forEach(role => {
                // Handle berbagai kemungkinan property names
                const roleId = role.id_role || role.id || role.role_id;
                const roleName = role.nama_role || role.name || role.role_name;
                
                if (!roleId || !roleName) {
                    console.warn('Incomplete role data:', role);
                    return;
                }
                
                const option = document.createElement('option');
                option.value = roleId;
                option.textContent = roleName;
                if (roleId == selectedRoleId) {
                    option.selected = true;
                }
                roleSelect.appendChild(option);
            });

            console.log('Role select populated successfully');
            
        } catch (error) {
            console.error('Detailed Error in fetchRole:', {
                message: error.message,
                stack: error.stack
            });
            handleFetchError(error);
        }
    }

    // Handle form submission untuk update
    userForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!checkToken()) return;

        try {
            const formData = new FormData(this);
            
            // Jika password kosong, hapus dari formData
            if (!formData.get('password')) {
                formData.delete('password');
            }

            // Log form data untuk debugging
            console.log('Form Data being sent:', Object.fromEntries(formData));
            
            const response = await fetch(`${API_URL}/users/${userId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            console.log('Update Response:', response);

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Failed to update user');
            }
            
            const responseData = await response.json();
            console.log('Update Success Data:', responseData);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data user berhasil diupdate',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '/user';
            });
        } catch (error) {
            console.error('Error in form submission:', error);
            handleFetchError(error);
        }
    }); 

    // Fungsi helper untuk handle error
    function handleFetchError(error) {
        console.error('Error caught by handler:', error);

        // Check if token is expired or invalid
        if (error.message.includes('Unauthenticated') || error.message.includes('token')) {
            Swal.fire({
                icon: 'error',
                title: 'Session Expired',
                text: 'Sesi anda telah berakhir. Silakan login kembali.',
                confirmButtonText: 'Login'
            }).then(() => {
                localStorage.removeItem('token');
                window.location.href = '/login';
            });
            return;
        }

        // Tampilkan error dengan opsi retry
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Terjadi kesalahan. Silakan coba lagi.',
            showCancelButton: true,
            confirmButtonText: 'Coba Lagi',
            cancelButtonText: 'Tutup'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reload halaman untuk mencoba lagi
                window.location.reload();
            }
        });
    }

    // Load initial data saat halaman dimuat
    fetchUserData();
});

</script>
@endsection