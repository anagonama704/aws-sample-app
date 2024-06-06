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
        'name',
        'birth_date',
        'zip_code',
        'address',
        'tel',
        'email',
        'password',
        'is_admin'
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
    ];

    //お気に入り登録の判断
    public function isLike($book_id)
    {
        return $this->likeBooks()->where('books.id',$book_id)->exists();
    }

    public function likeBooks()
    {
        return $this->belongsToMany(Book::class, 'likes');
    }

    public function cart()
    {
        return $this->belongsToMany(Book::class, 'carts');
    }
    public function isInCart($book_id)
    {
        return $this->cart()->where('books.id',$book_id)->exists();
    }

    public function isAdmin()
    {
        return (bool)$this->is_admin;
    }
}
