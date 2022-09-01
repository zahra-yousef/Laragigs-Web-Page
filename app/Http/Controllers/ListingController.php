<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Session\Session;


class ListingController extends Controller
{
    //show all listing
    public function index(Request $request){
        // dd(request('tag'));
        return view('listings.index',[
            'listings' => Listing::latest()
            ->filter(request(['tag','search']))->paginate(6) //simple only show pre and next
        ]);
    }


    //show single listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //show create form
    public function create(){
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request){
        //dd($request->all); not working
        // dd($request->file('logo')->store()); 
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique ('listings', 'company')] ,
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        Listing::create($formFields);
        return redirect('/')->with('message','Listing craeted successfully!');
    }

    //Show Edit Form 
    public function edit(Listing $listing){
        // dd($listing->title);
        return view('listings.edit',['listing' => $listing]);
    }

    //Update listing
    public function update(Request $request, Listing $listing){
        //dd($request->all); not working
        // dd($request->file('logo')->store()); 
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required' ,
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);
        
        return back()->with('message','Listing updated successfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message','Listing Deleted Successfully');
    }
}