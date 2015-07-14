@extends('layouts.master')

@section('title')
@parent
:: Home
@stop

@section('content')


@if ( Auth::guest() )
<h2>Adieu !</h2>

@else

<div class="col-md-8">
    <h2>{{ $product->title }}</h2>
    <p><i>Ajouté le {{ $product->created_at }}</i></p>

    <p><img src="../{{ $product->photo }}" class="img-responsive img-rounded" alt="photo"></p>

    <pre> {{ $product->description }}</pre>

</div>


<div class="col-md-4 panel-group">


    <div class="text-center">
        <h1 class="jumbotron">{{ $product->price }}€</h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Contacter <strong>{{ $product->username }}</strong></h3>
        </div>
        <div class="panel-body">
            <p><strong>Département : </strong>{{ $user->departement }}</p>
            <p><strong>Email : </strong>{{ $user->email }}</p>
        </div>
    </div>
</div>

@endif


<br><br>





@stop