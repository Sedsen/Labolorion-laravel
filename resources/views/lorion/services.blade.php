@extends('lorion/template')

@section('description')
<div class="row">
    <div class="container">
        <h1 class="title text-center" style="font-weight: 200;font-size:40px;color:#525252;">
            NOS SERVICES</h1>
            <hr>
        <div style="font-size:15px;line-height:1.9;">
            <?php echo $entreprise->services; ?>
        </div>
    </div>
    
</div>
    
@endsection