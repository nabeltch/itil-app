@php
$type=explode("/",Request::path());
@endphp
@extends($type[0].'.layouts.app')

@section('template_title')
Product
@endsection

@section('content')
<section style="background-color: #eee;">
    <div class="row">
     
       
        @foreach ($products as $product)
        <div class="col-lg-3">
        <div class="card" style="border-radius: 5px;">
          <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/12.webp" style="border-top-left-radius: 15px; border-top-right-radius: 15px;" class="img-fluid" alt="Laptop" />
          </div>
          <div class="card-body">
                <p class="text-dark">{{ $product->name}}</p>
                <p class="small text-muted">{{ $product->category}}</p>
          <hr class="my-0"/>
              <p class="text-dark">${{$product->price}}</p>
          <hr class="my-0" />
          <form method="POST" action="{{ route('purchases.store') }}"  role="form" enctype="multipart/form-data">
            <div class="row justify-content-between mt-3 mx-1">
            @csrf
              <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
              <input type="hidden" name="id_product" value="{{$product->id}}">
              <input type="number" class="col-lg-4" name="Quantity" min="1" pattern="^[0-9]+" value="1" style="border-radius: 5px; border:1px solid #666;">
              <input type="hidden" name="price" value="{{$product->price}}">
              <input type="hidden" name="total" value="1000">
              <button type="submit" class="btn col-lg-7 btn-primary">Comprar</button>
            </div>
            </form>
          </div>
        </div>
        </div>
        @endforeach

      
    </div>


</section>

@endsection