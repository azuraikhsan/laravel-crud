@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car Show') }}</div>

                <div class="card-body">
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control" value="{{ $car->model }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Plate No.</label>
                            <input type="text" name="plate_no" class="form-control" value="{{ $car->plate_no }}" readonly>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

