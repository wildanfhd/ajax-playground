<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <title>DataTables API</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="text-white">Input Data</h3>
            </div>
            <div class="card-body" id="inputForm">
                <div class="mb-3">
                    <label for="inputNama" class="form-label">Nama</label><span id="error_name"
                        class="text-danger ms-3"></span>
                    <input type="text" class="form-control nama" id="inputNama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label><span id="error_email"
                        class="text-danger ms-3"></span>
                    <input type="email" class="form-control email-input" id="inputEmail" name="email">
                </div>
                <div class="mb-3">
                    <label for="inputNoHP" class="form-label">No HP</label><span id="error_nomor"
                        class="text-danger ms-3"></span>
                    <input type="text" class="form-control no_hp" id="inputNoHP" name="no_hp">
                </div>
                <button type="submit" class="btn btn-primary" onclick="createData()">Submit</button>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-header bg-dark">
                <h3 class="text-white">DataTables with API</h3>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="inputNama" class="form-label">Nama</label><span id="error_name"
                        class="text-danger ms-3"></span>
                    <input type="text" class="form-control nama" id="editnama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label><span id="error_email"
                        class="text-danger ms-3"></span>
                    <input type="email" class="form-control email-input" id="editemail" name="email">
                </div>
                <div class="mb-3">
                    <label for="inputNoHP" class="form-label">No HP</label><span id="error_nomor"
                        class="text-danger ms-3"></span>
                    <input type="text" class="form-control no_hp" id="editnohp" name="no_hp">
                </div>
                <input type="hidden" name="id" id="editid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="editsubmit">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for=""></label>
                <div class="mb-3">
                    <label for="inputNama" class="form-label">Nama</label><span id="error_name"
                        class="text-danger ms-3"></span>
                    <input type="text" class="form-control nama" id="deletenama" name="nama" disabled>
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label><span id="error_email"
                        class="text-danger ms-3"></span>
                    <input type="email" class="form-control email-input" id="deleteemail" name="email" disabled>
                </div>
                <div class="mb-3">
                    <label for="inputNoHP" class="form-label">No HP</label><span id="error_nomor"
                        class="text-danger ms-3"></span>
                    <input type="text" class="form-control no_hp" id="deletenohp" name="no_hp" disabled>
                </div>
                <input type="hidden" name="id" id="deleteid">
                <p>Are you sure want to delete this data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="deletesubmit">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="successMessage" class="alert alert-success"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    let myTable;
    $(document).ready(function () {
        myTable = $('#myTable').DataTable({
            // processing: true,
            // serverSide: true,
            ajax: {
                url: "/table/fetch/json",
                dataSrc: ""
            },
            columns: [
                { data: "id" },
                { data: "nama" },
                { data: "email" },
                { data: "no_hp" },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-secondary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" >Edit</button> <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal"  data-id="' + row.id + '"> Delete</button>'
                    }
                },
            ],

        });
    });

    function createData() {
        // Mengecek apakah length dari input nama == 0
        if ($.trim($('.nama').val()).length == 0) {
            error_name = 'Please Enter Your Name';
            $('#error_name').text(error_name);
        } else {
            error_name = '';
            $('#error_name').text(error_name);
        }

        // Mengecek apakah length dari input email == 0
        if ($.trim($('.email-input').val()).length == 0) {
            error_email = 'Please Enter Your Email';
            $('#error_email').text(error_email);
        } else {
            error_email = '';
            $('#error_email').text(error_email);
        }

        // Mengecek apakah length dari input no_hp == 0
        if ($.trim($('.no_hp').val()).length == 0) {
            error_nomor = 'Please Enter Your Phone Number';
            $('#error_nomor').text(error_nomor);
        } else {
            error_nomor = '';
            $('#error_nomor').text(error_nomor);
        }

        // Mengecek apakah variable error dari masing-masing section != '' (kosong)
        // Jika true maka return false, jika false maka eksekusi syntax ajax
        if (error_name != '' || error_email != '' || error_nomor != '') {
            return false;
        } else {
            var formData = {
                nama: $('#inputNama').val(),
                email: $('#inputEmail').val(),
                no_hp: $('#inputNoHP').val(),
            };

            $.ajax({
                url: "/table/create/post",
                method: "POST",
                data: formData,
                success: function (data) {
                    // $('#errorMessage').addClass('d-none');
                    $('#successModal').modal('show');
                    $('#successMessage').text(data.status);
                    $('#inputForm').find('input').val('');
                    // $('#tableData').html('');
                    // loadData();
                    reloadTable();
                },
                error: function (textStatus, errorThrown) {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(data.status);
                }
            });
        }
    }

    // getEditData
    $(document).on('click', '.edit-btn', function () {
        var data = myTable.row($(this).parents('tr')).data();
        // Select row pada table dengan parents elemen yang dipilih delete

        $('#editnama').val(data['nama']);
        $('#editemail').val(data['email']);
        $('#editnohp').val(data['no_hp']);
        $('#editid').val(data['id']);
    });

    // updateData
    $(document).on('click', '#editsubmit', function () {
        var id = $('#editid').val();
        var name = $('#editnama').val();

        $.ajax({
            url: "/table/update/" + id,
            method: "POST",
            data: {
                nama: $('#editnama').val(),
                email: $('#editemail').val(),
                no_hp: $('#editnohp').val(),
            },
            success: function (response) {
                // Hide the delete modasl and reload the table on success
                $('#editModal').modal('hide');
                $('#successModal').modal('show');
                $('#successMessage').text(response.status);
                reloadTable();

                // alert('Berhasil update data : ' + name);
            }
        });
    });

    function getEditData() {
        var data = myTable.row($(this).parents('tr')).data();
        // Select row pada table dengan parents elemen yang dipilih delete

        $('#editnama').val(data['nama']);
        $('#editemail').val(data['email']);
        $('#editnohp').val(data['no_hp']);
        $('#editid').val(data['id']);
    }

    function editData() {
        var id = $('#editid').val();
        var name = $('#editnama').val();

        $.ajax({
            method: "POST",
            url: "/table/update/" + id,
            success: function (response) {
                // Hide the delete modasl and reload the table on success
                $('#editModal').modal('hide');
                $('#successModal').modal('show');
                $('#successMessage').text(response.status);
                reloadTable();

                // alert('Berhasil delete data : ' + name);
            }
        });
    }

    // getDeleteData
    $(document).on('click', '.delete-btn', function () {
        var data = myTable.row($(this).parents('tr')).data();

        $('#deletenama').val(data['nama']);
        $('#deleteemail').val(data['email']);
        $('#deletenohp').val(data['no_hp']);
        $('#deleteid').val(data['id']);
    });

    // deleteData
    $(document).on('click', '#deletesubmit', function () {
        var id = $('#deleteid').val();
        var name = $('#deletenama').val();

        $.ajax({
            method: "GET",
            url: "/table/delete/" + id,
            success: function (response) {
                // Hide the delete modasl and reload the table on success
                $('#deleteModal').modal('hide');
                $('#successModal').modal('show');
                $('#successMessage').text(response.status);
                reloadTable();

                // alert('Berhasil delete data : ' + name);
            }
        });
    });

    function reloadTable() {
        $('#myTable').DataTable().ajax.reload();
    }
</script>

</html>