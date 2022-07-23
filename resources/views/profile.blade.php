@extends('partials.master')

@section('content')
<!-- <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/"             title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"             title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
<main class="main">
<br>
<div class="row  justify-content-center">
<div class="card my-crystal-bg card-profile" style="width: 20rem;">
  <h3 class="card-header">Perfil</h3>
  <br>
  <div class="row d-flex justify-content-center">
  @if (Auth::user()->profile_image != NULL)
  <img  class="avatar profile-img" src="{{ asset(Auth::user()->profile_image) }}" >
  @else
  <img class="avatar profile-img" src="{{ asset('img/extras/default.png') }}">
  @endif
  </div>
  <button id="btn-profile" type="button" class="btn btn-sm btn-outline-secondary btn-edit-image" data-target="#profile-modal">
  <i class="fas fa-edit"></i>
  </button>
 
  <div class="card-body text-center">
    <h4 class="card-title">¡Hola {{ Auth::user()->username }}!</h4>
    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa nostrum quibusdam, corporis porro unde aperiam magnam iste harum? Repellat, repellendus similique obcaecati aperiam adipisci animi hic suscipit voluptatibus quibusdam enim?</p>
    <a href="#!" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
</div>
</main>


<div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="profile-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profile-modal-label">¡Selecciona tu avatar!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="card-deck">
    
      @foreach($images as $key => $image)
            <div class="card profile">
                
                <figure class="imghvr-blur">                  
                    <img class="avatar img-fluid" src="{{ asset('img/perfil/'.$image->getFilename() ) }}" >
                    <figcaption>
                        <form action="setimgprofile" method="post">
                         @csrf
                            <button class="btn  btn-info btn-set-img"><i class="fab fa-get-pocket"></i> Usar</button>
                            <input type="hidden"  name="url_profile" value="{{ $image->getFilename() }}">
                        </form>
                      </figcaption>
                 </figure>
                
                
            </div>
            
            @if( ($key + 1) % 5 == 0 && $key != 0)
            </div>
            <br>
            <div class="card-deck">
            @endif
        
      @endforeach
        </div>

      </div>
      <div class="modal-footer">
          <div class="alert alert-info" role="alert">
              <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/"  title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
          </div>

      </div>
    </div>
  </div>
</div>

<script>
   $(document).ready(function(){
 

        $("#btn-profile").click(function(){
            $("#profile-modal").modal({backdrop: true});
        });
        $(".btn-set-img").click(function(e){
            e.preventDefault();
            var path = $(this).siblings("input[name='url_profile']").val();
            $.ajax({
              method: 'POST',
              url: 'setimgprofile',
              dataType: 'json',
              data: {
                "_token": "{{ csrf_token() }}",
                "the_path": path,
              },
                success: function(response){
                    var the_path = JSON.stringify(response);
                    the_path = the_path.replace(/"/g,'');
                    $(".profile-img").attr("src", "img/perfil/"+the_path);
                    VanillaToasts.create({
                      title: 'Imagen',
                      text: 'Ya quedó',
                      type: 'success', // success, info, warning, error   / optional parameter
                      timeout: 3000 
                    });
                    $('#profile-modal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                },
                error: function(xhr, status, error)
                {
                 
                  VanillaToasts.create({
                    title: 'Imagen',
                    text: 'Error al comunicarse con el servidor, favor de intentar nuevamente',
                    type: 'error', // success, info, warning, error   / optional parameter
                    timeout: 3000 // hide after 5000ms, // optional parameter
                  });
                }  
            });
            
        });
    });
</script>
@endsection