<div class="box-header with-border">
    <h3 class="box-title">Визиты за последние 30 дней</h3>
    <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div><!-- /.box-tools -->
</div><!-- /.box-header -->
<div class="box-body" style="display: block;">

    <ul class="products-list product-list-in-box">
        @foreach($last_products as $product)
            <li class="item">
                <div class="product-img">
                    @if(!empty($product->img))
                        <img src="{{asset('uploads/single/'.$product->img)}}">
                    @endif
                </div>
                <div class="product-info">
                    <a href=""  class="product-title">
                        {{$product->title}}
                        <span class="label label-primary">{{$product->price}}</span>
                    </a>
                    <span class="product-description">{{$product->description}}</span>
                </div>
            </li>
        @endforeach
    </ul>


</div><!-- /.box-body -->