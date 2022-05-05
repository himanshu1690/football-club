<?php


namespace App\Http\Controllers;


use App\Http\Requests\PlayerRequest;
use App\Models\Club;
use App\Models\Player;
use App\Models\PlayerGroup;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index(PlayerGroup $group){
        $this->authorize('view-any', [Player::class, $group]);

        $players = $group->players;

        return view('players.index', compact('group', 'players'));
    }

    public function create(PlayerGroup $group){
        $this->authorize('create', [Player::class, $group]);

        return view('players.create', compact('group'));
    }

    public function store(PlayerRequest $request, PlayerGroup $group){
        $this->authorize('create', [Player::class, $group]);

        $data = $request->validated();
        $data['player_group_id'] = $group->id;
        $player = Player::create($data);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $player->addMediaFromRequest('photo')->toMediaCollection('players');
        }
        return redirect()->route('players.index', $group->id)->with(['success' => 'Player created successfully']);
    }

    public function edit(Request $request, Player $player){
        $this->authorize('update', [Player::class, $player]);

        return view('players.edit', compact('player'));
    }

    public function update(PlayerRequest $request, Player $player){
        $this->authorize('update', [Player::class, $player]);

        $data = $request->validated();
        $player->update($data);
        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $player->clearMediaCollection('players');
            $player->addMediaFromRequest('photo')->toMediaCollection('players');
        }
        return redirect()->route('players.index', $player->playerGroup->id)->with(['success' => 'Player updated successfully']);
    }

    public function destroy(Player $player){
        $this->authorize('delete', [Player::class, $player]);

        $player->clearMediaCollection('players');
        $player->delete();
        return redirect()->route('players.index', $player->playerGroup->id)->with(['success' => 'Player deleted successfully']);
    }
}
