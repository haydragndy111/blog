<?php

namespace App\Policies;

use App\Models\User;
use App\Traits\ModelHelpers;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPolicy
{
    use HasFactory;
    use HandlesAuthorization;
    use ModelHelpers;

    const SUPERADMIN = 'superAdmin';
    const ADMIN = 'admin';
    const BAN = 'ban';
    const DELETE = 'delete';

    public function superAdmin(User $user): bool {
        return $user->isAdmin();
    }

    public function adminRoute(User $user): bool {
        return $user->isAdmin() || $user->isModerator() || $user->isSuperAdmin();
    }

    public function admin(User $user): bool {
        return $user->isAdmin() || $user->isModerator();
    }

    // subject is the user getting banned
    public function ban(User $user, User $subject): bool {
        return ($user->isAdmin() && !$subject->isAdmin()) ||
                ($user->isModerator() && !$subject->isAdmin() && !$subject->isModerator());
    }

    public function delete(User $user, User $subject): bool {
        return ($user->isModerator() || $user->matches($subject) && !$subject->isAdmin());
    }

}
