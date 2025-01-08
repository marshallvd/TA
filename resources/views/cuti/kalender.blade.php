@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Calendar
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Calendar Cuti Pegawai</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="d-flex align-items-center">
                                    <div style="width: 15px; height: 15px; background-color: #28a745; margin-right: 5px;"></div>
                                    <span>Cuti Umum (Sakit/Upacara Keagamaan)</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div style="width: 15px; height: 15px; background-color: #007bff; margin-right: 5px;"></div>
                                    <span>Cuti Menikah</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div style="width: 15px; height: 15px; background-color: #dc3545; margin-right: 5px;"></div>
                                    <span>Cuti Melahirkan</span>
                                </div>
                            </div>
                        </div>
                        <div id="calendar1" class="calendar-s"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar1');

    // Fungsi untuk mendapatkan warna berdasarkan jenis cuti
    function getColorByLeaveType(jenisCuti) {
        // Ubah jenis cuti menjadi lowercase untuk perbandingan yang lebih aman
        const jenisCutiLower = jenisCuti.toLowerCase();
        
        // Log untuk debugging
        console.log('Jenis Cuti yang diterima:', jenisCuti);
        
        if (jenisCutiLower.includes('umum') || jenisCutiLower.includes('sakit') || jenisCutiLower.includes('keagamaan')) {
            return {
                backgroundColor: '#28a745',
                borderColor: '#28a745'
            };
        }
        if (jenisCutiLower.includes('nikah') || jenisCutiLower.includes('menikah')) {
            return {
                backgroundColor: '#007bff',
                borderColor: '#007bff'
            };
        }
        if (jenisCutiLower.includes('melahirkan') || jenisCutiLower.includes('lahir')) {
            return {
                backgroundColor: '#dc3545',
                borderColor: '#dc3545'
            };
        }

        // Log jika tidak ada yang cocok
        console.log('Tidak ada warna yang cocok untuk:', jenisCuti);
        return {
            backgroundColor: '#6c757d',
            borderColor: '#6c757d'
        };
    }

    // Fungsi helper untuk menambah hari
    function addDays(date, days) {
        const result = new Date(date);
        result.setDate(result.getDate() + days);
        return result.toISOString().split('T')[0];
    }

    // Fungsi helper untuk format tanggal
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        const options = { day: '2-digit', month: 'long', year: 'numeric' };
        return date.toLocaleDateString('id-ID', options);
    }

    // Fungsi untuk mengambil detail pegawai
    async function fetchPegawaiDetail(idPegawai) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/pegawai/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const data = await response.json();
            return data.data;
        } catch (error) {
            console.error('Error fetching employee details:', error);
            return null;
        }
    }

    // Initialize the calendar
    const calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'timeGrid', 'interaction'],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: false,
        selectable: false,
        eventDidMount: function(info) {
            $(info.el).tooltip({
                title: `${info.event.title}\nStatus: Disetujui`,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        },
        eventClick: function(info) {
            Swal.fire({
                title: info.event.title,
                html: `
                    <div class="text-left">
                        <p><strong>Nama Pegawai:</strong> ${info.event.extendedProps.nama_lengkap}</p>
                        <p><strong>Jenis Cuti:</strong> ${info.event.extendedProps.jenis_cuti}</p>
                        <p><strong>Tanggal Mulai:</strong> ${formatDate(info.event.start)}</p>
                        <p><strong>Tanggal Selesai:</strong> ${formatDate(info.event.extendedProps.tanggal_selesai)}</p>
                        <p><strong>Alasan:</strong> ${info.event.extendedProps.alasan || '-'}</p>
                    </div>
                `,
                icon: 'info'
            });
        }
    });

    // Function to fetch and display leave data
    async function fetchLeaveData() {
        try {
            const response = await fetch('/api/cuti', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            const data = result.data || result;

            if (!data || !Array.isArray(data)) {
                console.error('Invalid data format received:', result);
                throw new Error('Invalid data format received from server');
            }

            // Clear existing events
            calendar.removeAllEvents();

            // Add events from the fetched data
            for (const cuti of data) {
                // Skip if not approved or missing required fields
                if (
                    !cuti.tanggal_mulai || 
                    !cuti.tanggal_selesai || 
                    (cuti.status || '').toLowerCase() !== 'disetujui'
                ) {
                    continue;
                }

                // Fetch employee details
                const pegawaiDetail = await fetchPegawaiDetail(cuti.id_pegawai);
                const namaLengkap = pegawaiDetail ? pegawaiDetail.nama_lengkap : 'Nama tidak ditemukan';
                
                // Log untuk debugging
                console.log('Data Cuti:', cuti);
                console.log('Jenis Cuti dari API:', cuti.jenis_cuti);
                
                const jenisCutiName = cuti.jenis_cuti?.nama_jenis_cuti || 'Tidak Diketahui';
                
                // Get color based on leave type
                const eventColor = getColorByLeaveType(jenisCutiName);
                
                calendar.addEvent({
                    title: `${namaLengkap} - ${jenisCutiName}`,
                    start: cuti.tanggal_mulai,
                    end: addDays(cuti.tanggal_selesai, 1),
                    backgroundColor: eventColor.backgroundColor,
                    borderColor: eventColor.borderColor,
                    extendedProps: {
                        id_pegawai: cuti.id_pegawai,
                        nama_lengkap: namaLengkap,
                        jenis_cuti: jenisCutiName,
                        alasan: cuti.alasan,
                        tanggal_selesai: cuti.tanggal_selesai
                    }
                });
            }
        } catch (error) {
            console.error('Error fetching leave data:', error);
            Swal.fire({
                title: 'Error!',
                text: `Failed to load leave data: ${error.message}`,
                icon: 'error'
            });
        }
    }

    // Render calendar and fetch initial data
    calendar.render();
    fetchLeaveData();

    // Refresh data every 5 minutes
    setInterval(fetchLeaveData, 300000);
});
</script>
@endsection