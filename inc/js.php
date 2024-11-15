<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="asset/assets/vendor/libs/jquery/jquery.js"></script>
<script src="asset/assets/vendor/libs/popper/popper.js"></script>
<script src="asset/assets/vendor/js/bootstrap.js"></script>
<script src="asset/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="asset/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="asset/assets/js/main.js"></script>

<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<script>
    $(document).ready(function() {
        $(".mySummernote").summernote({
            height: 250
        });
        $('.dropdown-toggle').dropdown();
    });
</script>