<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= base_url('assets/img/yourdevlogo.png') ?>" alt="YourDev Logo" height="100"
        width="100">
</div>

<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">System Administrators</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item font-italic active">System</li>
                        <li class="breadcrumb-item active">Administrators</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">
                    <div class="card card-primary card-secondary">
                        <div class="overlay" id="reloadOverlay">
                            <i class="fas fa-3x fa-sync-alt"></i>
                        </div>

                        <div class="card-body">
                            <table id="table_systemAdmins" class="table responsive table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-nowrap" style="width: 100px;">Admin ID</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

<script>
    $(document).ready(function () {
        $('#reloadOverlay').hide();

        $('#table_systemAdmins').DataTable({
            buttons: [{
                text: '<i class="fas fa-user-plus"></i>',
                className: 'add-btn',
                action: function (e, dt, node, config) {
                    $('#createModal_systemAdmin').modal('show');
                    // File Preview
                    const fileInput = $("#createPicture_systemAdmin");
                    const imagePreview = $("#createPicturePreview_systemAdmin");
                    imagePreview.hide();
                    fileInput.on("change", function () {
                        if (fileInput[0].files.length > 0) {
                            const selectedFile = fileInput[0].files[0];
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                imagePreview.attr("src", e.target.result);
                                imagePreview.show();
                            };
                            reader.readAsDataURL(selectedFile);
                        } else {
                            imagePreview.hide();
                        }
                    });
                }
            }, {
                text: '<i class="fa-solid fa-rotate-right"></i>',
                className: 'reload-btn',
                action: function (e, dt, node, config) {
                    $('#reloadOverlay').show();
                    dt.search('')              // Clear global search
                    dt.columns().search('')    // Clear individual column search
                    dt.order([[0, 'asc']])     // Reset sorting to the first column (adjust as needed)
                    dt.page('first')           // Reset pagination to the first page
                    dt.draw(false);
                    $('#table_systemAdmins').DataTable().ajax.reload(function () { // Reload DataTable
                        $('#reloadOverlay').hide();
                        toastr.info("Table has been reloaded", "", {
                            positionClass: "toast-top-center",
                            // preventDuplicates: true,
                        });
                    });
                }
            }, {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> Copy'
            }, {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel'
            }, {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF'
            }, {
                extend: 'colvis',
                text: '<i class="fas fa-columns"></i> Columns'
            }, {
                extend: 'collection',
                text: '<i class="fas fa-filter"></i> Filter Admin Type',
                className: 'filter-btn',
                autoClose: true,
                buttons: [
                    {
                        text: 'Super Admin',
                        action: function (e, dt, node, config) {
                            dt.column(3).search('Super Admin').draw();
                        }
                    }, {
                        text: 'Admin', // Error: Same text appear as the same as the 'text'
                        action: function (e, dt, node, config) {
                            dt.column(3).search('Admin').draw();
                        }
                    }, {
                        text: 'Encoder',
                        action: function (e, dt, node, config) {
                            dt.column(3).search('Encoder').draw();
                        }
                    }, {
                        text: 'Clear Filter',
                        action: function (e, dt, node, config) {
                            dt.column(3).search('').draw();
                        }
                    }
                ]
            }, {
                extend: 'collection',
                text: '<i class="fas fa-filter"></i> Filter System Access',
                className: 'filter-btn',
                autoClose: true,
                buttons: [
                    {
                        text: 'Authorized',
                        action: function (e, dt, node, config) {
                            dt.column(4).search('Authorized').draw();
                        }
                    }, {
                        text: 'Revoked Access',
                        action: function (e, dt, node, config) {
                            dt.column(4).search('Revoked Access').draw();
                        }
                    }, {
                        text: 'Clear Filter',
                        action: function (e, dt, node, config) {
                            dt.column(4).search('').draw();
                        }
                    }
                ]
            }],
            dom: 'Bfrtip',
            responsive: true,
            stateSave: true,
            ajax: {
                url: '<?php echo base_url("admin/populate_system_admins"); ?>',
                type: 'GET',
                dataSrc: 'system_admins'
            },
            columns: [{
                data: 'admin_id',
                render: function (data, type, row) {
                    return ' <span class="badge badge-secondary">ADMIN' + data + "</span>";
                }
            }, {
                data: 'fullname'
            }, {
                data: 'username'
            }, {
                data: 'password',
            }, {
                data: null,
                render: function (data, type, row) {
                    return '<div class="btn-group" role="group" aria-label="System Administrator Actions">' +
                        '<button type="button" class="btn bg-secondary" data-bs-toggle="modal" data-bs-target="#readModal_systemAdmin" data-id="' + row.admin_id + '" data-role="readBtn_systemAdmin"><i class="fa-solid fa-eye fa-xl" style="color: white;"></i></button>' +
                        '<button type="button" class="btn bg-primary" data-bs-toggle="modal" data-bs-target="#updateModal_systemAdmin" data-id="' + row.admin_id + '" data-role="updateBtn_systemAdmin"><i class="fa-solid fa-pen-to-square fa-xl" style="color: white;"></i></button>' +
                        '<button type="button" class="btn bg-danger" data-id="' + row.admin_id + '" data-role="deleteBtn_systemAdmin"><i class="fa-solid fa-trash fa-xl" style="color: white;"></i></button>' +
                        '</div>';
                }
            }]
        });

        $("#togglePassword").on("change", function () {
            var passwordField = $("#createPassword_systemAdmin");
            var isChecked = $(this).is(":checked");
            passwordField.attr("type", isChecked ? "text" : "password");
        });

        const createPicture_systemAdmin = $("#createPicture_systemAdmin");
        const createPicturePreview_systemAdmin = $("#createPicturePreview_systemAdmin");
        createPicture_systemAdmin.on("change", function () {
            if (createPicture_systemAdmin[0].files.length > 0) {
                const selectedFile = createPicture_systemAdmin[0].files[0];
                const reader = new FileReader();
                reader.onload = function (e) {
                    createPicturePreview_systemAdmin.attr("src", e.target.result);
                    createPicturePreview_systemAdmin.show();
                };
                reader.readAsDataURL(selectedFile);
            } else {
                createPicturePreview_systemAdmin.hide();
            }
            $('#createPictureFileName').text(createPicture_systemAdmin.val().split("\\").pop());
        });
    });

    // Create Admin: Submit Fields
    $("#createForm_systemAdmin").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            // data: $(this).serialize(),
            // contentType: "application/x-www-form-urlencoded; charset=UTF-8", //default
            // processData: true, //default

            data: new FormData(this), //multipart/form-data
            contentType: false,
            processData: false,
            type: "POST",
            url: "../server/create_admin.php",
            dataType: "json",
            headers: {
                "Authorization": "Bearer token"
            },
            // statusCode: {
            //     404: function () {
            //         toastr.error("Status 404: URL Not Found")
            //     },
            //     500: function () {
            //         toastr.error("Status 500: Server Error")
            //     }
            // },
            success: function (responseData) {
                if (responseData.status) {
                    $('#reloadOverlay').show();
                    $('#table_systemAdmins').DataTable().ajax.reload(function () {
                        $('#reloadOverlay').hide();
                        toastr.success(responseData.message)

                        createLogs(responseData.logsData.admin_id, responseData.logsData.action, responseData.logsData.description)
                    });
                    $('#createModal_systemAdmin').modal('hide'); // Hide modal
                    $(this).trigger("reset"); // Reset form
                } else {
                    toastr.error(responseData.message)
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Error occured please contact developers immediately.")
            }
        })
    })

    // Read Admin: Populate Fields
    $(document).on('click', 'button[data-role=readBtn_systemAdmin]', function () {
        $.ajax({
            url: '../server/read_admin.php',
            type: 'POST',
            data: {
                "id_systemAdmin": $(this).attr('data-id'),
            },
            dataType: 'json',
            success: function (responseData) {
                if (responseData.status) {
                    $('#readPicturePreview_systemAdmin').attr('src', '../assets/img/admin_pictures/' + responseData.systemAdminsData.picture);
                    $('#readPictureFileName').text(responseData.systemAdminsData.picture);
                    $('#readFullName_systemAdmin').val(responseData.systemAdminsData.fullname);
                    $('#readUsername_systemAdmin').val(responseData.systemAdminsData.username);
                    $('#readId_systemAdmin').val(responseData.systemAdminsData.admin_id);
                    $('#readType_systemAdmin').val(responseData.systemAdminsData.type);
                    $('#readSystemAccess_systemAdmin').val(responseData.systemAdminsData.system_access)
                    $('#readAddedBy_systemAdmin').val("Admin " + responseData.systemAdminsData.added_by);
                    $('#readDateRegistered_systemAdmin').val(formatDateTime(responseData.systemAdminsData.date_registered));
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Error occured please contact developers immediately.")
            }
        })
    })

    // Update Admin: Populate Fields
    $(document).on('click', 'button[data-role=updateBtn_systemAdmin]', function () {
        $.ajax({
            url: '../server/read_admin.php',
            type: 'POST',
            data: {
                "id_systemAdmin": $(this).attr('data-id'),
            },
            dataType: 'json',
            success: function (responseData) {
                if (responseData.status) {
                    $('#updatePicturePreview_systemAdmin').attr('src', '../assets/img/admin_pictures/' + responseData.systemAdminsData.picture);
                    $('#updatePictureFileName').text(responseData.systemAdminsData.picture);
                    $('#updateFullName_systemAdmin').val(responseData.systemAdminsData.fullname);
                    $('#updateUsername_systemAdmin').val(responseData.systemAdminsData.username);
                    $('#updateId_systemAdmin').val(responseData.systemAdminsData.admin_id);
                    $('#updateType_systemAdmin').val(responseData.systemAdminsData.type);
                    $('#updateSystemAccess_systemAdmin').val(responseData.systemAdminsData.system_access)
                    $('#updateAddedBy_systemAdmin').val("Admin " + responseData.systemAdminsData.added_by);
                    $('#updateDateRegistered_systemAdmin').val(formatDateTime(responseData.systemAdminsData.date_registered));

                    if ($('#updateId_systemAdmin').val() == $('#adminLoggedId').data('id')) {
                        $('#updateType_systemAdmin').attr('disabled', true);
                        $('#updateSystemAccess_systemAdmin').attr('disabled', true);
                        $('#updateSubmitBtn_admin').attr('disabled', true);
                    }
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Error occured please contact developers immediately.")
            }
        })

        const updatePicture_systemAdmin = $("#updatePicture_systemAdmin");
        const updatePicturePreview_systemAdmin = $("#updatePicturePreview_systemAdmin");
        updatePicture_systemAdmin.on("change", function () {
            if (updatePicture_systemAdmin[0].files.length > 0) {
                const selectedFile = updatePicture_systemAdmin[0].files[0];
                const reader = new FileReader();
                reader.onload = function (e) {
                    updatePicturePreview_systemAdmin.attr("src", e.target.result);
                    updatePicturePreview_systemAdmin.show();
                };
                reader.readAsDataURL(selectedFile);
            } else {
                updatePicturePreview_systemAdmin.hide();
            }
            $('#updatePictureFileName').text(updatePicture_systemAdmin.val().split("\\").pop());
        });
    })

    // Update Admin: Update Fields
    $("#updateForm_systemAdmin").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '../server/update_admin.php',
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (responseData) {
                if (responseData.status) {
                    $('#reloadOverlay').show();
                    $('#table_systemAdmins').DataTable().ajax.reload(function () {
                        $('#reloadOverlay').hide();
                        toastr.success(responseData.message);

                        createLogs(responseData.logsData.admin_id, responseData.logsData.action, responseData.logsData.description)
                    });
                    $('#updateModal_systemAdmin').modal('hide'); // Hide modal
                    $(this).trigger("reset"); // Reset form
                }
            },
            error: function (xhr, status, error) {
                toastr.error("Error occured please contact developers immediately.")
            }
        })
    })

    $(document).on('click', 'button[data-role=deleteBtn_systemAdmin]', function () {
        var deleteId_systemAdmin = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to retrieve ADMIN" + deleteId_systemAdmin + " after doing this action.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete ADMIN " + deleteId_systemAdmin + "!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../server/delete_admin.php',
                    type: 'POST',
                    data: {
                        "deleteId_systemAdmin": deleteId_systemAdmin
                    },
                    dataType: 'json',
                    success: function (responseData) {
                        if (responseData.status) {
                            $('#reloadOverlay').show();
                            $('#table_systemAdmins').DataTable().ajax.reload(function () {
                                $('#reloadOverlay').hide();
                                toastr.success(responseData.message);

                                createLogs(responseData.logsData.admin_id, responseData.logsData.action, responseData.logsData.description)
                            });
                        } else {
                            toastr.error(responseData.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        toastr.error("Error occurred. Please contact developers immediately.");
                    }
                });
            }
        });
    })
</script>