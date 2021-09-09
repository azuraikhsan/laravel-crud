<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use File;
use Storage;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        if($request->keyword){
            //search by title
            $user = auth()->user();
            $schedules = $user->schedules()
                ->where('title','LIKE', '%'.$request->keyword.'%')
                //->orWhere('description','LIKE', '%'.$request->keyword.'%') //condition either one from both column
                ->where('description','LIKE', '%'.$request->keyword.'%') //condition from both column
                ->paginate(2);

        }else{
            //query all schedule from 'schedules' table to $schedules
            //select * from schedules - SQL Query
            //$schedules = Schedule::all();
            $user = auth()->user();
            $schedules = $user->schedules()->paginate(2);
        }


        //return to view with $schedules
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        //this is schedules create form
        //show create form
        //resources/views/schedules/create.blade.php
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        //store all input
        $schedule = new Schedule();
        $schedule->title = $request->title;
        $schedule->description = $request->desc;
        $schedule->user_id = auth()->user()->id;
        $schedule->save();

        if($request->hasFile('attachment')){
            //rename file
            $filename = $schedule->id.'-'.date("Y-m-d").'.'.$request->attachment->getClientOriginalExtension();

            //store attachment
            Storage::disk('public')->put($filename, File::get($request->attachment));

            //update row
            $schedule->attachment = $filename;
            $schedule->save();

        }

        //return to index
        return redirect()
            ->route('schedule:index')
            ->with([
                'alert-type' => 'alert-primary',
                'alert' => 'Jadual telah berjaya disimpan!'
            ]);
    }

    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Schedule $schedule, Request $request)
    {
        //update $schedule using input from edit form

        $schedule->title = $request->title;
        $schedule->description = $request->desc;
        $schedule->save();

        //redirect to schedule index
        return redirect()
            ->route('schedule:index')
            ->with([
                'alert-type' => 'alert-success',
                'alert' => 'Jadual telah berjaya disimpan!'
            ]);
    }

    public function destroy(Schedule $schedule)
    {
        // delete $schedule from db
        $schedule->delete();

        // return to schedule index
        return redirect()
            ->route('schedule:index')
            ->with([
                'alert-type' => 'alert-danger',
                'alert' => 'Jadual telah berjaya dihapuskan!'
            ]);
    }

    public function forceDestroy(Schedule $schedule)
    {
        // delete $schedule from db
        $schedule->forceDelete();

        // return to schedule index
        return redirect()
            ->route('schedule:index')
            ->with([
                'alert-type' => 'alert-danger',
                'alert' => 'Jadual telah berjaya dihapuskan dari bumi nyata!'
            ]);
    }
}
