<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $auth, $ability){
        if($auth->isAdmin()){
            return true;
        }
    }

    public function edit(User  $auth, User $user){
        //Si el usuario no es el mismo que esta autenticado no podra editar otros usuarios
        return $auth->id == $user->id;
    }

    public function update(User  $auth, User $user){
        return $auth->id == $user->id;
    }
    
}
