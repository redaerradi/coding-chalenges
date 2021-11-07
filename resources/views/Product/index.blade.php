@extends('layouts.index')

@section('content')

    <h1>Product</h1>
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <div class="">
                        <a class="btn btn-primary mb-2" href="{{ route('product.create') }}">Add product</a>

                    </div>
                </div>
                <div class="col">
                    <div class="float-left">

                        <form action="{{ url('product') }}" method="GET">
                            <div class="modal-body">
                                <!-- row category  -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="categories_search">categories :</label>
                                            <select id="categories_search" class="form-control" name="categories_search"
                                                placeholder="tape name" value="{{ $categories_search ?? '' }}">
                                                <option value="">Categories</option>
                                                @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="sortPrice">sort price :</label>
                                            <select id="sortPrice" class="form-control" name="sortPrice"
                                                value="{{ $sortPrice ?? '' }}">
                                                <option value="asc" selected>min -> max</option>
                                                <option value="desc">max -> min</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="sortName">sort name :</label>
                                            <select id="sortName" class="form-control" name="sortName"
                                                value="{{ $sortPrice ?? '' }}">
                                                <option value="asc" selected>A-Z</option>
                                                <option value="desc">Z-A</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary mt-4">
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">price</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->discription }}</td>
                            <td>{{ $product->price }}</td>
                            <td><img style="border: 1px solid #ddd;padding: 5px;width: 85px;border-radius: 50%;"
                                    src="{{ asset('productImage/' . "$product->image") }}" alt=""></td>
                            <td>

                                <span>
                                    <a class="btn btn-warning"
                                        href="{{ route('product.edit', ['product' => $product->id]) }}">Edit</a>
                                </span>


                                <a class="modal-effect btn btn-sm btn-danger" id="DeleteProduct-{{ $key }}"
                                    onclick="getIdDelete('{{ $key }}')" data-effect="effect-scale"
                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-toggle="modal"
                                    href="#modaldemo9">Delete</a>

                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

    <!-- Modal filter product -->
    <div class="modal fade" id="filterProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filter Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Product</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ url('product/destroy') }}" method="post">
                    @csrf
                    {{ method_field('delete') }}
                    {{-- @method('DELETE') --}}

                    <div class="modal-body">
                        <p>You want to delete the product</p><br>
                        <input class="form-control" type="text" name="id" id="id" value="" readonly>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                        <button type="submit" class="btn btn-danger">Oui</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- End Modal effects-->




    <script>
        $('#modaldemo9').on('show.bs.modal')

        function getIdDelete(id) {
            var data = document.getElementById('DeleteProduct-' + id);
            var input = document.getElementById('id');
            console.log(data.getAttribute('data-id'));
            input.value = data.getAttribute('data-id');
        }
    </script>

@endsection
