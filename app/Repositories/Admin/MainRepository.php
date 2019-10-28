<?php


namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Model;

class MainRepository extends CoreRepository
{


    protected function getModelClass()
    {

        return Model::class;
    }

    public static function getCountOrders(){
        return \DB::table('orders')
            ->where('status', 0)
            ->get()
            ->count();
    }

    public static function getCountUsers(){
        return \DB::table('users')
            ->get()
            ->count();
    }

    public static function getCountProductions(){

        return \DB::table('products')
            ->get()
            ->count();
    }

    public  static function getCountCategories(){

        return \DB::table('categories')
            ->get()
            ->count();
    }


}