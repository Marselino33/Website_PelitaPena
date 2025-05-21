document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('exportButton');
    if (!btn) return;

    btn.addEventListener('click', function() {
        // Ambil parameter saat ini dari URL
        var params = new URLSearchParams(window.location.search);
        // Redirect ke route export dengan query string
        window.location = '/laporan/export?' + params.toString();
    });
});
