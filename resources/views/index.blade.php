@extends('layout.base')

@section('content')
    <div class="modal fade" id="add_company_modal" tabindex="-1" aria-labelledby="add_company_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_company_modal_label">Add Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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
        <div class="container">

        </div>
    </div>
@endsection
