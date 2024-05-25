<div class="position-fixed text-center" id="submit__float">
    <button type="submit" title="Save" class="shadow border-0 bg-primary">
        <i class="fa fa-save text-xl"></i>
    </button>
</div>

@push('css')
    <style>
        #submit__float.active {
            opacity: 100;
            visibility: visible;
        }

        #submit__float {
            bottom: 100px;
            right: 10px;
            z-index: 1000;
            transition: all linear 100ms;

            opacity: 0;
            visibility: hidden;
        }

        #submit__float button {
            width: 64px;
            height: 64px;
            border-radius: 50%;
        }
    </style>
@endpush

@push('js')
    <script>
        jQuery(window).on('scroll', function () {
            if (jQuery(window).scrollTop() < document.documentElement.scrollHeight - document.documentElement.clientHeight - window.innerHeight) {
                jQuery('#submit__float').addClass('active');
            } else {
                jQuery('#submit__float').removeClass('active');
            }
        });
    </script>
@endpush
