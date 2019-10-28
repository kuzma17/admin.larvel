@extends('layouts.app_admin')

@section('content')

    <section class="content-header">
        @component('admin.components.breadcrumb')
            @slot('title') Панель управления @endslot
                @slot('parent') Главная @endslot
                @slot('active') @endslot
        @endcomponent
    </section>

    <section class="content">


    <div class="row"><div class="col-md-3"><div  class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$countUsers}}</h3>

                    <p>Новых клиентов</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="/admin/users" class="small-box-footer">
                    Еще&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div></div><div class="col-md-3"><div  class="small-box bg-green">
                <div class="inner">
                    <h3>{{$countOrders}}</h3>

                    <p>Новых заказов</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="/admin/orders" class="small-box-footer">
                    Еще&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div></div><div class="col-md-3"><div  class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$countProducts}}</h3>

                    <p>Всего продуктов</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="/admin/users" class="small-box-footer">
                    Еще&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div></div><div class="col-md-3"><div  class="small-box bg-red">
                <div class="inner">
                    <h3>{{$countCategories}}</h3>

                    <p>Всего категорий</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="/admin/orders" class="small-box-footer">
                    Еще&nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>

    </section>

    <div class="row">
        <div class="col-md-6">
            @include('admin.main.include.orders')
        </div>
        <div class="col-md-6">
            @include('admin.main.include.recently')
        </div>

    </div>


@endsection
