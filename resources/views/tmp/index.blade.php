@extends('tmp.layouts.tmp')

@section('content')
    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Start Banner Hero -->
    <!-- Tambahkan Carousel -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <!-- Indicators -->
        @foreach($products as $key => $product)
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{ $key }}" @if($loop->first) class="active" @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($products as $product)
        <div class="carousel-item @if($loop->first) active @endif">
            <div class="container">
                <div class="row p-5">
                    <!-- Tampilan slide sesuai dengan data produk -->
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid"style="height:300px;" src="{{ asset('assets/img/' . $product->Product_Name . '.webp' ) }}" alt="{{ $product->Product_Name }} ">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 style="font-size:3em;" class=" text-success">{{ $product->Product_Name }}</h1>
                            <h3 style="font-size:1em;" class="">{{ $product->Description }}</h3>
<h3 class="h4">
    <span style="vertical-align: middle;">${{ $product->Price }}</span>
    <a class="btn btn-primary" href="Product/{{ $product->Product_Name }}" role="button" style=" height: 30px; line-height: 18px; margin-bottom:10px;"><strong>Shop</strong></a>
</h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Controls -->
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>


    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h5 " style="font-size:50px;" >Best product</h1>
            </div>
        </div>
       <div class="row">
    @foreach($products->whereIn('Product_Name', ['Hp', 'TV', 'Ps']) as $product)
    <div class="col-12 col-md-4 p-5 mt-3">
        <a href="Product/{{ $product->Product_Name }} "><img src="{{ asset('assets/img/' . $product->Product_Name . '.webp' ) }}" class="rounded-circle img-fluid border" alt="{{ $product->Product_Name }}" style="width: 200px; height: 200px"></a>
        <h5 class="text-center mt-3 mb-3">{{ $product->Product_Name }}</h5>
        <p class="text-center"><a href="Product/{{ $product->Product_Name }} " class="btn btn-success">Go Shop</a></p>
    </div>
    @endforeach
</div>


    </section>
    <!-- End Categories of The Month -->
@endsection
