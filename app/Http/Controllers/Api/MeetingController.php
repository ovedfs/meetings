<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Meeting;
//use App\Enums\MeetingEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMeetingRequest;

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
    public function store(StoreMeetingRequest $request)
    {
        $parts = [
            'abogado' => $request->abogado_id,
            'arrendador' => $request->arrendador_id,
            'arrendatario' => $request->arrendatario_id,
            'solidario' => $request->has('solidario_id') ?? null,
            'fiador' => $request->has('fiador_id') ?? null,
        ];

        foreach ($parts as $key => $value) {
            $user = User::find($value);

            if($value && !isset($user)) {
                return response()->json([
                    'message' => "El usuario propuesto como $key no esta registrado en el sistema",
                ]);
            }

            if($value && ! $user->hasRole($key)) {
                return response()->json([
                    'message' => "El usuario propuesto como $key no tiene el rol necesario",
                ]);
            }
        }

        DB::beginTransaction();

        try {
            $meeting = Meeting::create([
                "place" => $request->place,
                "date" => $request->date,
                "time" => $request->time,
                "status_id" => 1, //MeetingEnum::Programada,
                "abogado_id" => $request->abogado_id,
                "admin_abogado_id" => auth()->user()->id
            ]);
            
            $meeting->parts()->create(['part_id' => $request->arrendador_id, 'role' => 'arrendador']);
            $meeting->parts()->create(['part_id' => $request->arrendatario_id, 'role' => 'arrendatario']);
            if($request->has('solidario_id')) $meeting->parts(['part_id' => $request->solidario_id, 'role' => 'solidario']);
            if($request->has('fiador_id')) $meeting->parts(['part_id' => $request->fiador_id, 'role' => 'fiador']);

            DB::commit();

            return response()->json([
                'message' => 'Reunión programada correctamente',
                'meeting' => $meeting->load('parts', 'status', 'abogado'),
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Ocurrió un error y no se pudo registrar la reunión',
                'error' => $e
            ]);
        }
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
