@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Employee List</h2>
                        <a class="btn btn-success" href="{{ route('employees.create') }}">Create New +</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('includes.alerts')
                    <table class="table table-bordered" id="employee">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                    </table>
   				</div>
            </div>
        </div>
    </div>
</div>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
        $(document).ready(function () {
            $('#employee').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('/employees_get') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'fname' },
                    { data: 'lname' },
                    { data: 'company_name' },
                    { data: 'email' },
                    { data: 'phone' },
                    { data: 'action',  orderable: false, searchable: false }
                ]
            });

            $('#employee').on('click', '.delete-button', function () {
                var id = $(this).data('id');
                deleteEmployee(id);
            });


            function deleteEmployee(id) {
                if (confirm('Are you sure you want to delete this employee?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/employees/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            $('#employee').DataTable().ajax.reload();
                        },
                        error: function (error) {
                            console.log(error);
                            alert('An error occurred while deleting.');
                        }
                    });
                }
            }
        });
    </script>



@endsection