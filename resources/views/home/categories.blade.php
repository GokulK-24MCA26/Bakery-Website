<div class="card">
    <div class="row">
        <div class="col-md-4 m-2">
            <h2>Categories</h2>
        </div>
    </div>


    <div class="row m-2 g-4">

        @foreach ($categories as $category)
            <div class="col-md-3">

                <div class="card shadow h-100 border-0">

                    @if ($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top"
                            style="height:180px; object-fit:cover;" loading="lazy">
                    @else
                        <div
                            style="height:180px; background:#EDE3D4; display:flex; align-items:center; justify-content:center;">

                            <i class="fa-solid fa-image fa-2x" style="color:#B8A489;"></i>

                        </div>
                    @endif

                    <div class="card-body text-center">

                        <h5 class="card-title mb-0">
                            {{ preg_replace('/^[^a-zA-Z]+/', '', $category->name) }}
                        </h5>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>



<div class="row"></div>

</div>
