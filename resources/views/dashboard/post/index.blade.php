@extends('dashboard.master')

@section('content')<br>


    <a class="btn btn-success mt-3 mb-3 fa fa-1x fa-plus-square" href="{{ route('post.create') }}"> Crear Post</a>

    <form action="{{ route('post.index') }}" class="form-inline mb-2">
        <select name="created_at" class="form-control ">
            <option value="DESC">Descendente</option>
            <option {{ request('created_at') == "ASC" ? "selected" : '' }} value="ASC">Ascendente</option>
        </select>

        <input type="text" value="{{ request('search') }}" name="search" placeholder="Buscar..." class="form-control ml-1">
        <button type="submit" class="btn btn-success ml-2"><i class="fa fa-1x fa-search"></i></button>

    </form>

    <table class="table">
        <thead>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    Titulo
                </td>
                <td>
                    Posteado
                </td>
                <td>
                    Categoría
                </td>
                <td>
                    Creacion
                </td>
                <td>
                    Actualizacion
                </td>
                <td>
                    Acciones
                </td>
            </tr>       
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>
                    {{ $post->id }}
                </td>
                <td>
                    {{ $post->title }}
                </td>
                <td>
                    {{ $post->posted }}
                </td>
                <td>
                    {{ $post->category->title }}
                </td>
                <td>
                    {{ $post->created_at->format('d-M-Y') }}
                </td>
                <td>
                    {{ $post->updated_at->format('d-M-Y') }}
                </td>
                <td>
                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary fa fa-1x fa-eye"></a>
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary fa fa-1x fa-edit"></a>
                    <a href="{{ route('post-comment.post', $post->id) }}" class="btn btn-primary fa fa-1x fa-comments"></a>
                    
                    <button data-toggle="modal" data-target="#deleteModal" data-id="{{  $post->id }}" class="btn btn-danger fa fa-1x fa-trash"></button>
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>


    {{ $posts->appends(
        [
            'created_at' => request('created_at'),
            'search' => request('search'),
        ])->links() }}

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>¿Seguro que deseas borrar el registro seleccionado?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

              <form action="{{ route('post.destroy', 0) }}" data-action="{{ route('post.destroy', 0) }}" method="POST" id="formDelete">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Borrar</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>

      <script>
            window.onload = function(){
        $('#deleteModal').on('show.bs.modal', function (event) {
            console.log("Modal abierto")
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            action = $('#formDelete').attr('data-action').slice(0,-1)
            action += id
            console.log(action)

            $('#formDelete').attr('action', action)

            var modal = $(this)
            modal.find('.modal-title').text('Vas a borrar el POST ' + id)
          })
            }
      </script>

@endsection

