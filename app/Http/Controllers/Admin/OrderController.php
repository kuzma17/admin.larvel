<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminOrderSaveRequest;
use App\Models\Admin\Order;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\OrderRepository;
use MetaTag;
use Illuminate\Http\Request;

class OrderController extends AdminBaseController
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per_page = 5;
        $countOrder = MainRepository::getCountOrders();
        $paginator = $this->orderRepository->getAllOrders(10);

        MetaTag::setTags(['title'=>'Список закаков']);

        return view('admin.order.index', compact('countOrder','paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->orderRepository->getId($id);

        if (empty($item)){
            abort(404);
        }

        $order = $this->orderRepository->getOneOrder($item->id);

        if (!$order){
            abort(404);
        }

        $order_products = $this->orderRepository->getAllOrderProductId($item->id);

        MetaTag::setTags(['title'=>'Заказ №:'.$order->id]);

        return view('admin.order.edit', compact('item', 'order', 'order_products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $str = $this->orderRepository->changeStatusOnDelete($id);

        if ($str){
           $result = Order::destroy($id);

           if ($result){
               return redirect()->route('blog.admin.orders.index')
                   ->with(['success' => "Запись $id удалена"]);
           }else{
               return back()->withErrors(['key' => 'Ошибка удаления']);
           }
        }else{
            return back()->withErrors('key', 'Статус не изменился');
        }
    }

    public function change($id){
        $result = $this->orderRepository->changeStatusOrder($id);

        if ($result){
            return redirect()->route('blog.admin.orders.edit', $id)
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()
                ->withErrors(['key' => 'Ошибка сохранения']);
        }
    }

    public function save($id){
        $result = $this->orderRepository->saveOrderComment($id);

        if ($result){
            return redirect()->route('blog.admin.orders.index')
                ->with(['success' => "Запись $id удалена"]);
        }else{
            return back()->withErrors(['key' => 'Ошибка удаления']);
        }
    }

    public function forcedestroy($id){
        if (!$id){
            return redirect()->back()->withErrors(['key'=> 'Запись не найдена']);
        }

        $res = \DB::table('orders')->delete($id);

        if ($res){
            return redirect()->route('blog.admin.orders.index', $id)
                ->with(['success' => 'Успешно удалено']);
        }else{
            return back()
                ->withErrors(['key' => 'Ошибка удаления']);
        }
    }
}
