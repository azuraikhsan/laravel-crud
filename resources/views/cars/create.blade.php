@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car Create') }}</div>

                <div class="card-body">
                    <form action="{{ route('car:store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Plate No.</label>
                            <input type="text" name="plate_no" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create New Car</button>
                            <a class="btn btn-link" href="{{ route('car:index') }}">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

