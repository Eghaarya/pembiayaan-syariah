<!-- Required Js -->
<script src="{{ asset('js/vendor-all.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/pcoded.min.js') }}"></script>

<script>
    // Cari semua alert dengan class 'alert-animate'
    document.querySelectorAll('.alert-animate').forEach(alertBox => {
        setTimeout(() => {
            alertBox.classList.remove('alert-animate');
            alertBox.classList.add('alert-hide');
            setTimeout(() => {
                alertBox.remove();
            }, 400);
        }, 3000);
    });
</script>


</body>

</html>
