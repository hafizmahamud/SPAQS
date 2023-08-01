/* eslint-disable babel/no-invalid-this */
/* eslint-disable no-invalid-this */

$(function () {
    /**
     * Checkbox tree for permission selecting
     */
    let permissionTree = $('.permission-tree :checkbox');

    permissionTree.on('click change', function (){
        if($(this).is(':checked')) { /*error Unexpected 'this'.*/
            $(this).siblings('ul').find('input[type="checkbox"]').attr('checked', true).attr('disabled', true);
        } else {
            $(this).siblings('ul').find('input[type="checkbox"]').removeAttr('checked').removeAttr('disabled');
        }
    });

    permissionTree.each(function () {
        if($(this).is(':checked')) {
            $(this).siblings('ul').find('input[type="checkbox"]').attr('checked', true).attr('disabled', true);
        }
    });

    /**
     * Disable submit inputs in the given form
     *
     * @param form
     */
    function disableSubmitButtons(form) {
        form.find('input[type="submit"]').attr('disabled', true);
        form.find('button[type="submit"]').attr('disabled', true);
    }

    /**
     * Enable the submit inputs in a given form
     *
     * @param form
     */
    function enableSubmitButtons(form) {
        form.find('input[type="submit"]').removeAttr('disabled');
        form.find('button[type="submit"]').removeAttr('disabled');
    }

    /**
     * Disable all submit buttons once clicked
     */
    $('form').submit(function () {
        disableSubmitButtons($(this));
        return true;
    });

    /**
     * Add a confirmation to a delete button/form
     */
    $('body').on('submit', 'form[name=delete-item]', function(e) {
        e.preventDefault();
        var formAction = $(this).attr("action");
        formAction = formAction.split("/");
        userId = formAction[formAction.length - 1];
        console.log(formAction[formAction.length - 1]);
        $.ajax({
            url: '/admin/auth/user/semakpengguna/',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'userId': userId
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {
                Swal.fire({
                    title: 'Adakah Anda Pasti Untuk Padam Pengguna Ini?',
                    showCancelButton: true,
                    html: '<label style="color:red;">Pengguna Ini Mempunyai ' + response + ' Perolehan Yang Aktif.',
                    confirmButtonText: 'Padam',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    icon: 'warning'
                }).then((result) => {
                    if (result.value) {
                        this.submit()
                    } else {
                        enableSubmitButtons($(this));
                    }
                });
            }
        });

    })
        .on('submit', 'form[name=confirm-item]', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Adakah anda pasti untuk meneruskan?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                icon: 'warning'
            }).then((result) => {
                if (result.value) {
                    this.submit()
                } else {
                    enableSubmitButtons($(this));
                }
            });
        })
        .on('click', 'a[name=confirm-item]', function (e) {
        /**
         * Add an 'are you sure' pop-up to any button/link
         */
        e.preventDefault();

        Swal.fire({
            title: 'Adakah anda pasti untuk meneruskan?',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            icon: 'info',
        }).then((result) => {
            result.value && window.location.assign($(this).attr('href'));
        });
    });

    // Remember tab on page load
    $('a[data-toggle="tab"], a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        let hash = $(e.target).attr('href');
        history.pushState ? history.pushState(null, null, hash) : location.hash = hash;
    });

    let hash = window.location.hash;
    if (hash) {
        $('.nav-link[href="'+hash+'"]').tab('show');
    }

    // Enable tooltips everywhere
    $('[data-toggle="tooltip"]').tooltip();
});
