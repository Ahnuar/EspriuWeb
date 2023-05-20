@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-md-8 col-sm-12">
      <h2>Benvingut/da a EspriuWeb!</h2><br> 
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ URL::asset('/img/unnamed.jpg') }}" class="d-block w-100 carrusel">
            </div>
            <div class="carousel-item ">
              <img src="{{ URL::asset('/img/imagen_classe.jpg') }}" class="d-block w-100 carrusel" alt="First">
            </div>
            <div class="carousel-item">
              <img src="{{ URL::asset('/img/santJordi.jpeg') }}" class="d-block w-100 carrusel">
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
  </div><br>


  <div class="container">

    <div class="row">

      @if(isset($eventos) && count($eventos)>0)
            <div class="col-12 text-center my-5">
                <h2 class="">Events</h2>
                <p>Aquí podràs veure alguns dels nostres esdeveniments</p>
            </div>
            @php
                $num = 0;
                $num = 12/count($eventos);
                if($num < 4) $num = 4;
            @endphp
            @foreach ($eventos as $evento)
                <div class="col-12 col-md-6 col-lg-{{$num}}">
                    @include('eventos/block')
                </div>
            @endforeach

      @endif
    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 text-center mb-5">
        <h3>Més informació de la nostra escola</h3>
        <p>Aquí trobaràs més informació de la nostra escola </p>
      </div>
    </div>
    <div class="row margin-bottom-50">
      <div class="col-12 col-md-4"> 
          <img class="col-12 img-fluid margin-bottom-15" src="{{ URL::asset('/img/AFA_Logo.png') }}" alt="AFA">
          <a class="btn_1" href="https://afasalvadorespriu.blogspot.com/">Més Informació</a> 
          <p>Treballem amb l'ajuda de l' <strong><span style="color: #33cccc;">AFA</span>.</strong> De l'escola <strong><span style="color: #33cccc;">Salvador Espriu</span>.</strong></p>
      </div>
      <div class="col-12 col-md-4"> 
        <img class="col-12 img-fluid margin-bottom-15" src="https://agora.xtec.cat/ceipespriu-granollers/wp-content/uploads/usu780/2022/11/IMG_20221118_103613.jpg" alt="AFA">
        <a class="btn_1" href="{{route('acogida.index')}}">Més Informació</a> 
        <p>El nostre niu es el millor! Inscriu'te</p>
      </div>
      <div class="col-12 col-md-4"> 
        <img class="col-12 img-fluid margin-bottom-15" src="https://www.granollers.cat/sites/default/files/Escoles/dsc01862_cmyk.jpg" alt="AFA">
        <a class="btn_1" href="https://agora.xtec.cat/ceip-espriu-bdn/">Més Informació</a> 
        <p>Coneix la nostre escola!</p>
      </div>
    </div>
  </div>
  <footer>
    <br>
    <br>
    <p>   &copy; Tots els drets reservats: Ahnuar - Manel</p>
</footer>

@endsection