<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSportRequest;
use App\Http\Requests\UpdateSportRequest;
use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sport::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSportRequest $request)
    {
        $newSport =new Sport;
        $newSport->name = $request->name;

        try {
            $newSport->save();
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()]);
        }

        return response($newSport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSportRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSportRequest $request, $id)
    {
        $sport = Sport::find($id);

        if ($sport) {
            try {
                $sport->name = $request->name;
                $sport->save();

                return response($sport);
            } catch (\Exception $e) {
                return response(['error' => $e->getMessage()]);
            }
        }

        return response(['error' => "Sport doesn't exist"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sport = Sport::find($id);

        if ($sport) {
            try {
                $sport->delete();

                return response('Deleted');
            } catch (\Exception $e) {
                return response(['error' => $e->getMessage()]);
            }
        }

        return response(['error' => "Sport doesn't exist"]);
    }
}
