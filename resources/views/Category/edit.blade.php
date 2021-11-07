
@extends('layouts.index')

@section('content')
<h1>Edit Category</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('category.update' , ['category' => $category->id]) }}" method="post">

               @csrf
               @method('PUT')
            <div class="form-group row ">
                <div class="col" >
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control @if ($errors->get('name')) is-invalid @endif">
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
                        @foreach ( $categories as $categorie )
                        <option value="{{ $categorie->id }}"  @if($category->categories == $categorie->id) selected @endif>{{ $categorie->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" >Add</button>


        </form>


    <div/>
    <div/>

@endsection
