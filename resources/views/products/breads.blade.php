@extends('layouts.app')
@section('content')
    <style>
        .price {
            color: #D85616;
            font-size: 20px;
            font-weight: bold;
        }

        .old-price {
            color: #999;
            text-decoration: line-through;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h2>Breads & Pastries</h2>
            </div>
            <div class="row m-2 g-4">

                @foreach ($breads as $bread)
                    <div class="col-6 col-md-3">

                        <div class="card shadow h-100 border-0">

                            @if ($bread->image)
                                <img src="{{ asset('storage/' . $bread->image) }}" class="card-img-top"
                                    style="height:180px; object-fit:cover;" loading="lazy">
                            @else
                                <div
                                    style="height:180px; background:#EDE3D4; display:flex; align-items:center; justify-content:center;">

                                    <i class="fa-solid fa-image fa-2x" style="color:#B8A489;"></i>

                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title mb-1">
                                    {{ preg_replace('/^[^a-zA-Z]+/', '', $bread->name) }}
                                </h5>
                                <p class="price mb-1">₹ {{ $bread->price }}</p>
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    @auth
                                        <a href="{{ route('orders.create', $bread) }}"
                                           class="btn btn-sm w-100"
                                           style="background:#B23A48;color:#fff;font-weight:600;border-radius:7px;font-size:13px;">
                                            <i class="fa-solid fa-bag-shopping me-1"></i> Order Now
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                           class="btn btn-sm w-100"
                                           style="background:#B23A48;color:#fff;font-weight:600;border-radius:7px;font-size:13px;">
                                            <i class="fa-solid fa-bag-shopping me-1"></i> Order Now
                                        </a>
                                    @endauth
                                </div>
                            </div>


                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
