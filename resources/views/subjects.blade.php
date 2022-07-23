@extends('partials.master')

@section('content')
<main class="main">
<br>
<div class="row col-12 d-flex justify-content-center">
<div class="card my-crystal-bg">
  <h3 class="card-header">Mis Materias</h3>
  <br>
  <div class="row col-12 d-flex justify-content-center">
  <div class="card-body">   

        @if(Auth::user()->siiaucode == NULL)
        <div class="alert alert-warning " role="alert">
            <strong>¡Vaya!</strong> aún no haz vinculado tu cuenta de siiau.
        </div>
             <div class="d-flex  justify-content-center"> 
            <img width="10%" src="{{ asset('img/WorriedM.png') }}" >
           
            </div>
            <div class="row  d-flex justify-content-center ">
            <form action="scrapsiiau" class="alert col-4 alert-secondary" method="post">
            @csrf
            <div class="row  d-flex justify-content-center ">
            <div class="form-group">
                <label for="siiaucode">Codigo de Siiau</label>
                <input type="number" class="form-control" id="siiaucode "name="siiaucode" required>
            </div>
            </div>
            <div class="row  d-flex justify-content-center">
            <div class="form-group">
                <label for="siiaupass">NIP</label>  
                <span id="info-pass" class="btn badge badge-info" data-container="body"
        data-toggle="popover" data-placement="right" data-content="Por motivos de seguridad nosotros no nos quedamos con este campo.">Info
                <i class="fas fa-info-circle"></i></span>
                <input type="password" class="form-control" id="siiaupass" name="siiaupass" required>
            </div>
            </div>

            <div class="row d-flex justify-content-center">
            <div class="form-group">
              <label for="siiautype">Soy de: </label>
              <select name="siiautype" id="siiautype" class="form-control">
                <option value="L"selected>Licenciatura</option>
                <option value="P">Preparatoria</option>
              </select>
            </div>
            </div>

            <div class="d-flex justify-content-end">
            <button class="btn btn-success btn-shadow">Vincular!</button>
            </div>
            </form>
            </div>
            
        @else
        <div class="d-flex  justify-content-center"> 
          <div class="table-responsive">
          <table class="table table-hover" id="subject-table">
            <thead class="alert-secondary">
            <tr>
            <th>NRC</th>
            <th>Nombre</th>
            <th>Horario</th>
            <th>Modulo</th>
            </tr>
            </thead>
            <tbody>
   
  
          @foreach($subjects as $s)
          <tr>
          <td>{{ $s->NRC }}</td>
          <td>{{ $s->Name }}</td>
          <td>{{ $s->Schedule }}</td>
          <form action="modules" method="post">
          {{ csrf_field() }}
          <input type="hidden" value="{{ $s->FK_Module}}" name="key">
          <td><button type="submit" class="btn btn-info">{{ $s->FK_Module }}</button></td>
          </form>
          </tr>
          
          @endforeach
          </tbody>
          </table>
          </div>
        </div>
        @endif
    </div>
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


<script>
  $(document).ready(function(){
    $('#subject-table').DataTable( { responsive: true });
    $('[data-toggle="popover"]').popover();

 $(".btn-img-zoom").click(function(){
     $("#img-modal").modal({backdrop: true});
     var path = $(this).siblings("#see-img-path").val();
     var name = "Modulo "+$(this).siblings("#see-img-name").val();
     $("#see-img").attr("src", path);
     $("#img-modal-label").text(name);
    });
});
</script>
@endsection