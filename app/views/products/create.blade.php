@extends('layouts.master')

@section('title')
@parent
:: Poster une annonce
@stop

@section('content')
</nav>

<h1>Poster une annonce</h1>

{{ HTML::ul($errors->all() )}}

{{ Form::open(array('url' => 'annonce')) }}

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

{{Form::submit('Créer', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}

@stop