$('.update-status-soal').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Mengubah Status Soal',
        text: " Apakah anda yakin ingin mengubah status soal?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: 'blue',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ubah Status'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

$('.tambah-data-soal').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Menambah Data Soal',
        text: " Apakah anda yakin ingin menyimpan data soal ini?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: 'blue',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Simpan Data'
    }).then((result) => {
        if (result.value) {
            this.submit();
        }
    });
});

$('.simpan-data-jawaban').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Menyimpan Jawaban',
        text: " Apakah anda ingin menyimpan jawaban ini?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: 'blue',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Simpan Jawaban'
    }).then((result) => {
        if (result.value) {
            this.submit();
        }
    });
});

$('.logout').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Logout',
        text: " Apakah anda yakin ingin Keluar?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: 'blue',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Keluar'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});