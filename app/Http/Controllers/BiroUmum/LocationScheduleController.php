<?php

namespace App\Http\Controllers\BiroUmum;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationScheduleController extends Controller
{
    /**
     * Get list of schedule per location.
     * 
     */
    public function index(Request $request)
    {
        $query = DB::table('events as a')
            ->join('events as b', 'a.location_id', '=', DB::raw('b.location_id'))
            ->join('organizations as o', 'a.organization_id', '=', 'o.id')
            ->join('users as u', 'o.user_id', '=', 'u.id')
            ->leftJoin('faculties as f', 'o.faculty_id', '=', 'f.id')
            ->where('a.start', '<=', DB::raw('b.end'))
            ->where('a.end', '>=', DB::raw('b.start'))
            ->where('a.id', '!=', DB::raw('b.id'))
            ->where('a.type', '<>', 'online')
            ->where('b.type', '<>', 'online')
            ->orderBy('a.start', 'desc')
            ->select('a.id', 'a.name', 'b.name as clash_name', 'a.location', 'a.location_id', 'a.start', 'a.end', 'b.start as clash_start', 'b.end as clash_end', 'o.name as organization_name', DB::raw('COALESCE(f.name, "Universitas") as tingkat'), 'u.email as email');

        if (!is_null($request->query('name'))) {
            $query->where('a.name', 'like', '%' . $request->query('name') . '%');
        }

        if (!is_null($request->query('from'))) {
            $query->where('a.start', '>=', Carbon::parse($request->query('from')));
        }

        if (!is_null($request->query('to'))) {
            $query->where('a.end', '<=', Carbon::parse($request->query('to')));
        }

        $result = $query->paginate(5)->appends(request()->query());;

        // dd($data);
        return view('biroumum.pages.schedule_clashes.index', [
            'events' => $result
        ]);
    }
}
