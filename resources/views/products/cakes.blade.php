@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush
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
                <h2>Cakes</h2>
            </div>
            <div class="d-flex justify-content-end align-items-center gap-2">

                <label for="search">Search</label>

                <input type="text" id="search" name="name" value="{{ request('name') }}" class="form-control"
                    placeholder="Search Cakes" style="width: 300px;">


            </div>
            <div class="row m-2 g-4">

                @foreach ($cakes as $cake)
                    <div class="col-md-3 cake-card">

                        <div class="card shadow h-100 border-0">

                            @if ($cake->image)
                                <img src="{{ asset('storage/' . $cake->image) }}" class="card-img-top"
                                    style="height:180px; object-fit:cover;" loading="lazy">
                            @else
                                <div
                                    style="height:180px; background:#EDE3D4; display:flex; align-items:center; justify-content:center;">

                                    <i class="fa-solid fa-image fa-2x" style="color:#B8A489;"></i>

                                </div>
                            @endif

                            <div class="card-body ">

                                <h5 class="card-title cake-name mb-0">
                                    {{ preg_replace('/^[^a-zA-Z]+/', '', $cake->name) }}
                                </h5>

                                <p class="price">₹ {{ $cake->price }}</p>

                                <span class="old-price">₹599</span>

                            </div>


                        </div>

                    </div>
                @endforeach
                <div id="no-product" class="text-center mt-4" style="display: none;">
                    <h4>No Product Found 🍰</h4>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('search').addEventListener('keyup', function() {

            let searchValue = this.value.toLowerCase();

            document.querySelectorAll('.cake-card').forEach(function(card) {

                let cakeName = card.querySelector('.cake-name')
                    .innerText
                    .toLowerCase();

                if (cakeName.includes(searchValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }

            });

        });
    </script>
@endpush
