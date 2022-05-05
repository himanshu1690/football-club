<?php


namespace App\Http\Controllers;


use App\Http\Requests\TeamRequest;
use App\Models\Club;
use App\Models\Team;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(){
        $this->authorize('view-any', Team::class);

        $teams = Team::query();
        if(auth()->user()->isClubAdmin()){
            $teams->where('club_id', auth()->user()->club_id);
        }
        $teams = $teams->get();
        return view('teams.index', compact('teams'));
    }

    public function clubTeams(Request $request, Club $club){
        $this->authorize('view-any', Team::class);

        $teams = $club->teams;
        return view('teams.index', compact('teams'));
    }

    public function create(){
        $this->authorize('create', Team::class);

        $clubs = Club::query();
        if(auth()->user()->isClubAdmin()){
            $clubs->where('id', auth()->user()->club_id);
        }
        $clubs = $clubs->get();

        return view('teams.create', compact('clubs'));
    }

    public function store(TeamRequest $request){
        $this->authorize('create', Team::class);

        $data = $request->validated();
        $team = Team::create($data);

        return redirect()->route('teams.index')->with(['success' => 'Team created successfully']);
    }

    public function edit(Request $request, Team $team){
        $this->authorize('update', [Team::class, $team]);

        return view('teams.edit', compact('team'));
    }

    public function update(TeamRequest $request, Team $team){
        $this->authorize('update', [Team::class, $team]);

        $data = $request->validated();
        $team->update($data);

        return redirect()->route('teams.index')->with(['success' => 'Team updated successfully']);
    }

    public function destroy(Team $team){
        $this->authorize('delete', [Team::class, $team]);

        $team->delete();
        return redirect()->route('teams.index')->with(['success' => 'Team deleted successfully']);
    }
}
