<?php


namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use App\Models\Admin\Product as Model;

class ProductRepository extends CoreRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getLastProducts($per_page){

       // dd($this->startConditions());
        return $this->startConditions()
            ->orderBy('id', 'DESC')
            ->limit($per_page)
            ->paginate($per_page);
    }

}