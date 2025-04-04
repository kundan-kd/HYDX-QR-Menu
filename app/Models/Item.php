<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function category(){
        return $this->hasOne('App\Models\Category','id','categoryid');
    }
    public function subcategory(){
        return $this->hasOne('App\Models\SubCategory','id','subcategoryid');
    }
    public function foodcategory(){
        return $this->hasOne('App\Models\FoodCategory','id','f_category');
    }
    public function top_picks(){
        return $this->hasOne('App\Models\TopPic','id','top_pics');
    }
    public function dietaryprefences(){
        return $this->hasOne('App\Models\DietaryPrefence','id','dietary_prefences');
    }
    public function labeldata(){
        return $this->hasOne('App\Models\LabelSetting','id','labels');
    }

    
}
