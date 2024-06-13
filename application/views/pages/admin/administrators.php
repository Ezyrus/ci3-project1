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
                            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                                data-bs-target="#createModal_systemAdmin" id="createAdmin_systemAdmin">Add
                                Admin</button>
                            <table id="table_systemAdmins" class="table responsive table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-nowrap" style="width: 100px;">Admin ID</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th style="width: 200px;">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($systemAdmins as $admin): ?>
                                        <tr>
                                            <td><?php echo $admin['admin_id']; ?></td>
                                            <td><?php echo $admin['fullname']; ?></td>
                                            <td><?php echo $admin['username']; ?></td>
                                            <td><?php echo $admin['password']; ?></td>
                                            <td>
                                                <div class="btn-group" role="group"
                                                    aria-label="System Administrator Actions">
                                                    <button type="button" class="btn bg-secondary" data-bs-toggle="modal"
                                                        data-bs-target="#readModal_systemAdmin"
                                                        data-id="<?php echo $admin['admin_id']; ?>"
                                                        data-role="readBtn_systemAdmin">
                                                        <i class="fa-solid fa-eye fa-xl" style="color: white;"></i>
                                                    </button>
                                                    <button type="button" class="btn bg-primary" data-bs-toggle="modal"
                                                        data-bs-target="#updateModal_systemAdmin"
                                                        data-id="<?php echo $admin['admin_id']; ?>"
                                                        data-role="updateBtn_systemAdmin">
                                                        <i class="fa-solid fa-pen-to-square fa-xl"
                                                            style="color: white;"></i>
                                                    </button>
                                                    <button type="button" class="btn bg-danger"
                                                        data-id="<?php echo $admin['admin_id']; ?>"
                                                        data-role="deleteBtn_systemAdmin">
                                                        <i class="fa-solid fa-trash fa-xl" style="color: white;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

<!--- Create Administrator ----->
<div class="modal fade" id="createModal_systemAdmin" tabindex="-1" data-bs-backdrop="static" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open("operations/create/administrators"); ?>
            <div class="modal-header bg-success">
                <h1 class="modal-title fs-5 text-center">Add System Administrator</h1>
            </div>

            <div class="modal-body">
                <!-- <div class="row mb-2">
                        <div class="col">
                            <label for="createPicturePreview_systemAdmin">Picture: </label>
                            <span id="createPictureFileName" class="text-muted font-weight-normal font-italic"></span>
                            <img alt="Admin Picture" id="createPicturePreview_systemAdmin" class="w-100 mb-2">
                            <input type="file" class="form-control" id="createPicture_systemAdmin"
                                name="createPicture_systemAdmin" required>
                        </div>
                    </div> -->

                <div class="row mb-2">
                    <div class="col">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name"
                            required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <input type="checkbox" id="togglePassword">
                        <label class="form-check-label" for="togglePassword"><b>Show
                                Password</b></label>
                    </div>
                </div>

                <!-- <div class="row">
                        <div class="col">
                            <label for="createType_systemAdmin">Type
                                <span class="d-inline-block " tabindex="0" data-toggle="tooltip"
                                    title="Admin Access Type">
                                    <i class="fas fa-question-circle"></i>
                                </span>
                            </label>
                            <select class="form-control" id="createType_systemAdmin" name="createType_systemAdmin">
                                <option value="ad3">Encoder</option>
                                <option value="ad2">Admin</option>
                                <option value="ad1">Super Admin</option>
                            </select>
                        </div>
                    </div> -->
            </div>

            <div class="modal-footer justify-content-between bg-gray-light">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" id="createSubmitBtn_admin">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!--- Read Administrator ----->
