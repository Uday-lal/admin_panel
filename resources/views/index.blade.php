@extends('layout.base')

@section('styles')
    <style>
        .company-card {
            margin-top: 20px;
        }

        .add-company-modal>* {
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="modal fade" id="add_company_modal" tabindex="-1" aria-labelledby="add_company_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_company_modal_label">Add Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body add-company-modal">
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="name">Company Name*</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="email">Company Email*</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md">
                                <label for="logo">Company logo</label>
                                <input type="file" id="logo" name="logo" accept="image/*" class="form-control">
                            </div>
                            <div class="col-md">
                                <label for="website">Company Website*</label>
                                <input type="text" id="website" placeholder="https://www.example.com" name="website"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col md">
                                <label for="discription">Discription</label>
                                <textarea name="discription" class="form-control" id="discription" cols="10" rows="4"></textarea>
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
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1 style="margin: 20px 0px">Companies</h1>
            <div style="margin: 20px 0px">
                <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#add_company_modal" style="height: 100%">Add New</button>
            </div>
        </div>
        <div class="container" style="margin-top: 20px">
            <div class="row row-cols-3">
                @foreach ($companies as $company)
                    <div class="modal fade" id="add_company_modal_{{ $company->id }}" tabindex="-1"
                        aria-labelledby="add_company_modal_{{ $company->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="add_company_modal_{{ $company->id }}_label">Add
                                        Company</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="/company/edit/{{ $company->id }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body add-company-modal">
                                        <div class="row g-2">
                                            <div class="col-md">
                                                <label for="name">Company Name*</label>
                                                <input type="text" id="name" value="{{ $company->name }}"
                                                    name="name" class="form-control">
                                            </div>
                                            <div class="col-md">
                                                <label for="email">Company Email*</label>
                                                <input type="email" id="email" value="{{ $company->email }}"
                                                    name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md">
                                                <label for="logo">Company logo</label>
                                                <input type="file" id="logo" name="logo" accept="image/*"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md">
                                                <label for="website">Company Website*</label>
                                                <input type="text" id="website"
                                                    placeholder="https://www.example.com" value="{{ $company->website }}"
                                                    name="website" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row g-1">
                                            <div class="col md">
                                                <label for="discription">Discription</label>
                                                <textarea name="discription" class="form-control" id="discription" cols="10" rows="4">{{ $company->discription }}</textarea>
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
                        <div class="card company-card" style="width: 18rem;">
                            <img src="/storage/{{ $company->logo }}" class="card-img-top" alt="company_logo">
                            <div class="card-body">
                                <h5 class="card-title">{{ $company->name }}</h5>
                                <p class="card-text">{{ $company->discription }}</p>
                                <div class="btn-group" role="group" aria-label="Button Group">
                                    <a href="/company/{{ $company->id }}" type="button"
                                        class="btn btn-sm btn-primary">View Profile</a>
                                    <button type="button" data-bs-toggle="modal"
                                        data-bs-target="#add_company_modal_{{ $company->id }}"
                                        class="btn btn-sm btn-success">Edit</button>
                                    <button type="button" onclick="deleteCompany('{{ $company->id }}')"
                                        class="btn btn-sm btn-danger">Delete</button>
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
        function deleteCompany(id) {
            fetch(`/company/delete/${id}`, {
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
