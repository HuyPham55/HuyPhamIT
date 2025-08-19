jQuery(() => {
    let imageContainer = (data) => `<img src="${data}" style="max-width: 125px;"/>`;
    let sortingContainer = (data) => `<input class="update-sorting form-control" style="max-width: 125px;" type="number" value="${data}" max="e9"/>`;
    let datatablesCallback = () => {
        jQuery(".bt-switch input[type='checkbox']").bootstrapSwitch();
        jQuery(".btn--publish").on('click', async function() {
            let $button = $(this);
            $($button).attr("disabled", "")
            let route = $($button).data('route');
            await confirmAction(() => postData(route))
            if (typeof initialize !== 'undefined' && typeof initialize === 'function') {
                $("#datatables").DataTable().ajax.reload()
            }
            $($button).removeAttr("disabled")
        })
    }
    let filter = jQuery("#filter")
    let refreshBtn = jQuery("button.refresh")

    const initialize = function () {
        let filterData = {};
        if (filter) {
            filterData = {
                categories: jQuery("select[name='categories']").val(),
                status: jQuery("select[name='status']").val(),
            };
        }
        return jQuery("#datatables").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            destroy: true,
            ajax: {
                "url": jQuery("[name='posts.datatables']").val(),
                data: filterData
            },
            columns: [
                {data: 'title', name: 'title'},
                {data: 'sorting', name: 'sorting', render: sortingContainer},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'publish_date', name: 'publish_date'},
                {data: 'action', name: 'action', orderable: false}
            ],
            order: [[3, 'desc']],
            drawCallback: datatablesCallback
        });
    }
    let table = initialize();

    jQuery(filter).on("change", function() {
        initialize()

    })
    jQuery(filter).on("submit", function(e) {
        e.preventDefault();
        initialize()
    })

    jQuery(refreshBtn).on("click", function () {
        //vhttps://datatables.net/forums/discussion/38969/reload-refresh-table-after-event
        $("#datatables").DataTable().ajax.reload()
        jQuery(this).attr("disabled", "")
        setTimeout(() => {
            jQuery(this).removeAttr('disabled')
        }, 500)
    })


    jQuery(document).on('switchChange.bootstrapSwitch', '.change-status', function (event) {
        let field = jQuery(this).data('field');
        let tr = jQuery(this).closest("tr");
        let trId = tr.attr('id')
        let itemId = trId.split('row-id-')[1];
        let isChecked = event.target.checked;

        if (itemId) {
            patchData(jQuery("[name='posts.change_status']").val() + `/${itemId}`, {
                'field': field,
                'status': isChecked ? 1 : 0,
            });
        }
    });

    //change sorting
    jQuery(document).on('input', '.update-sorting', function (e) {
        e.stopPropagation();
        let tr = jQuery(this).closest("tr");
        let trId = tr.attr('id')
        let itemId = trId.split('row-id-')[1];
        let sorting = jQuery(this).val();

        if (itemId) {
            patchData(jQuery("[name='posts.change_sorting']").val() + `/${itemId}`, {
                'item_id': itemId,
                'sorting': sorting,
            });
        }
    });
})
