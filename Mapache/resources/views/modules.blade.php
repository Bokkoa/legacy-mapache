@extends('partials.master')

@section('content')
<main class="main">
<script type="text/javascript" src=" {{ asset('js/map.js')}}"> </script>

<br>
<div class=" col-12">
<div class="card my-crystal-bg">
  <h3 class="card-header">Modulos</h3>
  
 
  <div class="card-body">
  <div class="mx-auto ">
  <div class="row  col-12 container-fluid">
          <h3 class="my-text-typeR">Vista Satelital</h3>
          <!--The div element for the map -->
          <div id="map-container-3" class="z-depth-1 col-12" style="height: 500px"></div>
  </div>
      <hr class="my-hr">
      <div class="card text-center bg-transparent">

        <div class="card-body my-scroll">


            <div class="card-deck items-align-center">

            @foreach( $modules as $key => $module)
          
            <div class="card col-3">
            <div class="card-body d-flex flex-column">
                <div class="p-2 card-text">Modulo {{$module->Module_Name}} </div>
                <figure class="imghvr-zoom-out">
                @if ($module->Image_Path != 'null')                  
                <img class="card-img-top img-thumbnail" style="max-width:250px;" src="{{ asset($module->Image_Path)}}">
                @else
                <img class="card-img-top img-thumbnail" style="max-width:250px;" src="{{ asset('/img/extras/empty-module.png')}}">
                @endif
                    <figcaption>
                            <button class="btn  btn-secondary btn-img-zoom"><i class="far fa-eye"></i></i></button>
                            <input type="hidden" id="see-img-path"name="see-img-path" value="{{ $module->Image_Path }}">
                            <input type="hidden" id="see-img-name"name="see-img-path" value="{{ $module->Module_Name }}">
                      </figcaption>
                 </figure>
                <br>
                <p>{{ $module->Directions }}</p>
                <button  id="{{ $module->Module_Name }}" class="cambiarmapa btn btn-outline-info mt-auto text-center" type="button" name="button">Ubicar</button>
                <input class="coord-map" type="hidden" name="coordenadas" value="{{ $module->Coordinates }}">
            </div>
            </div>
             @if(($key + 1) % 4 == 0)
                </div>
                <br>
                <div class="card-deck">
             @endif
            @endforeach


            </div>

          </div>
        </div>
      </div>

    </div>
</div>



</div>
</div>

@isset($k)
<input id="the-key" type="hidden" value="{{$k}}">
<script>
setTimeout(function(){
  var key = $("#the-key").val();
      $( "#"+key).click();
}, 3000);
      
  </script>
@endisset
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