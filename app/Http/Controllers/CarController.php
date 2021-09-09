<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        /* query with no authentication
        //query all car from 'cars' table to $cars
        //select * from cars - SQL Query
        $cars = Car::all();

        //return to view with $schedules
        return view('cars.index', compact('cars'));
        */

        if($request->keyword){
            //search by title
            $user = auth()->user();
            $cars = $user->cars()
                ->where('plate_no','LIKE', '%'.$request->keyword.'%')
                ->paginate(2);

        }else{
            //query all schedule from 'schedules' table to $schedules
            //select * from schedules - SQL Query
            //$schedules = Schedule::all();
            $user = auth()->user();
            $cars = $user->cars()->paginate(2);
        }
        //return to view with $schedules
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        //this is schedules create form
        //show create form
        //resources/views/schedules/create.blade.php
        return view('cars.create');
    }

    public function store(Request $request)
    {
        //store all input
        $car = new Car();
        $car->model = $request->model;
        $car->plate_no = $request->plate_no;
        $car->user_id = auth()->user()->id;
        $car->save();

        //return to index
        return redirect()->route('car:index');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Car $car, Request $request)
    {
        //update $schedule using input from edit form

        $car->model = $request->model;
        $car->plate_no = $request->plate_no;
        $car->save();

        //redirect to schedule index
        return redirect()->route('car:index');
    }

    public function destroy(Car $car)
    {
        // delete $schedule from db
        $car->delete();

        // return to schedule index
        return redirect()->route('car:index');
    }
}