<div class="modal fade" id="readModal_systemAdmin" tabindex="-1" data-bs-backdrop="static" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="readForm_systemAdmin">
                <div class="modal-header bg-secondary">
                    <h1 class="modal-title fs-5 text-center">View System Administrator</h1>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- <div class="col border border-3">
                            <label for="readPicturePreview_systemAdmin">Picture: <span id="readPictureFileName"
                                    class="text-muted font-weight-normal font-italic"></span></label>
                            <img alt="Admin Picture" id="readPicturePreview_systemAdmin" class="w-100 mb-2">
                        </div> -->

                        <div class="col">
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="readFullName_systemAdmin">Full Name</label>
                                    <input type="text" class="form-control text-capitalize"
                                        id="readFullName_systemAdmin" name="readFullName_systemAdmin"
                                        placeholder="Full Name" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <label for="readUsername_systemAdmin">Username</label>
                                    <input type="text" class="form-control" id="readUsername_systemAdmin"
                                        name="readUsername_systemAdmin" placeholder="Username" readonly>
                                </div>

                                <div class="col-5">
                                    <label for="readId_systemAdmin">Admin ID</label>
                                    <input type="text" class="form-control" id="readId_systemAdmin"
                                        name="readId_systemAdmin" placeholder="ID" readonly>
                                </div>
                            </div>

                            <!-- <div class="row mb-2">
                            <div class="col">
                                <label for="readType_systemAdmin">Type
                                    <span class="d-inline-block " tabindex="0" data-toggle="tooltip"
                                        title="Admin Access Type">
                                        <i class="fas fa-question-circle"></i>
                                    </span>
                                </label>
                                <select class="form-control" id="readType_systemAdmin" name="readType_systemAdmin"
                                    readonly disabled>
                                    <option value="ad3">Encoder</option>
                                    <option value="ad2">Admin</option>
                                    <option value="ad1">Super Admin</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="readSystemAccess_systemAdmin">System Access
                                    <span class="d-inline-block " tabindex="0" data-toggle="tooltip"
                                        title="Admin System Permission">
                                        <i class="fas fa-question-circle"></i>
                                    </span>
                                </label>
                                <select class="form-control" id="readSystemAccess_systemAdmin"
                                    name="readSystemAccess_systemAdmin" readonly disabled>
                                    <option value="1">Authorize Access</option>
                                    <option value="0">Revoke Access</option>
                                </select>
                            </div>
                        </div> -->

                            <!-- <div class="row mb-2">
                                <div class="col">
                                    <label for="readAddedBy_systemAdmin">Added By</label>
                                    <input type="text" class="form-control text-capitalize" id="readAddedBy_systemAdmin"
                                        name="readAddedBy_systemAdmin" placeholder="Added By" readonly>
                                </div>
                            </div> -->

                            <!-- <div class="row">
                                <div class="col">
                                    <label for="readDateRegistered_systemAdmin">Date Registered </label>
                                    <input type="text" class="form-control" id="readDateRegistered_systemAdmin"
                                        name="readDateRegistered_systemAdmin" placeholder="Date Registered" readonly>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between bg-gray-light">
                    <button type="button" class="btn btn-default w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--- Update Administrator ----->
