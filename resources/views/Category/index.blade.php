@extends('layouts.index')

@section('content')

<h1>Category</h1>
<div class="card">
    <div class="card-body">

        <div>
            <a class="btn btn-primary mb-2"  href="{{ route('category.create') }}">Add Category</a>
        </div>


        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $categories as  $key=>$category )
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $category->name }}</td>
                  <td>

                      <span>
                      <a class="btn btn-warning"
                      href="{{ route('category.edit' , [ 'category'  => $category->id]) }}">Edit</a>
                    </span>


                    <a class="modal-effect btn btn-sm btn-danger" id="DeleteCategory-{{ $key }}" onclick="getIdDelete('{{ $key }}')" data-effect="effect-scale"
                    data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                    data-toggle="modal" href="#modaldemo9" >Delete</a>

                   </td>
                </tr>

                @endforeach

            </tbody>
          </table>

    </div>
  </div>

   <!-- delete -->
   <div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Delete Product</h6><button aria-label="Close"
                    class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ url('category/destroy') }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p>You want to delete the product</p><br>
                    <input  class="form-control"  type="text" name="id" id="id" value="" readonly>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Non</button>
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
            var data = document.getElementById('DeleteCategory-' + id);
            var input = document.getElementById('id');
            console.log(data.getAttribute('data-id'));
            input.value = data.getAttribute('data-id');
        }

</script>

@endsection
