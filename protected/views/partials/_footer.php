<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <p class="mb-0 text-muted">
                        &copy; <span id="currentYear" aria-label="Current year"></span> | Sistem Informasi Klinik. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    });
</script>
