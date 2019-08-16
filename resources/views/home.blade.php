@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Welcome System Administrator</h2>
                    <p>This application lets you build a customized survey which you can use to send to people and record their responses. The responses can be viewed and downloaded into an Excel spreadsheet.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
