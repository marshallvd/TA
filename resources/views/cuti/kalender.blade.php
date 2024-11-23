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
                        <p><strong>ID Pegawai:</strong> ${info.event.extendedProps.id_pegawai}</p>
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
            data.forEach(cuti => {
                // Skip if not approved or missing required fields
                if (
                    !cuti.tanggal_mulai || 
                    !cuti.tanggal_selesai || 
                    (cuti.status || '').toLowerCase() !== 'disetujui'
                ) {
                    return;
                }

                const jenisCutiName = cuti.jenis_cuti?.nama_jenis_cuti || 'Tidak Diketahui';
                
                calendar.addEvent({
                    title: `ID Pegawai: ${cuti.id_pegawai} - ${jenisCutiName}`,
                    start: cuti.tanggal_mulai,
                    end: addDays(cuti.tanggal_selesai, 1),
                    backgroundColor: '#28a745', // Warna hijau untuk cuti yang disetujui
                    borderColor: '#28a745',
                    extendedProps: {
                        id_pegawai: cuti.id_pegawai,
                        jenis_cuti: jenisCutiName,
                        alasan: cuti.alasan,
                        tanggal_selesai: cuti.tanggal_selesai
                    }
                });
            });
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