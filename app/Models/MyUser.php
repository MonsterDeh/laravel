<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    use HasFactory;
     // protected $guarded=[''];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'car_type',
        'national_code',
        'plaque',
        'email'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    // protected function name(): Attribute
    // {   
    //     // dd($this);
    //     return Attribute::make(
    //         set: fn ($value,$attributes) => $value.''.$attributes['family_name'],
    //     );
    // }
    public function turns()
    {
        $this->hasMany(Turn::class);
    }
}
