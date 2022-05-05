<?php


namespace App\Http\Controllers;


use App\Http\Requests\PlayerGroupRequest;
use App\Models\Club;
use App\Models\PlayerGroup;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerGroupController extends Controller
{
    public function index(Team $team){
        $this->authorize('view-any', [PlayerGroup::class, $team]);

        return view('player-groups.index', compact('team'));
    }

    public function create(Team $team){
        $this->authorize('create', PlayerGroup::class);

        return view('player-groups.create', compact('team'));
    }

    public function store(PlayerGroupRequest $request, Team $team){
        $this->authorize('create', PlayerGroup::class);

        $data = $request->validated();
        $data['team_id'] = $team->id;
        $playerGroup = PlayerGroup::create($data);

        return redirect()->route('player.group.index', ['team' => $team->id])->with(['success' => 'Player Group created successfully']);
    }

    public function edit(Request $request, PlayerGroup $playerGroup){
        $this->authorize('update', [PlayerGroup::class, $playerGroup]);

        return view('player-groups.edit', compact('playerGroup'));
    }

    public function update(PlayerGroupRequest $request, PlayerGroup $playerGroup){
        $this->authorize('update', [PlayerGroup::class, $playerGroup]);

        $data = $request->validated();
        $playerGroup->update($data);

        return redirect()->route('player.group.index', $playerGroup->team->id)->with(['success' => 'Player Group updated successfully']);
    }

    public function destroy(PlayerGroup $playerGroup){
        $this->authorize('delete', [PlayerGroup::class, $playerGroup]);

        $playerGroup->delete();
        return redirect()->route('player.group.index', $playerGroup->team->id)->with(['success' => 'Player Group deleted successfully']);
    }
}
