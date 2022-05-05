<?php

namespace App\Policies;

use App\Models\PlayerGroup;
use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Team $team)
    {
       if($user->isClubAdmin())
            return $user->club_id == $team->club_id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PlayerGroup $playerGroup)
    {
        if($user->isClubAdmin()){
            return $playerGroup->team->club_id == $user->club_id;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isClubAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PlayerGroup $playerGroup)
    {
        if($user->isClubAdmin()){
            return $playerGroup->team->club_id == $user->club_id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PlayerGroup  $playerGroup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PlayerGroup $playerGroup)
    {
        /*if($user->isClubAdmin()){
            return $playerGroup->team->club_id == $user->club_id;
        }*/
    }
}
