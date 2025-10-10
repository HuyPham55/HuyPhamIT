"use strict";
async function confirmAction(callback) {
    return await Swal.fire({
        title: labels.action.confirm_action,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        cancelButtonText: labels.cancel,
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((isConfirm) => {
        if (typeof Swal == 'undefined') {
            return
        }
        if (isConfirm.value) {
            callback();
        } else {
            Swal.fire(labels.status.canceled, '', "error");
        }
    });
}

//Delete confirmation
async function confirmDelete(url, itemId, token) {
    let callback = function () {
        jQuery.post(url, {
            item_id: itemId,
            _token: token
        }, function (data) {
            if (data.status === 'success') {
                jQuery("#row-id-" + itemId).slideUp();
                Swal.fire(data.title + "!", data.message, "success");
            } else {
                Swal.fire(data.title + "!", data.message, data.status);
            }
            if (typeof data.reload != 'undefined' && data.reload) {
                window.location.reload();
            }
        }).fail((res) => {
            Swal.fire(labels.status.canceled, res.statusText, "error");
        });
    }
    return await confirmAction(callback)
}

//check all
//Used at role/form
jQuery("#check-all").change(function () {
    jQuery('input:checkbox').not(this).prop('checked', this.checked);
});

function resetInput(id) {
    jQuery("input#" + id).val('');
    jQuery("#image-preview-" + id).find('img').attr("src", "/images/no-image.png");
}

async function postData(route, dataPost = {}) {
    if (!dataPost.hasOwnProperty('_token')) {
        dataPost['_token'] = jQuery('meta[name="csrf-token"]').attr('content');
    }
    return await jQuery.post(route, dataPost)
        .done(function (data) {
            if (typeof toastr != 'undefined') {
                if (data.status && data.status === 'success') {
                    toastr.success(data.message, 'Success');
                } else {
                    if (data.status && data.status === 'error') {
                        toastr.error(data.message, 'Error');
                    }
                }
            }
        })
        .fail(function (data) {
            if (data.status === 422) {
                let response = data.responseJSON;
                if (typeof toastr != 'undefined') {
                    jQuery.each(response.errors, function (key, value) {
                        toastr.error(value, 'Error');
                    });
                }
            } else {
                toastr.error(data.statusText, 'Error');
            }
        });
}

async function confirmOpen(url) {
    let callback = () => {
        window.location.href = url
    }
    return await confirmAction(callback)
}

async function confirmAjaxDelete(url, key) {
    let callback = function () {
        jQuery.ajax({
            url,
            type: 'DELETE',
            data: {
                _token: jQuery('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data)
                if (data.status === 'success') {
                    jQuery("#row-id-" + key).slideUp();
                    Swal.fire(data.title + "!", data.message, "success");
                } else {
                    Swal.fire(data.title + "!", data.message, data.status);
                }
                if (typeof data.reload != 'undefined' && data.reload) {
                    window.location.reload();
                }
            }
        }).fail((res) => {
            Swal.fire(labels.status.canceled, res.statusText, "error");
        });
    }
    return await confirmAction(callback)
}

async function patchData(route, dataPost) {
    if (!dataPost.hasOwnProperty('_token')) {
        dataPost['_token'] = jQuery('meta[name="csrf-token"]').attr('content');
    }
    return await jQuery.ajax({
        url: route,
        type: 'PATCH',
        data: dataPost,
        success: function (data) {
            if (typeof toastr != 'undefined') {
                if (data.status && data.status === 'success') {
                    toastr.success(data.message, 'Success');
                } else {
                    if (data.status && data.status === 'error') {
                        toastr.error(data.message, 'Error');
                    }
                }
            }
        }})
        .fail(function (data) {
            if (data.status === 422) {
                let response = data.responseJSON;
                if (typeof toastr != 'undefined') {
                    jQuery.each(response.errors, function (key, value) {
                        toastr.error(value, 'Error');
                    });
                }
            } else {
                toastr.error(data.statusText, 'Error');
            }
        });
}

function saveUnsavedChangesToLocalStorage(item) {
    let id = jQuery(item).attr('id');
    if (typeof id !== 'undefined' && id) {
        let value = jQuery(item).val();
        let windowPath = window.location.pathname;
        let localStorageKey = 'unsaved-' + windowPath + '-' + id;
        localStorage.setItem(localStorageKey, value);
    }
}

function restoreSavedChangesFromLocalStorage() {
    jQuery(".unsaved-change").each(function (index, item) {
        let id = jQuery(item).attr('id');
        if (typeof id !== 'undefined' && id) {
            let windowPath = window.location.pathname;
            let localStorageKey = 'unsaved-' + windowPath + '-' + id;
            let savedValue = localStorage.getItem(localStorageKey);
            if (typeof savedValue !== 'undefined' && savedValue !== null) {
                if (jQuery(item).val() !== savedValue) {
                    jQuery(item).addClass('border-danger');
                    jQuery(item).after('<div class="text-danger mb-2">You have unsaved changes</div>');
                    jQuery(item).on('focus', function () {
                        jQuery(item).removeClass('border-danger');
                        jQuery(item).siblings('div.text-danger').remove();
                    });
                }
                jQuery(item).val(savedValue);
            }
        }
    })
}

function initSaveUnsavedChangesToLocalStorage() {
    jQuery(".unsaved-change").each(function (index, item) {
        jQuery(item).on("change keyup paste", function () {
            saveUnsavedChangesToLocalStorage(item);
        });
    });
}
