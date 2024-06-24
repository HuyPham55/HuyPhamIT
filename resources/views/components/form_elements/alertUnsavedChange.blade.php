@push('js')
    <script type="text/javascript">
        jQuery(() => {
            jQuery("form input,textarea").on('input', function () {
                if (!document.body.onbeforeunload) {
                    document.body.onbeforeunload = function (e) {
                        e.preventDefault()
                        return 1;
                    }
                }
            })

            jQuery("form button[type='submit']").on('click', function () {
                document.body.onbeforeunload = () => {
                }
            })
        })
    </script>
@endpush
