<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    {{-- amit add here  --}}


    {{-- amit add here  --}}
    <style>
        .error {
            color: red;
        }
    </style>
    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-5">
                <button type="button" name="create_record" id="create_record" class="btn btn-primary ">Add
                    New Employee</button>
            </div>
            <div class="col-lg-12">
                <div class="row mt-3">


                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                All Employee Task
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"
                                        id="dataTables-example1">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                        <!-- /.col-lg-12 -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div id="formModal" class="modal fade" role="dialog">
            <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Success Message after submit -->
                        <span id="form_result" aria-hidden="true"></span>
                        <!-- Error Message after form not submit -->
                        <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Task Title:</label>
                                <input type="text" class="form-control" name="task_title" id="task_title">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Task
                                    Descriptions:</label>
                                <textarea class="form-control" name="task_description" id="task_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Employe Name</label>
                                <input type="text" class="form-control" name="employee_name" id="employee_name">
                            </div>
                            <div class="form-group" id="hidestatus">
                                <label class="control-label">Task Status</label>
                                <select name="task_status" id="task_status" class="w-100 p-2">
                                    <option>-- Select Status --</option>
                                    <option id="pending" value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                    </div>
                    <!-- <br /> -->
                    <div class="form-group text-center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="email_hidden_id" id="email_hidden_id" />
                        <input type="submit" name="action_button" id="action_button"
                            class="btn btn-warning float-center" value="Add" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        {{-- <h1>this ismait</h1> --}}
    </div>
    </div>
    </div>


    </div>
    </div>




     <script>
        $(document).ready(function () {
            $('#sample_form').validate({
                rules: {
                    task_title: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    number: {
                        required: true,
                        digits: true

                    },
                },
                errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {



            $('#create_record').click(function() {
                $('#name_form').show();
                $('#sample_form')[0].reset();
                $('#form_result').html('');
                $('.modal-title').text("Add New Employee");
                $('#action_button').val("Add");
                $('#action').val("Add");
                $('#formModal').modal('show');
            });
            //
            fetchData();

            function fetchData() {
                $.ajax({
                    url: '{{ route('fetch_employees') }}',
                    type: 'GET',
                    success: function(response) {
                        // Populate the table with the fetched data
                        populateTable(response.data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('Error: ' + errorThrown);
                    }
                });
            }

            function populateTable(data) {

                $('tbody').empty();


                for (var i = 0; i < data.length; i++) {
                    var row = '<tr>' +
                        '<th scope="row">' + data[i].id + '</th>' +
                        '<td>' + data[i].task_title + '</td>' +
                        '<td>' + data[i].task_description + '</td>' +
                        '<td>' + data[i].employee_name + '</td>' +
                        '<td>' + data[i].task_status + '</td>' +
                        '<td>' +
                        '<button class="btn btn-sm btn-info edit-btn" data-id="' + data[i].id + '">Edit</button>' +
                        '<button class="btn btn-sm btn-danger delete-btn" data-id="' + data[i].id +
                        '">Delete</button>' +
                        '</td>' +
                        '</tr>';

                    $('tbody').append(row);
                }
            }


            $('tbody').on('click', '.edit-btn', function() {
                var employeeId = $(this).data('id');
                $('#sample_form').data('employee-id', employeeId);
                $.ajax({
                    url: '/employee/edit/' + employeeId,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        console.log(response.data.employee_name);
                        $('#task_title').val(response.data.task_title);
                        $('#task_description').val(response.data.task_description);
                        $('#employee_name').val(response.data.employee_name);
                        $('#task_status').val(response.data.task_status);
                        $('.modal-title').text("Edit Employee");
                        $('.modal-title_delete').text("Email Employee");
                        $('#action_button').val("Update");
                        $('#action').val("Update");
                        $('#formModal').modal('show');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('Error: ' + errorThrown);
                    }
                });
            });
            $('#sample_form').on('submit', function(event) {
                event.preventDefault();

                // data add working on submit button
                if ($('#action').val() == 'Add') {
                    console.log('add button click ho rha ha');
                    $.ajax({

                        url: "{{ route('store_employee') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        headers: {
                            "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                        },

                        success: function(data) {
                            console.log('Employee store ho gaya successfully');
                            var html = '';
                            if (data.success) {
                                html = '<div class="alert alert-success">' + data.message +
                                    '</div>';
                                $('#form_result').html(html);
                                setTimeout(function() {
                                    $('#formModal').modal('hide');
                                    location.reload();

                                }, 2000);
                            } else {
                                html = '<div class="alert alert-danger">' + data.message +
                                    '</div>';
                                $('#form_result').html(html);
                            }

                        },
                        // message alert close

                        error: function(data) {
                            console.log('Error:', data);
                            console.log('submit function kamm nahi kr rha hai');
                        }
                    })
                }

                // update button wotking for updata data
                if ($('#action').val() == "Update") {
                    console.log('update button pe click ho rha hai');
                    var employeeId = $('#sample_form').data('employee-id');
                    $.ajax({
                        url: '/employee/update/' + employeeId,
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        headers: {
                            "Authorization": "Bearer " + localStorage.getItem('a_u_a_b_t')
                        },

                        // message alert open
                        success: function(data) {
                            console.log('employee update ho gaya successfully');
                            //setting 2 second in modal to stay
                            location.reload();

                            // adding alert messages
                            console.log(data.errors);
                            var html = '';
                            if (data.error) {
                                html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.error.length; count++) {
                                    html += '<p>' + data.error[count] + '</p>';
                                }
                                html += '</div>';
                                $('#form_result').html(html);
                            }
                            if (data.message) {
                                html = '<div class="alert alert-success">' + data.message +
                                    '</div>';
                                $('#form_result').html(html);
                            }
                        },
                        // message alert close
                        error: function(data) {
                            console.log('Error:', data);
                            //    this function for hide with id #formModel
                            console.log('update function kamm nahi kr rha hai');
                        }
                    });
                }
            });



            //update me hai

            // Delete button click event
            $('tbody').on('click', '.delete-btn', function() {
                var Employee_id = $(this).data('id');
                // Make AJAX request for delete functionality
                $.ajax({
                    url: '/employee/delete/' + Employee_id,
                    method: 'GET',
                    success: function(response) {
                        // Implement your logic after successful deletion
                        console.log(response.message);
                        // Refresh the task list
                        location.reload();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('Error: ' + errorThrown);
                    }
                });
            });
            // this is for delete function
            // validation start here

            // validation start here
        });
    </script>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-example1').DataTable({
                responsive: true
            });
        });
    </script>
    <script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
