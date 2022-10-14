<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Meeting;
use App\Enums\MeetingEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:meetings.index')->only('index');
        $this->middleware('can:meetings.store')->only('store');
        $this->middleware('can:meetings.show')->only('show');
        $this->middleware('can:meetings.update')->only('update');
        $this->middleware('can:meetings.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = Meeting::all();

        return response()->json([
            'message' => 'Listado de meetings',
            'meetings' => $meetings,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'place' => 'required',
            // 'date' => 'required| after:' . date('Y-m-d'),
            'date' => 'required|after:yesterday',
            'time' => 'required|date_format:H:i',
            'abogado_id' => 'required|integer',
            'arrendador_id' => 'required|integer',
            'arrendatario_id' => 'required|integer',
            'solidario_id' => 'sometimes|integer',
            'fiador_id' => 'sometimes|integer',
        ]);

        //DB::transaction(function () use($request) {
            $parts = [
                'abogado' => $request->abogado_id,
                'arrendador' => $request->arrendador_id,
                'arrendatario' => $request->arrendatario_id,
                'solidario' => $request->has('solidario_id') ?? null,
                'fiador' => $request->has('fiador_id') ?? null,
            ];

            foreach ($parts as $key => $value) {
                if($value && ! User::find($value)->hasRole($key)) {
                    return response()->json([
                        'message' => "El usuario propuesto como $key no tiene el rol necesario",
                    ]);
                }
            }

            $meeting = Meeting::create([
                "place" => $request->place,
                "date" => $request->date,
                "time" => $request->time,
                "status_id" => MeetingEnum::Programada,
                "abogado_id" => $request->abogado_id,
                "admin_abogado_id" => auth()->user()->id
            ]);
            
            $meeting->parts()->create(['part_id' => $request->arrendador_id, 'role' => 'arrendador']);
            $meeting->parts()->create(['part_id' => $request->arrendatario_id, 'role' => 'arrendatario']);
            if($request->has('solidario_id')) $meeting->parts(['part_id' => $request->solidario_id, 'role' => 'solidario']);
            if($request->has('fiador_id')) $meeting->parts(['part_id' => $request->fiador_id, 'role' => 'fiador']);

            return response()->json([
                'message' => 'Reunión programada correctamente',
                'meeting' => $meeting->load('parts'),
            ]);
        //});
    }

    /**
     * Display the specified resource.
     *
     * @param  Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        return response()->json([
            'message' => 'Meeting con toda su información',
            'meetings' => $meeting->load('parts', 'meetingChanges', 'status', 'abogado'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
