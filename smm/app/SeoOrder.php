<?php 
namespace App;


class SeoOrder extends \Illuminate\Database\Eloquent\Model
{
    protected $table ="seoorders";
    protected $guarded =[];
    
    public function package() {
        return $this->hasOne('App\SeoPackage', 'id', 'package_id');
    }

}


