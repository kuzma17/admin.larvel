@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') Панель управления @endslot
            @slot('parent') Главная @endslot
            @slot('active') Список Заказов@endslot
        @endcomponent
    </section>

    <section class="comment">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Пользователь</td>
                                    <td>Статус</td>
                                    <td>Сумма</td>
                                    <td>Дата создания</td>
                                    <td>Дата изменения</td>
                                    <td>Действия</td>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($paginator as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>
                                            @if($order->status == 0) Новый @endif
                                                @if($order->status == 1) Выполнен @endif
                                                @if($order->status == 2) Удален @endif
                                        <td>{{$order->sum}} {{$order->currency}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->updated_at}}</td>
                                        <td>
                                            <a href="{{route('blog.admin.orders.edit', $order->id)}}" class="fa fa-fw fa-edit" title="Редактировать"></a>
                                            <a href="{{route('blog.admin.orders.forcedestroy', $order->id)}}" class="fa fa-fw fa-close destroy_order" title="Удалить"></a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="3">Заказы пока отсутствуют</td>
                                    </tr>
                                @endforelse
                                </tbody>

                            </table>

                            {!! $paginator->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
