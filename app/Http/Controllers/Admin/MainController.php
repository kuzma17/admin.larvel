<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\ProductRepository;
use DemeterChain\Main;
use Illuminate\Http\Request;
use MetaTag;

class MainController extends AdminBaseController
{
    private $orderRepository;
    private $productRepository;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = app(OrderRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    public function index(){

        $countUsers = MainRepository::getCountUsers();
        $countOrders = MainRepository::getCountOrders();
        $countProducts = MainRepository::getCountProductions();
        $countCategories = MainRepository::getCountCategories();

        $per_page = 4;

       // $last_orders = $this->orderRepository->getAllOrders($per_page);
        $last_products = $this->productRepository->getLastProducts($per_page);

        MetaTag::setTags(['title'=>'Админ паннель']);

      //  dd($last_products);

        return view('admin.main.index', compact('countUsers', 'countOrders', 'countCategories',
            'countProducts', 'last_orders', 'last_products'));
    }
}
