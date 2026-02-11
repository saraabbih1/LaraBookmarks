<?php

namespace App\Policies;

use App\Models\Link;
use App\Models\User;

class LinkPolicy
{
    
    public function viewAny(User $user): bool
    {
        return true;
    }

  
    public function view(User $user, Link $link): bool
    {
       
        if ($link->user_id === $user->id) {
            return true;
        }

        return $link->users()
            ->where('user_id', $user->id)
            ->exists();
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('editor');
    }

    public function update(User $user, Link $link): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

       
        if ($link->user_id === $user->id) {
            return true;
        }

      
        return $link->users()
            ->where('user_id', $user->id)
            ->wherePivot('permission', 'edit')
            ->exists();
    }

    public function delete(User $user, Link $link): bool
    {
        return $this->update($user, $link);
    }

   
    
    public function share(User $user, Link $link): bool
    {
        return $user->hasRole('admin') || $link->user_id === $user->id;
    }
}
