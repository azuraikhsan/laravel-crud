@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cars Index') }}
                    <div class="float-right">
                        <form action="" method="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" value="{{ request()->get('keyword')}}" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Carian</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>ID</th>
                        <th>Model</th>
                        <th>Plate No</th>
                        <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                            <tr>
                                <td>{{$car->id}}</td>
                                <td>{{$car->model}}</td>
                                <td>{{$car->plate_no}}</td>
                                <td>
                                    <a href="{{ route('car:show', $car) }}" class="btn btn-primary">Show</a>
                                    <a href="{{ route('car:edit', $car) }}" class="btn btn-success">Update</a>
                                    <a onclick="return confirm('You sure to delete this row data?')" href="{{ route('car:destroy', $car) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
