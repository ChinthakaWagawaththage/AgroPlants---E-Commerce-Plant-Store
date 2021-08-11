@extends('layouts.app')

@section('page-title', 'Welcome to the LeisureGuider !!!')

@section('content')
  {{-- carousel --}}
  <div id="mainBanner" class="carousel slide main-banner" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#mainBanner" data-slide-to="0" class="active"></li>
      <li data-target="#mainBanner" data-slide-to="1"></li>
      <li data-target="#mainBanner" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('images/banner/1.jpg')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('images/banner/2.jpg')}}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('images/banner/3.jpg')}}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#mainBanner" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#mainBanner" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  
  {{-- sale --}}
  @if($flashSaleProducts->count())
  <section class="just-for-you-section container h-100 my-4">
    <h3>Discounts From The Shop</h3>
    <div class="row h-100">

      @foreach($flashSaleProducts as $item)
      <div class="col-6 col-sm-4 col-md-2 p-2">
        <div class="card shadow-hover h-100" >
          <img src="{{$item->product->productImage->first()->original}}" class="card-img-top" alt="">
          <div class="card-body ">
            <p class="product-title">{{$item->product->title}}</p>
          <small class="line-through">Rs. {{number_format($item->product->price)}}</small>
            <p class="product-price">Rs. {{number_format($item->flash_price)}}</p>
          </div>
          <form action="{{route('directBuy.order')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$item->id}}">
            <button class="btn btn-primary btn-sm btn-block">Buy now</button>
          </form>
        </div>
      </div>
      @endforeach
  
    </div>
  </section>
  @endif

  {{-- categories-section --}}
  <section class="categories-section container my-4 h-100">
    <h3>Categories</h3>
      <div class="row h-100">
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Automatic Tents'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/tents.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Camping Tents</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Hammocks'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/hammock.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Hammocks</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Camping Gas Stoves'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/gas.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Camping Gas Stoves</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=BBQ Machines'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/bbq.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">BBQ Machines</p>
              </div>
            </div>
          </a>
        </div>
        
        <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]= '}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/others.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Other Equipments</p>
              </div>
            </div>
          </a>
        </div>
        
        {{-- <div class="col-4 col-sm-4 col-md-2 p-2">
          <a href="{{'catalog?filter[subCategory]=Pet'}}">
            <div class="card shadow-hover">
              <div class="card-body">
                <img src="{{asset('images/demo/pet.jpg')}}" class="img-fluid" alt="">
                <p class="card-title text-center">Pets</p>
              </div>
            </div>
          </a>
        </div> --}}

      </div>
    </div>
  </section>

  {{-- just for you --}}
  <section class="just-for-you-section container h-100 my-4">
    <h3>Recommended For You</h3>
    <div class="row h-100">
      @foreach($newProducts as $product)
      <div class="col-6 col-sm-4 col-md-2 p-2">
        <a href="{{$product->path()}}">
        <div class="card shadow-hover h-100" >
          <img src="{{asset($product->productImage->first()->original)}}" class="card-img-top" alt="">
          <div class="card-body ">
            <p class="product-title">{{$product->title}}</p>
            @if($product->onSale)
              <small class="line-through text-dark">Rs. {{$product->price}}</small>
              <p class="product-price">Rs.{{number_format($product->sale_price)}}</p>
            @else
              <p class="product-price">Rs.{{number_format($product->price)}}</p>
            @endif
          </div>
        </div>
        </a>
      </div>
      @endforeach
  
    </div>
  
    <div class="d-flex justify-content-center mt-5">
      <div class="text-center">
        <h2>Didn't Find Your Match ?</h2>
        <a href="{{route('shop.catalog')}}" class="btn btn-orange">Search For It</a>
      </div>
    </div>
  </section>
  


@endsection