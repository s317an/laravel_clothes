@extends('layouts.app')

@section('title')
カート
@endsection

@section('content')

<div class="contaner">
    <div class="cart__title">
        Shoppong Cart
    </div>
    @if (count($line_ltems)>0)
        <div class="cart-wrapper">
            @foreach ($line_ltems as $ltem)
                <div class="card mb-3">
                    <div class="row" style="flex-wrap: unset">
                        <img src="{{asset($ltem->image)}}" alt="{{$ltem->name}}" class="product-cart-img">
                        <div class="card-body">
                            <div class="card-product-name col-6">
                                {{$ltem->name}}
                            </div>
                            <div class="card-quantity col-2">
                                {{$ltem->pivot->quantity}}個
                            </div>
                            <div class="card__total-price col-3 text-center">
                                ¥{{number_format($ltem->price * $ltem->pivot->quantity)}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="cart__sub-tolal">
            小計：¥{{number_format($total_price)}}円
        </div>
        @else
        <div class="cart__empty">
            カートに商品が入っていません。
        </div>
    @endif
</div>
@endsection