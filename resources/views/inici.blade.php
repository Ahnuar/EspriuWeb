@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-md-8 col-sm-12">
      <h2>Pròxims Events:</h2>  
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            {{-- <img src="{{$eventos[0]->imagen}}" class="d-block w-100" alt="First"> --}}
          </div>
          <div class="carousel-item">
            {{-- <img src="{{$eventos[1]->imagen}}" class="d-block w-100 " alt="Second"> --}}
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Següent</span>
        </button>
        
      </div>
    </div>
  </div>
  <button class="btn btn-primary col-md-2 col-sm-4" style="text-align: center; margin-inline: 40%; margin-top: 5px">Inscriure'm</button>

  <div class="container  mt-5 font-weight-light">
    <div class="row margin-bottom-50">
              <div class="col-12 col-md-6 col-xl-4"> 
                <div class="mb-5" style="min-height: 40%">
                  <img class="img-fluid margin-bottom-15" src="https://agora.xtec.cat/ceip-espriu-montgat/wp-content/uploads/usu1919/2020/02/logo-AFA.jpg" alt="AFA">
                </div>
                <a class="btn_1" href="https://afasalvadorespriu.blogspot.com/">Més Informació</a> 
                <p></p><p>Treballem amb l'ajuda de l' <strong><span style="color: #33cccc;">AFA</span>.</strong> De l'escola <strong><span style="color: #33cccc;">Salvador Espriu</span>.</strong></p><p>
                  </p> 
                </div>

              <div class="col-12 col-md-6 col-xl-4 "> 
                      <div class="div_pr" style="min-height: 40%">
                          <img class="img-fluid margin-bottom-15" src="https://agora.xtec.cat/ceipespriu-granollers/wp-content/uploads/usu780/2022/11/IMG_20221118_103613.jpg" alt="Niu">
                      
                          <div class="div_btn">
                  
                      </div>
              </div>
                          <a class="btn_1" href="{{route('acogida.index')}}">Més Informació</a>
                                <p></p><p>El nostre niu es el millor! Inscriu'te</p><p>
                  </p></div>
              <div class="col-12 col-md-6 col-xl-4 "> 
                      <div class="div_pr" style="min-height: 40%">
              <img class="img-fluid margin-bottom-15" src="https://www.granollers.cat/sites/default/files/Escoles/dsc01862_cmyk.jpg" alt="Escola Espriu">
                          </div>
                          <a class="btn_1" href="https://agora.xtec.cat/ceip-espriu-bdn/">Més Informació</a>
                                <p></p><p><span class="HwtZe" lang="es"><span class="jCAhz ChMk0b"><span class="ryNqvb">Coneix la nostre escola!</span></span></span></p><p>
                                  
              </p></div>
          </div>
  </div>
  <footer>
    <br>
    <br>
    <p>   &copy; Tots els drets reservats: Ahnuar - Manel</p>
</footer>

@endsection