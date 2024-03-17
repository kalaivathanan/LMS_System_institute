<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user = auth()->user();
        $pic = $user->profile_pic;

        // if ($request->ajax()) {

        //     $events = events::whereDate('start', '>=', $request->start)
        //         ->whereDate('end', '<=', $request->end)
        //         ->get();

        //     return response()->json($events);
        // }
        return view('events')->with('pic', $pic);
    }
    public function load(Request $request)
    {


        $events = events::whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();
        return response()->json($events);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request->all();
        $input = $request->only([
            'title', 'start',  'type',  'ends', 'color', 'user',
        ]);

        $request->validate([
            'title' => 'required',
            'start' => 'required|date',
            'ends' => 'required|date|after:start',
            'type' => 'required',
            'color' => 'required',
            'user' => 'required'
        ]);



        $event = events::create([
            'title' => $input['title'],
            'start' => $input['start'],
            'end' => $input['ends'],
            'type' => $input['type'],
            // 'allday' => $input['allday'],
            'uid' => auth()->user()->id,
            'color' => $input['color'],
        ]);

        return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $input = $request->only(['id', 'title', 'start', 'end']);

        $request_data = [
            'id' => 'required',
            'start' => 'required',
            'end' => 'required'
        ];

        $validator = Validator::make($input, $request_data);

        // invalid request
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, please check all parameters',
            ]);
        }

        $event = events::where('id', $input['id'])
            ->update([
                'start' => $request['start'],
                'end' => $request['end'],
            ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, events $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        events::where('id', $request->id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event removed successfully.'
        ]);
    }
}
