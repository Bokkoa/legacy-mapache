@extends('partials.master')

@section('content')
<main class="main">
<br>
<div class="row col-12">
<div class="card shadow my-crystal-bg col-12">
  <h3 class="card-header">Gestion de Modulos</h3>
  <br>
  
  <div class="card-body">   

    <form action="insertmodule" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
       <div class="form-group col-6">
            <label for="name">Nombre</label>
            <input id="name" type="text" class="form-control" name="name">
       </div>
       <div class="form-group col-6">
            <label for="directions">Direcciones (Descripción)</label>
            <input id="directions" type="text" class="form-control" name="directions">
       </div>
    </div>
    <div class="row">
       <div class="form-group col-8">
            <label for="coordinates">Coordenadas</label>
            <input id="coordinates" type="text" class="form-control" name="coordinates">
       </div>

       <div class="form-group col-4" >
            <label id="lbl-img" for="image" class="custom-file-label" style="margin-top: 30px;">Selecciona una imagen...</label>
            <input id="image" type="file" class="custom-file-input" name="image"style="margin-top: 30px;" accept="image/x-png,image/gif,image/jpeg" >
       </div>
    </div>

        <input type="submit" value="Registrar" class="btn btn-secondary">
    </form>
         
    </div>
</div>
</div>

<div class="row col-12">
<div class="card shadow my-crystal-bg col-12">
  <h3 class="card-header">Vista</h3>
  <br>
  
  <div class="card-body table-responsive">   

    <table id="table" class="table  text-center table-sm table-hover " style="heigh: 500px;">
        <thead>
            <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Coordenadas</th>
            <th>Imagen</th>
            <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($modules as $m)
            <tr class="data-row">
            <td id="name">{{ $m->Module_Name}}</td>
            <td id="directions">{{ $m->Directions}}</td>
            <td id="coords">{{ $m->Coordinates}}</td>
            <td id="image"><figure class="imghvr-zoom-out"> 
              @if($m->Image_Path != 'null')                 
                <img width="15%" src="{{ asset($m->Image_Path)}}">
              @else 
                <img width="15%" src="{{ asset('img/extras/empty-module.png')}}">
              @endif
                    <figcaption>
                            <button class="btn  btn-secondary btn-img-zoom"><i class="far fa-eye"></i></i></button>
                            <input type="hidden" id="see-img-path"name="see-img-path" value="{{ $m->Image_Path }}">
                            <input type="hidden" id="see-img-name"name="see-img-path" value="{{ $m->Module_Name }}">
                      </figcaption>
                 </figure></td>
            <td><div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="btn-edit" class="btn alert-secondary btn-edit"><i class="fas fa-edit"></i></button>
                    <button type="button" id="btn-delete"class="btn alert-danger btn-delete"><i class="fas fa-trash"></i></button>
                </div>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
         
    </div>
</div>
</div>

</main>



<div class="modal fade" id="img-modal" tabindex="-1" role="dialog" aria-labelledby="profile-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="img-modal-label"></h5> 
      </div>

      <div class="modal-body">  
       <img id="see-img" src="" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
     </div>
    </div>
   
   </div>   
</div>

<


<div class="modal fade" id="edit-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" align="center" ><b>Editar</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="editmodule" method="post">
        {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="modal-input-name">Nombre</label>
              <input type="text" class="form-control" id="modal-input-name" name="name" required>
            </div>
            <div class="form-group">
              <label for="modal-input-dir">Direcciones</label>
              <input type="text" class="form-control" id="modal-input-dir" name="dir" required>
            </div>
            <div class="form-group">
              <label for="modal-input-coords">Coordenadas</label>
              <input type="text" class="form-control" id="modal-input-coords" name="coords" required>
            </div>
            <div class="form-group">
              <label for="modal-input-path">Path de Imagen</label>
              <input type="text" class="form-control" id="modal-input-path" name="path" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="delete-modal">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" align="center"><b>Eliminar Usuario</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form role="form" action="deletemodule" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="box-body">
          <div class="form-group">
            <label for="modal-input-name-delete">Nombre</label>
            <input type="text" class="form-control" id="modal-input-name-delete" name="name" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-dir-delete">Direccion</label>
            <input type="text" class="form-control" id="modal-input-dir-delete" name="dir" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-coords-delete">Coordenadas</label>
            <input type="text" class="form-control" id="modal-input-coords-delete" name="coords" readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-path-delete">Path de Imagen</label>
            <input type="text" class="form-control" id="modal-input-path-delete" name="path" readonly>
          </div>
        </div>
        <label><strong>¿Seguro que deseas eliminar este modulo?</strong></label>
        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>


<script>
  $(document).ready(function(){

    var fileInput = document.getElementById('image')
          fileInput.addEventListener('change', function () {
              var  label = document.getElementById("lbl-img");
              label.classList.add("alert-success");
              label.innerHTML = "Listo";
          }, false);


    $('#table').DataTable();
   
    $('[data-toggle="popover"]').popover();

 $(".btn-img-zoom").click(function(){
     $("#img-modal").modal({backdrop: true});
     var path = $(this).siblings("#see-img-path").val();
     var name = "Modulo "+$(this).siblings("#see-img-name").val();
     $("#see-img").attr("src", path);
     $("#img-modal-label").text(name);
    });

   
    
    $('#table tbody').on('click', '.btn-edit', function (){
            $(this).addClass('edit-item-trigger-clicked');
            $('#edit-modal').modal();
         } );

    $('#edit-modal').on('show.bs.modal', function() {
            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
            var row = el.closest(".data-row");
            var name = row.children("#name");
            var direction = row.children('#directions');
            var coords = row.children('#coords');
            var image = row.children('#image').children('figure').children('figcaption').children('#see-img-path').val();

            $("#modal-input-name").val(name[0]['innerHTML']);
            $("#modal-input-dir").val(direction[0]['innerHTML']);
            $("#modal-input-coords").val(coords[0]['innerHTML']);
            $("#modal-input-path").val(image);
          
    } );

    $('#edit-modal').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
     })
              

     $('#table tbody').on('click', '.btn-delete', function (){
        $(this).addClass('delete-item-trigger-clicked');
        $('#delete-modal').modal();
     } );

     
    $('#delete-modal').on('show.bs.modal', function() {
             var el = $(".delete-item-trigger-clicked"); // See how its usefull right here?
            var row = el.closest(".data-row");
            var name = row.children("#name");
            var direction = row.children('#directions');
            var coords = row.children('#coords');
            var image = row.children('#image').children('figure').children('figcaption').children('#see-img-path').val();

            $("#modal-input-name-delete").val(name[0]['innerHTML']);
            $("#modal-input-dir-delete").val(direction[0]['innerHTML']);
            $("#modal-input-coords-delete").val(coords[0]['innerHTML']);
            $("#modal-input-path-delete").val(image);
      
            $('#delete-modal').modal()
              } );
    $('#delete-modal').on('hide.bs.modal', function() {
        $('.delete-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#delete-form").trigger("reset");
     })

        

});


</script>
@endsection