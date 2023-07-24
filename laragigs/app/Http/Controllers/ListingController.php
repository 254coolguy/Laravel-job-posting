<?php

namespace App\Http\Controllers;

use index;
use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listing
   public function index(){
    return view('listings.index',[
        'listings'=> Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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
       $formFields =$request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('listings', 'company')],
        'location' => 'required',
        'email' => 'required|email',
        'tags'=>'required',
        'description' => 'required'
       ]);


       if($request->hasFile('logo')){
        $formFields['logo'] = $request->file('logo')->store('logos', 'public');

       }

       $formFields['user_id']=auth()->id();

       Listing::create($formFields);

       //session for pop up message of success


       return redirect('/')->with('message', 'Listing created succesfuly');
    }

    //show Edit form
    public function edit(Listing $listing){
        
        return view('listings.edit', ['listing'=>$listing]);
    }

    // //Update form
    public function update(Request $request,Listing $listing){
        //make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unathorized Action');
        }
        $formFields =$request->validate([
         'title' => 'required',
         'company' => ['required'],
         'location' => 'required',
         'email' => 'required|email',
         'tags'=>'required',
         'description' => 'required'
        ]);
 
 
        if($request->hasFile('logo')){
         $formFields['logo'] = $request->file('logo')->store('logos', 'public');
 
        }
        $listing->update($formFields);
 
        //session for pop up message of success
 
 
        return back()->with('message', 'Listing updated succesfuly');
     }
     //delete Listing
     public function destroy(Listing $listing){
        //Make sure logged in User is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unathorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');


     }
     //manage Listings
    public function manage()
{
    return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
}

}
