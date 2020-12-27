<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'gender',
        'phone_number',
        'department',
        'joining_date',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * The attributes that should be set password to encrypted.
     *
     * @var array
     */
    public function setPasswordAttribute($password)
    {
        if(isset($password)){
            $this->attributes['password'] = Hash::make($password);
        }
        return null;
    }

    /**
     * This function is used for getting table name
     *
     * @return void
     */
    public function getTableName()
    {
        return $this->getTable();
    }

    /*
     * Auto-sets values on creation
     */
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($query) {
            if (Schema::hasColumn($query->getTableName(), 'uuid')) {
                $query->uuid = (string) Str::uuid();
            }
        });
    }

    /*
     * sets joinng date on formate ddmmYYYY
     */
    public function getJoiningDateTextAttribute(){
        if ($this->attributes['joining_date'] != null) {
            $value = $this->attributes['joining_date'];
            return '<span class="hid_spn">' . date('Ymd', strtotime($value)) . '</span>' . date('d-m-Y', strtotime($value));
        } else {
            return null;
        }
    }

    /*
     * sets joinng date on formate ddmmYYYY
     */
    public function getJoiningDateText2Attribute(){
        if ($this->attributes['joining_date'] != null) {
            $value = $this->attributes['joining_date'];
            return date('m/d/Y', strtotime($value));
        } else {
            return null;
        }
    }

    /*
     * sets gender text
     */
    public function getGenderTextAttribute(){
        return (isset($this->gender) && $this->gender ==1)?'Male':'Female';
    }

}
