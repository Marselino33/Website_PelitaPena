<footer class="footer bg-light">
    <div
        class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
        <div>
            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/landing/" target="_blank"
                class="footer-text fw-bolder">Dinas Pemberdayaan Masyarakat Desa, Perempuan, dan Anak
            </a>
            ©
        </div>
        <div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" class="btn btn-sm btn-outline-danger" id="logout-button">
                    <i class="bx bx-log-out-circle"></i> Logout
                </button>
            </form>
        </div>
    </div>
</footer>

<script>
    document.getElementById('logout-button').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Anda yakin ingin logout?',
            text: "Anda akan keluar dari sesi saat ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
