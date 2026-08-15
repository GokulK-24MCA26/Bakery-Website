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
                    <div class="col-md-3">

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

                            <div class="card-body ">

                                <h5 class="card-title mb-0">
                                    {{ preg_replace('/^[^a-zA-Z]+/', '', $bread->name) }}


                                    <p class="price">₹ {{ $bread->price }}</p>

                                    <span class="old-price">₹599</span>
                                </h5>

                            </div>


                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
