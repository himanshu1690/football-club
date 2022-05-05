<?php

namespace App\Listeners;

use App\Models\Club;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClubRemovedListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $club = $event->club;

        //Delete club admins
        foreach ($club->clubAdmins as $admin){
            $admin->clearMediaCollection('users');
            $admin->delete();
        }

        //Delete Teams
        foreach ($club->teams as $team){
            $groups = $team->playerGroups;
            //Delete player groups
            foreach ($groups as $group){
                $players = $group->players;
                //Delete Players
                foreach ($players as $player){
                    $player->clearMediaCollection('players');
                    $player->delete();
                }
                $group->delete();
            }
            $team->delete();
        }

        $club->delete();
    }
}
