@extends('layouts.master')

@section('title')
@parent
:: Editer
@stop

@section('content')
<div class="page-header">

    @if ( Auth::guest() )
    <h2>Tu n'as rien à faire là :)</h2>

    @else

    <h2>Editer <strong>{{ $annonce->title }}</strong></h2>

    <p class="bg-danger">{{ HTML::ul($errors->all()) }}</p>

    {{ Form::model($annonce, array('route' => array('annonce.update', $annonce->id), 'method' => 'PUT')) }}

    <div class="form-group">
    {{Form::label('categorie','Catégorie')}}
    {{ Form::select('categorie', array(
    'meubles' => 'Meubles',
    'electronique' => 'Electronique',
    'maison' => 'Maison',
    'games' => 'Jeux Vidéos',
    'litterature' => 'Littérature',
    'vetements' => 'Vêtements'
    ), null, array('class' => 'form-control')) }}
</div>

    <div class="form-group">
    {{Form::label('title','Titre')}}
    {{Form::text('title', null,array('class' => 'form-control'))}}
</div>

<div class="form-group">
    {{Form::label('photo','Photo')}}
    {{Form::text('photo', null,array('class' => 'form-control'))}}
</div>

<div class="form-group">
    {{Form::label('description','Description')}}
    {{Form::textarea('description', null,array('class' => 'form-control'))}}
</div>
<div class="form-group">
    {{Form::label('price','Prix')}}
    {{Form::text('price', null,array('class' => 'form-control'))}}
</div>

    {{ Form::submit('Editer', array('class' => 'btn btn-primary')) }}
    <a href="javascript:window.history.go(-1)" class="btn btn-small btn-default">Annuler</a>

    {{ Form::close() }}

    
    @endif



</div>




@stop