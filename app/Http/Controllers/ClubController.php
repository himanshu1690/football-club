<?php


namespace App\Http\Controllers;


use App\Events\ClubRemovedEvent;
use App\Http\Requests\ClubRequest;
use App\Models\Club;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index(){
        $this->authorize('view-any', Club::class);

        $clubs = Club::query();
        if(auth()->user()->isClubAdmin()){
            $clubs->where('id', auth()->user()->club_id);
        }
        $clubs = $clubs->get();

        return view('clubs.index', compact('clubs'));
    }

    public function create(){
        $this->authorize('create', Club::class);

        $clubAdmins = User::where('role_id', Role::ROLE_CLUB_ADMIN)->get();
        return view('clubs.create', compact('clubAdmins'));
    }

    public function store(ClubRequest $request){
        $this->authorize('create', Club::class);

        $data = $request->validated();
        $club = Club::create($data);

        $user_id = $request->club_admin ?? auth()->id();
        User::where('id', $user_id)->update([
            'club_id' => $club->id
        ]);

        return redirect()->route('clubs.index')->with(['success' => 'Club created successfully']);
    }

    public function edit(Request $request, Club $club){
        $this->authorize('update', [Club::class, $club]);

        $clubAdmins = User::where('role_id', Role::ROLE_CLUB_ADMIN)->get();
        return view('clubs.edit', compact('club', 'clubAdmins'));
    }

    public function update(ClubRequest $request, Club $club){
        $this->authorize('update', [Club::class, $club]);

        $data = $request->validated();
        $club->update($data);

        return redirect()->route('clubs.index')->with(['success' => 'Club updated successfully']);
    }

    public function destroy(Club $club){
        $this->authorize('delete', [Club::class, $club]);

        event(new ClubRemovedEvent($club));

        return redirect()->route('clubs.index')->with(['success' => 'Club deleted successfully']);
    }

    public function admins(Request $request, Club $club){

        $this->authorize('view', [Club::class, $club]);

        $admins = $club->clubAdmins;

        return view('clubs.admins', compact('club', 'admins'));
    }


    public function addAdmin(Request $request, Club $club){
        $this->authorize('create', [Club::class, $club]);

        $admins = User::where('role_id', Role::ROLE_CLUB_ADMIN)->where('club_id', 0)->get();

        return view('clubs.add-admin', compact('club', 'admins'));
    }

    public function saveAdmin(Request $request, Club $club){
        $this->authorize('create', [Club::class, $club]);

        User::where("id", $request->club_admin)->update([
            'club_id' => $club->id
        ]);

        return redirect()->route('clubs.admin', $club->id)->with(['success' => 'Club Admin added successfully']);
    }

    /**
     * Remove Club admin from the Club
     * @param Request $request
     * @param Club $club
     * @param User $admin
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteAdmin(Request $request, Club $club, User $admin){
        $this->authorize('delete', [Club::class, $club]);

        $admin->update(['club_id'=> 0]);

        return redirect()->route('clubs.admin', $club->id)->with(['success' => 'Club Admin removed successfully']);
    }
}
