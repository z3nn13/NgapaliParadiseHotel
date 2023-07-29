<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable. 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_no',
    ];

    /**
     * The attributes that should be hidden for serialization..
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

    public function scopeSearchBy($query, $searchQuery)
    {
        $nameParts = explode(' ', $searchQuery);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        if ($this->hasLeadingZeros($searchQuery)) {
            $trimmedQuery = ltrim($searchQuery, '0');

            if ($trimmedQuery === "") {
                return $query;
            }

            return $query->where('id', 'LIKE', '%' . $trimmedQuery  . '%');
        }

        if (count($nameParts) === 2) {
            return $query->where(function ($query) use ($firstName, $lastName) {
                $query->where('first_name', 'LIKE', "%$firstName%")
                    ->where('last_name', 'LIKE', "%$lastName%");
            });
        }

        return $query->where(function ($query) use ($searchQuery) {
            $query->where('first_name', 'LIKE', "%$searchQuery%")
                ->orWhere('last_name', 'LIKE', "%$searchQuery%")
                ->orWhere('id', 'LIKE', "%$searchQuery%")
                ->orWhere('email', 'LIKE', "%$searchQuery%")
                ->orWhere('phone_no', 'LIKE', "%$searchQuery%");
        });
    }


    // Use a regular expression to check for leading zeros
    function hasLeadingZeros($string)
    {
        return preg_match('/^0{1,3}/', $string) === 1;
    }

    // The role the user belongs to
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
