<?php


namespace App\Repositories\Admin;


use App\Models\Admin\Order as Model;
use App\Repositories\CoreRepository;

class OrderRepository extends CoreRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllOrders($per_page){

        return $this->startConditions()::withTrashed()
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->select(\DB::raw('SUM(order_products.price) AS sum'), 'orders.id', 'orders.user_id', 'orders.status',
              'orders.created_at', 'orders.updated_at', 'orders.currency', 'users.name')
            ->groupBy('orders.id', 'orders.user_id', 'orders.status', 'orders.created_at', 'orders.updated_at',
                'orders.currency', 'users.name')
            ->orderBy('orders.status')
            ->orderBy('orders.id')
            ->toBase()
            ->paginate($per_page);
    }

    public function getOneOrder($id){
        return $this->startConditions()::withTrashed()
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->select(\DB::raw('SUM(order_products.price) AS sum'), 'orders.id', 'orders.user_id', 'orders.status',
                'orders.created_at', 'orders.updated_at', 'orders.currency', 'users.name')
            ->where('orders.id', $id)
            ->groupBy('orders.id', 'orders.user_id', 'orders.status', 'orders.created_at', 'orders.updated_at',
                'orders.currency', 'users.name')
            ->orderBy('orders.status')
            ->orderBy('orders.id')
            ->limit(1)
            ->first();
    }

    public function getAllOrderProductId($id){
        return \DB::table('order_products')
            ->where('order_id', $id)
            ->get();
    }

    public function changeStatusOrder($id){
        $item = $this->getId($id);

        if (!$item){
            abort(404);
        }

        $item->status = !empty($_GET['status'])? '1': '0';
        return $item->update();
    }

    public function changeStatusOnDelete($id){
        $item = $this->getId($id);

        if(!$item){
            return abort(404);
        }

        $item->status = '2';

        return $item->update();
    }

    public function saveOrderComment($id){
        $item = $this->getId($id);

        if(!$item){
            return abort(404);
        }

        $item->note = !empty($_POST['comment'])? $_POST['comment']: null;

        return $item->update();
    }
}