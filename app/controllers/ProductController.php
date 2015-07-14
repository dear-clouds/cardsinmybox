<?php

class ProductController extends BaseController {

	public function index()
	{
		$products = DB::table('products')
		->orderBy('created_at', 'desc')
		->paginate(6);

		return View::make('products.index', compact('products'));
	}

	public function create()
	{
		return View::make('products.create');
	}


	public function store()
	{

		$rules = array(
			'title'				=> 'required',
			'description'		=> 'required',
			'price'   			=> 'required',
			'availability'		=> 'required'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('product/create')
			->withErrors($validator)
			->withInput(Input::except('password'));
		}
		else {


			$product = new Product;
			$product->title      	= Input::get('title');
			$product->images_id 	= Input::get('images_id');
			$product->price 		= Input::get('price');
			$product->description 	= Input::get('description');
			$product->user_id 		= Auth::user()->id;
			$product->categorie_id  = Input::get('categorie');
			$product->availability	= Input::get('availability');
			$product->save();

			return Redirect::to('')->with('success', 'Votre produit a bien été ajouté.');
		}
	}


	public function show($id)
	{
		$product = Product::find($id);

		return View::make('products.show', compact('product'));
	}


	public function edit($id)
	{

		$product = product::find($id);

		if ($product) 
		{
			return View::make('products.edit')
			->with('product', $product);
		}
		else
		{
			return Redirect::to('')->with('error', 'Vous ne pouvez pas faire ça.');
		}
	}


	public function update($id)
	{
		$rules = array(
			'title'				=> 'required',
			'description'		=> 'required',
			'price'   			=> 'required',
			'availability'		=> 'required'
			);
		$validator = Validator::make(Input::all(), $rules);


		if ($validator->fails()) {
			return Redirect::to('product/' . $id . '/edit')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} 
		else 
		{
			$product = Product::find($id);
			$product->title      	= Input::get('title');
			$product->images_id 	= Input::get('images_id');
			$product->price 		= Input::get('price');
			$product->description 	= Input::get('description');
			$product->user_id 		= Auth::user()->id;
			$product->categorie_id  = Input::get('categorie');
			$product->availability	= Input::get('availability');
			$product->save();



			return Redirect::to('')->with('success', 'Votre product a bien été mise à jour.');
		}
	}


	public function destroy($id)
	{

		$product = Product::find($id);
		$path = $product->url;

		File::delete(public_path() . '/' . $path);
		$product->delete();

		return Redirect::to('profile')->with('success', 'Fichier supprimé.');
	}



	public function postSearch()
	{
		$results = DB::table('products');

		if(Input::get('keywords'))
			$results->where('title', 'LIKE', '%' . Input::get('keywords') . '%')
					->orWhere('description', 'LIKE', '%' . Input::get('keywords') . '%');

		if(Input::get('categorie'))
			$results->where('categorie', '=', Input::get('categorie'));

		if(Input::get('departement'))
			$results->where('departement', 'LIKE', '%' . Input::get('departement') . '%');

		if(Input::get('price'))
			$results->where('price', '<=', Input::get('price'));

		$results = $results->get();

		return View::make('products.search', compact('results'));
	}



	public function admin()
	{
		$products = Product::all();
		return View::make('products.admin', compact('products'));
	}





}