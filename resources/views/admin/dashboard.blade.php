@extends('lorion/template')

 @section('content')


 <!-- Icon Cards-->
 <div class="row">
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-primary o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-layer-group"></i>
         </div>
         <div class="mr-5">{{ $nombre_domaine }} Domaines</div>
       </div>
       <a class="card-footer text-white clearfix small z-1" href="{{ url('admin/domaine') }}">
         <span class="float-left">Voir Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-warning o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-list"></i>
         </div>
         <div class="mr-5">{{ $nombre_sous_domaine }} Sous-domaines</div>
       </div>
       <a class="card-footer text-white clearfix small z-1" href="{{ url('admin/sous_domaine') }}">
         <span class="float-left">Voir Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-success o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-shopping-cart"></i>
         </div>
         <div class="mr-5">{{ $nombre_produit }} Produits</div>
       </div>
       <a class="card-footer text-white clearfix small z-1" href="{{ url('admin/produit') }}">
         <span class="float-left">Voir Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
   <div class="col-xl-3 col-sm-6 mb-3">
     <div class="card text-white bg-danger o-hidden h-100">
       <div class="card-body">
         <div class="card-body-icon">
           <i class="fas fa-fw fa-comments"></i>
         </div>
         <div class="mr-5">Discussion</div>
       </div>
       <a class="card-footer text-white clearfix small z-1" href="{{ url('chat') }}">
         <span class="float-left">Voir Details</span>
         <span class="float-right">
           <i class="fas fa-angle-right"></i>
         </span>
       </a>
     </div>
   </div>
 </div>








@endsection
<!--<div class="row">
        <div class="card col-lg-2 domaine" style="margin-left:20px;">
            <div class="card-body">
                <p class="card-text text-right h5"> <strong> Domaine </strong><br>
                    {{ $nombre_domaine }}
                </p>
                <a href="{{ url('admin/domaine') }}" class="btn btn-primary" style="position:absolute;bottom:2%;">Domaine</a>
            </div>
        </div>
        <div class="card col-lg-2 domaine">
            <div class="card-body">
                <p class="card-text text-right h5"> <strong> Sous-domaine </strong><br>
                    {{ $nombre_sous_domaine }}
                </p>
            <a href="{{ url('admin/sous_domaine') }}" class="btn btn-primary" style="position:absolute;bottom:2%;">Sous-domaine</a>
            </div>
        </div>
        <div class="card col-lg-2 domaine">
            <div class="card-body">
                <p class="card-text text-right h5"> <strong> Produits </strong><br>
                    {{ $nombre_produit }}
                </p>
            <a href="{{ url('admin/produit') }}" class="btn btn-primary" style="position:absolute;bottom:2%;">Produits</a>
            </div>
        </div>
        <div class="card col-lg-2 domaine">
            <div class="card-body">
                <p class="card-text text-right h5"> <strong> Discussion </strong><br>
                    Nombre
                </p>
                <a href="#" class="btn btn-primary" style="position:absolute;bottom:2%;">Discussion</a>
            </div>
        </div>
    </div> -->
