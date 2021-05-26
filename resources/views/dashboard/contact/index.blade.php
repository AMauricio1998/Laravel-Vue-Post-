@extends('dashboard.master')

@section('content')<br>

    <table class="table">
        <thead>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    Nombre
                </td>
                <td>
                    Apellido
                </td>
                <td>
                    Email
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
            @foreach ($contacts as $contact)
            <tr>
                <td>
                    {{ $contact->id }}
                </td>
                <td>
                    {{ $contact->name }}
                </td>
                <td>
                    {{ $contact->surname }}
                </td>
                <td>
                    {{ $contact->email }}
                </td>
                <td>
                    {{ $contact->created_at->format('d-M-Y') }}
                </td>
                <td>
                    {{ $contact->updated_at->format('d-M-Y') }}
                </td>
                <td>
                    <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-primary">Ver</a>
                    
                    <button data-toggle="modal" data-target="#deleteModal" data-id="{{  $contact->id }}" class="btn btn-danger">Eliminar</button>
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>


    {{ $contacts->links() }}

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

              <form action="{{ route('contact.destroy', 0) }}" data-action="{{ route('contact.destroy', 0) }}" method="POST" id="formDelete">
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

