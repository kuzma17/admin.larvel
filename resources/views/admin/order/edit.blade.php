@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        <h1>
            Редактирование заказа № {{$item->id}}

            @if(!$order->status)
                <a href="{{route('blog.admin.orders.change', $item->id)}}/?status=1" class="btn btn-success">Одобрить</a>
                <a href="" class="btn btn-warning redact">Редактировать</a>
            @else
                <a href="{{route('blog.admin.orders.change', $item->id)}}/?status=0" class="btn btn-warning">Вернуть</a>

            @endif

            <a class="btn btn-xs">
                <form id="destroy" method="post" action="{{route('blog.admin.orders.destroy', $item->id)}}">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger delete">Удалить</button>
                </form>
            </a>
        </h1>

            @component('admin.components.breadcrumb')

                @slot('parent') Главная @endslot
                @slot('parent') Список Заказов@endslot
                @slot('active') Заказ № {{$item->id}}@endslot
            @endcomponent
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <form action="{{route('blog.admin.orders.save', $item->id)}}" method="post">
                                    @csrf
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <td>заказы</td>
                                            <td>{{$item->id}}</td>
                                        </tr>
                                        <tr>
                                            <td>Дата заказа</td>
                                            <td>{{$order->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Дата изменениязаказы</td>
                                            <td>{{$order->updated_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Количество позиций в заказе</td>
                                            <td>{{$order->id}}</td>
                                        </tr>
                                        <tr>
                                            <td>Сумма</td>
                                            <td>{{$order->sum}} {{$order->currency}}</td>
                                        </tr>
                                        <tr>
                                            <td>Статус</td>
                                            <td>{{$order->status? 'Завершен': 'Новый'}}</td>
                                        </tr>
                                        <tr>
                                            <td>Комментарий</td>
                                            <td><input type="text" name="comment" value="{!! $item->note !!}"></td>

                                        </tr>
                                        </tbody>
                                    </table>
                                    <input type="submit" class="btn btn-warning" value="Сохранить">
                                </form>
                            </div>
                        </div>
                    </div>

                    <h1>Детали Заказа</h1>

                    <div class="box">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Наименование</th>
                                        <th>количество</th>
                                        <th>Цена</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($qty = 0)
                                    @foreach($order_products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->qty, $qty = $product->qty}}</td>
                                            <td>{{$product->price}}</td>
                                        </tr>
                                    @endforeach

                                    <tr class="active">
                                        <td colspan="2"><b>Итого:</b></td>
                                        <td>{{$qty}}</td>
                                        <td>{{$order->sum}} {{$order->currency}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

@endsection
