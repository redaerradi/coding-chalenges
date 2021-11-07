@extends('layouts.index')

@section('content')
<h1>Add Product</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('category.store') }}" method="post">

               @csrf
            <div class="form-group row ">
                <div class="col" >
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control @if ($errors->get('name')) is-invalid @endif">
                        @if ($errors->get('name'))
                            @foreach ($errors->get('name') as $message)
                                <li class="text-danger">{{ $message }}</li>
                            @endforeach
                        @endif
                </div>
                <div class="col" >
                    <label for="">Category</label>
                    <select name="categorie" id="" class="form-control">
                        <option value="">Category</option>
                        @foreach ( $categories as $category )
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" >Add</button>


        </form>


    <div/>
    <div/>

@endsection
