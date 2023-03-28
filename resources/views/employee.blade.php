@extends('layout.base')


@section('content')
    <div class="modal fade" id="add_company_modal" tabindex="-1" aria-labelledby="add_company_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_company_modal_label">Add Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/company/{{ $companyData->id }}" method="POST">
                    @csrf
                    <div class="modal-body add-company-modal">
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="first_name">First Name*</label>
                                <input type="text" id="first_name" required name="first_name" class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="last_name">Last Name*</label>
                                <input type="text" id="last_name" required name="last_name" class="form-control">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="email">Email*</label>
                                <input type="email" id="email" required name="email" class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="phone_number">Phone Number*</label>
                                <input type="text" id="phone_number" required name="phone_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 20px">
        <div class="d-flex justify-content-between">
            <h1 style="margin: 20px 0px">Employees of {{ $companyData->name }}</h1>
            <div style="margin: 20px 0px">
                <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#add_company_modal" style="height: 100%">Add New</button>
            </div>
        </div>
        <div class="container" style="margin-top: 20px">
            <div class="row row-cols-3">
                @foreach ($employees as $employee)
                    <div class="modal fade" id="add_employee_modal_{{ $employee->id }}" tabindex="-1"
                        aria-labelledby="add_company_modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="add_employee_modal_{{ $employee->id }}_label">Add
                                        Employee</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/company/employee/edit/{{ $employee->id }}" method="POST">
                                    @csrf
                                    <div class="modal-body add-company-modal">
                                        <div class="row g-2">
                                            <div class="col-md">
                                                <label for="first_name">First Name*</label>
                                                <input type="text" id="first_name" value="{{ $employee->first_name }}"
                                                    required name="first_name" class="form-control">
                                            </div>
                                            <div class="col-md">
                                                <label for="last_name">Last Name*</label>
                                                <input type="text" id="last_name" value="{{ $employee->last_name }}"
                                                    required name="last_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md">
                                                <label for="email">Email*</label>
                                                <input type="email" id="email" value="{{ $employee->email }}"
                                                    required name="email" class="form-control">
                                            </div>
                                            <div class="col-md">
                                                <label for="phone_number">Phone Number*</label>
                                                <input type="text" id="phone_number" value="{{ $employee->phone }} "
                                                    required name="phone_number" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Email - {{ $employee->email }}</li>
                                    <li class="list-group-item">Phone - {{ $employee->phone }}</li>
                                    <li class="list-group-item">Company Name - {{ $employee->company_name }}</li>
                                </ul>
                                <div style="margin-top: 10px">
                                    <button type="button" style="color: green" class="btn btn-link card-link"
                                        data-bs-toggle="modal"
                                        data-bs-target="#add_employee_modal_{{ $employee->id }}">Edit</button>
                                    <button onclick="deleteEmployee('{{ $employee->id }}')" type="button"
                                        style="color: red" class="btn btn-link card-link">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteEmployee(id) {
            fetch(`/company/employee/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    "X-CSRF-Token": "{{ csrf_token() }}"
                }
            }).then((res) => {
                if (res.ok) {
                    window.location.reload();
                }
            })
        }
    </script>
@endsection
