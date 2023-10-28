@push('js')
    <script type="text/javascript">
        jQuery(() => {
            jQuery("form input,textarea").on('input', function () {
                document.body.onbeforeunload = function (e) {
                    e.preventDefault()
                    return 1;
                }
            })
        })
    </script>
@endpush
