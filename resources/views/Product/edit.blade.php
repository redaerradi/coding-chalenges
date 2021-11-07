@extends('layouts.index')

@section('content')
<h1>Add Product</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('product.update' ,  ['product' =>$product->id] ) }}" method="post" enctype="multipart/form-data">
               @csrf
               @method('PUT')
            <div class="form-group row ">
                <div class="col" >
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control @if ($errors->get('name')) is-invalid @endif">
                        @if ($errors->get('name'))
                            @foreach ($errors->get('name') as $message)
                                <li class="text-danger">{{ $message }}</li>
                            @endforeach
                        @endif
                </div>
                <div class="col" >
                    <label for="">Price</label>
                    <input type="number" name="price" value="{{ $product->price }}" class="form-control @if ($errors->get('price')) is-invalid @endif">
                    @if ($errors->get('price'))
                            @foreach ($errors->get('price') as $message)
                                <li class="text-danger">{{ $message }}</li>
                            @endforeach
                        @endif
                </div>
            </div>
            <div class="form-group row ">
                <div class="col" >
                    <label for="">Categoy</label>
                   <select name="categories" id="" class="form-control @if ($errors->get('category')) is-invalid @endif">
                    <option value="">Category</option>
                       @foreach ( $categories as $category )
                       <option value="{{ $category->id }}" @if($product->categories == $category->id) selected @endif>{{ $category->name }}</option>
                       @endforeach

                   </select>
                   @if ($errors->get('category'))
                            @foreach ($errors->get('category') as $message)
                                <li class="text-danger">{{ $message }}</li>
                            @endforeach
                        @endif
                </div>
                <div class="col" >
                    <label for="">Image</label>
                    <input type="file" name="image"  class="form-control @if ($errors->get('image')) is-invalid @endif">
                    @if ($errors->get('image'))
                            @foreach ($errors->get('image') as $message)
                                <li class="text-danger">{{ $message }}</li>
                            @endforeach
                        @endif

                        <img src="{{ asset("productImage/"."$product->image" )}}" alt="" style="border: 1px solid #ddd;padding: 5px;width: 85px;border-radius: 50%;">


                </div>
            </div>
            <div class="form-group row ">
                <div class="col" >
                    <label for="">Description</label>
                    <textarea class="form-control @if ($errors->get('description')) is-invalid @endif"   name="discription"  id="" cols="30" rows="10">{{ $product->discription }}</textarea>
                    @if ($errors->get('description'))
                            @foreach ($errors->get('description') as $message)
                                <li class="text-danger">{{ $message }}</li>
                            @endforeach
                        @endif
                </div>

            </div>

            <button type="submit" class="btn btn-primary" >Add</button>


        </form>


    <div/>
    <div/>

@endsection
