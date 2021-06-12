@extends('dashboard.master')

@section('content')<br>

<div class="col-6 mb-3">
    <form action="{{ route('post-comment.post', 1) }}" id="filterForm">
        <div class="form-row">
            <div class="col-10">
                <select id="filterPost" class="form-control">
                    @foreach ($posts as $p)
                        <option value="{{ $p->id }}"
                            {{ $post->id == $p->id ? 'selected' : '' }}>
                            {{ Str::limit($p->title, 100) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
               <button type="submit" class="btn btn-success">Enviar</button>
            </div>
         </div>
    </form>
</div>

@if (count($postComments) > 0)
    

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
                    Aprovado
                </td>
                <td>
                    Usuario
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
            @foreach ($postComments as $postComment)
            <tr>
                <td>
                    {{ $postComment->id }}
                </td>
                <td>
                    {{ $postComment->title }}
                </td>
                <td>
                    {{ $postComment->approved }}
                </td>
                <td>
                    {{ $postComment->user->name }}
                </td>
                <td>
                    {{ $postComment->created_at->format('d-M-Y') }}
                </td>
                <td>
                    {{ $postComment->updated_at->format('d-M-Y') }}
                </td>
                <td>
                    {{--  <a href="{{ route('post-comment.show', $postComment->id) }}" class="btn btn-primary">Ver</a>  --}}
                    
                    <button data-toggle="modal" data-target="#showModal" data-id="{{  $postComment->id }}" 
                        class="btn btn-primary">Ver</button>

                        <button  data-id="{{  $postComment->id }}" 
                        class="approved btn btn-{{ $postComment->approved == 1 ?  "success" : "danger"  }}">{{ $postComment->approved == 1 ?  "Aprobado" : "Rechazado"  }}</button>

                        <button data-toggle="modal" data-target="#deleteModal" data-id="{{  $postComment->id }}" 
                            class="btn btn-danger">Eliminar</button>
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>


    {{ $postComments->links() }}

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

              <form action="{{ route('post-comment.destroy', 0) }}" data-action="{{ route('post-comment.destroy', 0) }}" method="POST" id="formDelete">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Borrar</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="message">----------</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

             
              
            </div>
          </div>
        </div>
      </div>



      <script>

         document.querySelectorAll(".approved").forEach(button => button. addEventListener("click", function(){
          console.log("Hola mundo: "+ button.getAttribute("data-id"))

          var id = button.getAttribute("data-id");

          var formData = new FormData();
          formData.append("_token", '{{ csrf_token() }}');

          fetch("{{ URL::to("/") }}/dashboard/post-comment/proccess/"+id,{
            method: 'POST',
            body: formData
          })
                        .then(response => response.json())
                        .then(approved => {
                          if(approved == 1){
                            button.classList.remove('btn-danger');
                            button.classList.add('btn-success');
                            button.innerHTML = "Aprobado";
                          }else{
                            button.classList.remove('btn-success');
                            button.classList.add('btn-danger');
                            button.innerHTML = "Rechazado";
                          }
                            });

          //$.ajax({
          //  method: "POST",
          //  url: "{{ URL::to("/") }}/dashboard/post-comment/proccess/"+id,
          //  data:{'_token': '{{ csrf_token() }}'}
          //})
          //  .done(function( approved ) {
          //      if(approved == 1){
          //        $(button).removeClass('btn-danger');
          //        $(button).addClass('btn-success');
          //        $(button).text("Aprobado");
          //      }else{
          //        $(button).addClass('btn-danger');
          //        $(button).removeClass('btn-success');
          //        $(button).text("Rechazado");
          //      }
          //  });

        }))
         
        

            window.onload = function(){

                $('#showModal').on('show.bs.modal', function (event) {
                    console.log("Modal abierto")
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var id = button.data('id') // Extract info from data-* attributes
                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    
                    var modal = $(this)
                    /*$.ajax({
                        method: "GET",
                        url: "{{ URL::to("/") }}/dashboard/post-comment/j-show/"+id,
                      })
                        .done(function( comment ) {
                            modal.find('.modal-title').text(comment.title)
                            modal.find('.message').text(comment.message)
                            //respuesta tipo html para mostrar pagina web
                            //modal.find('.message').html(comment)
                        });*/

                        fetch("{{ URL::to("/") }}/dashboard/post-comment/j-show/"+id)
                        .then(response => response.json())
                        .then(comment => {
                            modal.find('.modal-title').text(comment.title)
                            modal.find('.message').text(comment.message)
                            });
        
        
                  });



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
          });

          $("#filterForm").submit(function(){
            //console.log($(this).val());

            var action = $(this).attr('action');
            action = action.replace(/[0-9]/g, $('#filterPost').val());
            console.log(action);
            $(this).attr('action', action);



      });   
            }
      </script>
          
      @else
          <h1>No hay comentarios para este Post</h1>
      @endif
    
@endsection

