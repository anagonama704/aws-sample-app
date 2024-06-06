<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rental;
use App\Models\Like;

class Book extends Model
{
    use HasFactory;
    protected $fillable=['category_id','name', 'description', 'author','publisher', 'image'];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function rental(){
        return $this->hasMany(Rental::class);
    }

    //貸出可否判断
    static public function isRentable($book_id){
        $flag = true;
        $rental = Rental::where('book_id',$book_id)->orderBy('CREATED_AT','desc');
        if ($rental->exists()) {
            if (isset($rental->first()->return_date)) {
                $flag = true;
            }else{
                $flag = false;
            }
        }
        return $flag;
    }

    //人気順で並び替えのため
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function is_rental(){
        $rental = $this->hasMany(Rental::class);
        $count = $rental->whereNull('return_date');
        return !$count;
    }
}
