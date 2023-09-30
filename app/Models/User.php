<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasMergedRelationships,HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Alex adds mable Alex is user and mable is friend
   function hasPendingFriendRequestFor(User $user) {

      return $this->pendingFriendsTo->contains($user);

    }

    function isFriendsWith(User $user) {
        return $this->friends->contains($user);
    }
    function friendsTo() {
        //                                       table      user      friend
        return $this->belongsToMany(User::class,'friends','user_id','friends_id')->withPivot('accepted')->withTimestamps();
    }
    function friendsFrom() {

        return $this->belongsToMany(User::class,'friends','friends_id','user_id')->withPivot('accepted')->withTimestamps();
    }
    function pendingFriendsTo() {
        return $this->friendsTo()->wherePivot('accepted',false);
    }
    function pendingFriendsFrom() {
        return $this->friendsFrom()->wherePivot('accepted',false);
    }


    function acceptedFriendsTo() {
        return $this->friendsTo()->wherePivot('accepted',true);
    }
    function acceptedFriendsFrom() {
        return $this->friendsFrom()->wherePivot('accepted',true);
    }
    function friends() {
        return $this->mergedRelationWithModel(User::class,'friends_view');
    }
    function statuses() {
        return $this->hasMany(Status::class);
    }
    function friendStatuses() {

       return $this->hasManyDeepFromRelations($this->friends(),(new User())->statuses())->latest();
    }
}
