@extends('layout.base')

@section('styles')
    <style>
        div.row {
            margin: 10px 0px;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl" style="margin-top: 20px">
        <div class="container-lg">
            <div class="card">
                <form action="/login" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row g-1">
                            <label for="email">Email</label>
                            <div class="col-md">
                                <input type="email" name="email" required id="email" class="form-control">
                            </div>
                        </div>
                        <div class="row g-1">
                            <label for="password">Password</label>
                            <div class="col-md">
                                <input type="password" id="password" name="password" required class="form-control">
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-md"></div>
                            <div class="col-md" style="display: flex; justify-content: flex-end">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
