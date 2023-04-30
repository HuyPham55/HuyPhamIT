@push('css')
    <link rel="stylesheet" href="/backend/assets/libs/dropzone@5.9.3/dropzone.min.css" type="text/css"/>
    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
@endpush
@push('js')
    <script src="/backend/assets/libs/dropzone@5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
    </script>
@endpush

@section('example_dropzone')
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="dropzone" class="form-label">{{trans('label.slide')}}</label>
            <div id="dZUpload" class="dropzone bg-light shadow">
            </div>
        </div>
        <div class="row" id="sortable">
            @foreach([] as $photo)
                <div class="col-md-2 col-4 slide-item">
                    <div class="card">
                        <a href="{{$photo}}" target="_blank">
                            <img class="card-img-top" src="{{ $photo }}" title="{{$photo}}">
                        </a>
                        <div class="card-footer">
                            <div class="row mb-3">
                                <input class="form-control update-card-image" type="text" name="slides[]"
                                       value="{{ $photo }}">
                            </div>

                            <div class="row justify-content-between">
                                <button class="btn-copy btn btn-primary" data-content="{{$photo}}" type="button">
                                    <i class="fa fa-copy"></i>
                                    {{trans('label.action.copy')}}
                                </button>
                                <button type="button" class="delete-photo btn btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                    {{trans('label.action.delete')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        Dropzone.autoDiscover = false;
        let dropzoneSelector = "#dZUpload"
        document.addEventListener('DOMContentLoaded', function () {
            let options = {
                url: "{{route("file.post_image")}}",
                headers: {
                    'x-csrf-token': '{{ csrf_token() }}',
                },
                params: {path: 'photos/shares/products'},
                paramName: 'image',
                parallelUploads: 3,
                addRemoveLinks: true,
                success: function (file, res) {
                    let data = res.data;
                    let path = data.path
                    let el = document.querySelector(dropzoneSelector);
                    if (!el) return

                    let div = document.createElement("div");
                    div.setAttribute("hidden", "true");
                    div.innerHTML = '<input name="slides[]"  value="' + path + '">'
                    el.append(div);
                    toastr.success(res.message);
                }
            }
            const dropzone = new Dropzone(dropzoneSelector, options);

            $(".delete-photo").on('click', function () {
                let slideItem = $(this).parents(".slide-item")
                slideItem.remove()
            });

            $(".btn-copy").on("click", function () {
                let url = $(this).data('content');
                navigator.clipboard.writeText(url)
                toastr.success(labels.status.success)
            })

            $(".update-card-image").on('change', function() {
                let newValue = $(this).val();
                let card = $(this).parents(".card").first();
                if (newValue.trim()) {
                    $(card).find("img.card-img-top").attr('src', newValue);
                }
            })
        })
    </script>
@endsection
