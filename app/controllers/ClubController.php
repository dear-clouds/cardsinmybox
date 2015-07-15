<?php

class ClubController extends BaseController {

	public function index()
	{
		$clubs = DB::table('clubs')
		->orderBy('created_at', 'desc')
		->paginate(6);

		return View::make('clubs.index', compact('clubs'));
	}

	public function create()
	{
		return View::make('clubs.create');
	}


	public function store()
	{

		$rules = array(
			'title'				=> 'required',
			'slug'				=> 'required|unique:clubs',
			'access'   			=> 'required'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('club/create')
			->withErrors($validator)
			->withInput(Input::except('password'));
		}
		else {


			$club = new Club;
			$club->title      		= Input::get('title');
			$club->slug 			= Input::get('slug');
			$club->access 			= Input::get('access');
			$club->description 		= Input::get('description');
			$club->admin_id 		= Auth::user()->id;
			$club->categorie_id  	= Input::get('categorie');
			$club->availability		= Input::get('availability');
			$club->save();

			$file = Input::file('file');
			$slug = Input::get('slug');
			$destinationPath = 'public/images/clubs/' . $slug;
			$filename = str_random(20);
			$extension = $file->getClientOriginalExtension(); 
			$type = $file->getMimeType();
			$size = Input::file('file')->getSize();
			$upload_success = Input::file('file')->move($destinationPath, $filename . '.' . $extension);

			if( $upload_success ) {
				Image::create(['name'       => $filename,
					'user_id'    			=> Auth::user()->id,
					'club_slug'				=> $slug
					'categorie'				=> 'clubs'
					'url'        			=> 'images/club/' . $slug . $filename . '.' . $extension,
					'size'					=> $size,
					'extension'   			=> $file->getClientOriginalExtension(),
					'type'					=> $type
					]);
			}

			return Redirect::to('')->with('success', 'Your club has been created.');
		}
	}


	public function show($id)
	{
		$club = club::find($id);

		return View::make('clubs.show', compact('club'));
	}


	public function edit($id)
	{

		$club = club::find($id);

		if ($club) 
		{
			return View::make('clubs.edit')
			->with('club', $club);
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
			return Redirect::to('club/' . $id . '/edit')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} 
		else 
		{
			$club = club::find($id);
			$club->title      	= Input::get('title');
			$club->images_id 	= Input::get('images_id');
			$club->price 		= Input::get('price');
			$club->description 	= Input::get('description');
			$club->user_id 		= Auth::user()->id;
			$club->categorie_id  = Input::get('categorie');
			$club->availability	= Input::get('availability');
			$club->save();



			return Redirect::to('')->with('success', 'Votre club a bien été mise à jour.');
		}
	}


	public function destroy($id)
	{

		$club = club::find($id);
		$path = $club->url;

		File::delete(public_path() . '/' . $path);
		$club->delete();

		return Redirect::to('profile')->with('success', 'Fichier supprimé.');
	}



	public function postSearch()
	{
		$results = DB::table('clubs');

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

		return View::make('clubs.search', compact('results'));
	}



	public function admin()
	{
		$clubs = club::all();
		return View::make('clubs.admin', compact('clubs'));
	}





}