<div class="modal fade" id="updateModal_systemAdmin" tabindex="-1" data-bs-backdrop="static" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?php echo form_open("operations/update/administrators"); ?>
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-center">Update System Administrator</h1>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col border border-3">
                            <label for="updatePicturePreview_systemAdmin">Picture: </label>
                            <span id="updatePictureFileName" class="text-muted font-weight-normal font-italic"></span>
                            <img alt="Admin Picture" id="updatePicturePreview_systemAdmin" class="w-100 mb-2">
                            <input type="file" class="form-control mb-3" id="updatePicture_systemAdmin"
                                name="updatePicture_systemAdmin">
                        </div> -->

                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="updateFullName_systemAdmin">Full Name</label>
                                <input type="text" class="form-control text-capitalize" id="updateFullName_systemAdmin"
                                    name="updateFullName_systemAdmin" placeholder="Full Name" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-7">
                                <label for="updateUsername_systemAdmin">Username</label>
                                <input type="text" class="form-control" id="updateUsername_systemAdmin"
                                    name="updateUsername_systemAdmin" placeholder="Username" readonly>
                            </div>

                            <div class="col-5">
                                <label for="updateId_systemAdmin">Admin ID</label>
                                <input type="text" class="form-control" id="updateId_systemAdmin"
                                    name="updateId_systemAdmin" placeholder="ID" readonly>
                            </div>
                        </div>

                        <!-- <div class="row mb-2">
                                <div class="col">
                                    <label for="updateType_systemAdmin">Type
                                        <span class="d-inline-block " tabindex="0" data-toggle="tooltip"
                                            title="Admin Access Type">
                                            <i class="fas fa-question-circle"></i>
                                        </span>
                                    </label>
                                    <select class="form-control" id="updateType_systemAdmin"
                                        name="updateType_systemAdmin" required>
                                        <option value="ad3">Encoder</option>
                                        <option value="ad2">Admin</option>
                                        <option value="ad1">Super Admin</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="updateSystemAccess_systemAdmin">System Access
                                        <span class="d-inline-block " tabindex="0" data-toggle="tooltip"
                                            title="Admin System Permission">
                                            <i class="fas fa-question-circle"></i>
                                        </span>
                                    </label>
                                    <select class="form-control" id="updateSystemAccess_systemAdmin"
                                        name="updateSystemAccess_systemAdmin" required>
                                        <option value="1">Authorize Access</option>
                                        <option value="0">Revoke Access</option>
                                    </select>
                                </div>
                            </div> -->

                        <!-- <div class="row mb-2">
                                <div class="col">
                                    <label for="updateAddedBy_systemAdmin">Added By</label>
                                    <input type="text" class="form-control text-capitalize"
                                        id="updateAddedBy_systemAdmin" name="updateAddedBy_systemAdmin"
                                        placeholder="Added By" readonly>
                                </div>
                            </div> -->

                        <!-- <div class="row">
                                <div class="col">
                                    <label for="updateDateRegistered_systemAdmin">Date Registered </label>
                                    <input type="text" class="form-control" id="updateDateRegistered_systemAdmin"
                                        name="updateDateRegistered_systemAdmin" placeholder="Date Registered" readonly>
                                </div>
                            </div> -->
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between bg-gray-light">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updateSubmitBtn_admin">Update</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#reloadOverlay').hide();

        // $('#table_systemAdmins').DataTable({
        //     buttons: [{
        //         text: '<i class="fas fa-user-plus"></i>',
        //         className: 'add-btn',
        //         action: function (e, dt, node, config) {
        //             $('#createModal_systemAdmin').modal('show');
        //             // File Preview
        //             const fileInput = $("#createPicture_systemAdmin");
        //             const imagePreview = $("#createPicturePreview_systemAdmin");
        //             imagePreview.hide();
        //             fileInput.on("change", function () {
        //                 if (fileInput[0].files.length > 0) {
        //                     const selectedFile = fileInput[0].files[0];
        //                     const reader = new FileReader();
        //                     reader.onload = function (e) {
        //                         imagePreview.attr("src", e.target.result);
        //                         imagePreview.show();
        //                     };
        //                     reader.readAsDataURL(selectedFile);
        //                 } else {
        //                     imagePreview.hide();
        //                 }
        //             });
        //         }
        //     }, {
        //         text: '<i class="fa-solid fa-rotate-right"></i>',
        //         className: 'reload-btn',
        //         action: function (e, dt, node, config) {
        //             $('#reloadOverlay').show();
        //             dt.search('')              // Clear global search
        //             dt.columns().search('')    // Clear individual column search
        //             dt.order([[0, 'asc']])     // Reset sorting to the first column (adjust as needed)
        //             dt.page('first')           // Reset pagination to the first page
        //             dt.draw(false);
        //             $('#table_systemAdmins').DataTable().ajax.reload(function () { // Reload DataTable
        //                 $('#reloadOverlay').hide();
        //                 toastr.info("Table has been reloaded", "", {
        //                     positionClass: "toast-top-center",
        //                     // preventDuplicates: true,
        //                 });
        //             });
        //         }
        //     }, {
        //         extend: 'copy',
        //         text: '<i class="fas fa-copy"></i> Copy'
        //     }, {
        //         extend: 'excel',
        //         text: '<i class="fas fa-file-excel"></i> Excel'
        //     }, {
        //         extend: 'pdf',
        //         text: '<i class="fas fa-file-pdf"></i> PDF'
        //     }, {
        //         extend: 'colvis',
        //         text: '<i class="fas fa-columns"></i> Columns'
        //     }, {
        //         extend: 'collection',
        //         text: '<i class="fas fa-filter"></i> Filter Admin Type',
        //         className: 'filter-btn',
        //         autoClose: true,
        //         buttons: [
        //             {
        //                 text: 'Super Admin',
        //                 action: function (e, dt, node, config) {
        //                     dt.column(3).search('Super Admin').draw();
        //                 }
        //             }, {
        //                 text: 'Admin', // Error: Same text appear as the same as the 'text'
        //                 action: function (e, dt, node, config) {
        //                     dt.column(3).search('Admin').draw();
        //                 }
        //             }, {
        //                 text: 'Encoder',
        //                 action: function (e, dt, node, config) {
        //                     dt.column(3).search('Encoder').draw();
        //                 }
        //             }, {
        //                 text: 'Clear Filter',
        //                 action: function (e, dt, node, config) {
        //                     dt.column(3).search('').draw();
        //                 }
        //             }
        //         ]
        //     }, {
        //         extend: 'collection',
        //         text: '<i class="fas fa-filter"></i> Filter System Access',
        //         className: 'filter-btn',
        //         autoClose: true,
        //         buttons: [
        //             {
        //                 text: 'Authorized',
        //                 action: function (e, dt, node, config) {
        //                     dt.column(4).search('Authorized').draw();
        //                 }
        //             }, {
        //                 text: 'Revoked Access',
        //                 action: function (e, dt, node, config) {
        //                     dt.column(4).search('Revoked Access').draw();
        //                 }
        //             }, {
        //                 text: 'Clear Filter',
        //                 action: function (e, dt, node, config) {
        //                     dt.column(4).search('').draw();
        //                 }
        //             }
        //         ]
        //     }],
        //     dom: 'Bfrtip',
        //     responsive: true,
        //     stateSave: true,
        //     ajax: {
        //         url: '<?php //echo base_url("admin/populateSystemAdministrators"); ?>',
        //         type: 'GET',
        //         dataSrc: 'system_admins'
        //     },
        //     columns: [{
        //         data: 'admin_id',
        //         render: function (data, type, row) {
        //             return ' <span class="badge badge-secondary">ADMIN' + data + "</span>";
        //         }
        //     }, {
        //         data: 'fullname'
        //     }, {
        //         data: 'username'
        //     }, {
        //         data: 'password',
        //     }, {
        //         data: null,
        //         render: function (data, type, row) {
        //             return '<div class="btn-group" role="group" aria-label="System Administrator Actions">' +
        //                 '<button type="button" class="btn bg-secondary" data-bs-toggle="modal" data-bs-target="#readModal_systemAdmin" data-id="' + row.admin_id + '" data-role="readBtn_systemAdmin"><i class="fa-solid fa-eye fa-xl" style="color: white;"></i></button>' +
        //                 '<button type="button" class="btn bg-primary" data-bs-toggle="modal" data-bs-target="#updateModal_systemAdmin" data-id="' + row.admin_id + '" data-role="updateBtn_systemAdmin"><i class="fa-solid fa-pen-to-square fa-xl" style="color: white;"></i></button>' +
        //                 '<button type="button" class="btn bg-danger" data-id="' + row.admin_id + '" data-role="deleteBtn_systemAdmin"><i class="fa-solid fa-trash fa-xl" style="color: white;"></i></button>' +
        //                 '</div>';
        //         }
        //     }]
        // });

        $("#togglePassword").on("change", function () {
            var passwordField = $("#password");
            var isChecked = $(this).is(":checked");
            passwordField.attr("type", isChecked ? "text" : "password");
        });
    });

    // Read Admin: Populate Fields
    $(document).on('click', 'button[data-role=readBtn_systemAdmin]', function () {
        const adminId = $(this).attr('data-id');
        const table = 'administrators';

        $.ajax({
            url: '<?php echo site_url('operations/read'); ?>/' + adminId + '/' + table,
            type: 'GET',
            dataType: 'json',
            success: function (responseData) {
                $('#readFullName_systemAdmin').val(responseData.fullname);
                $('#readUsername_systemAdmin').val(responseData.username);
                $('#readId_systemAdmin').val(responseData.admin_id);
            },
            error: function (xhr, status, error) {
                toastr.error("Error occurred, please contact developers immediately.");
            }
        });
    });

    // Update Admin: Populate Fields
    $(document).on('click', 'button[data-role=updateBtn_systemAdmin]', function () {
        const adminId = $(this).attr('data-id');
        const table = 'administrators';

        $.ajax({
            url: '<?php echo site_url('operations/read'); ?>/' + adminId + '/' + table,
            type: 'GET',
            dataType: 'json',
            success: function (responseData) {
                $('#updateFullName_systemAdmin').val(responseData.fullname);
                $('#updateUsername_systemAdmin').val(responseData.username);
                $('#updateId_systemAdmin').val(responseData.admin_id);
            },
            error: function (xhr, status, error) {
                toastr.error("Error occured please contact developers immediately.")
            }
        })
    })

</script>