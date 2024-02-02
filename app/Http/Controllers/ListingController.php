<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(){
        return view('listings.index',[
            'Listings'=> Listing::latest()->filter(request(['tag','search']))->simplePaginate(6)
            ]
        );
    }
    public function show(Listing $Listing){
        return view('listings.show',[
            'Listing'=> $Listing
        ]);
    }
    public function create(){
        return view('listings.create');
    }
    public function store(Request $request){
       $formFields = $request->validate([
        'company' => ['required',Rule::unique('listings','company')],
        'title'=> 'required',
        'location'=>'required',
        'email'=>['required','email'],
        'website'=>'required',
        'tags'=>'required',
        'description'=>'required',
       ]);
       if($request->hasFile('logo')){
        $formFields['logo']=$request->file('logo')->store("logos","public");
       }
       $formFields['user_id'] = auth()->id();
       Listing::create($formFields);
       return redirect('/')->with('message','The listing has been created successfully!');
    }
    public function edit(Listing $Listing){
        return view('listings.edit',['listing'=>$Listing]);
    }
    public function update(Request $request,Listing $Listing){

        // Make sure
        if($Listing->user_id != auth()->id()){
            abort(403, "Unauthorized Action");
        }

        $formFields = $request->validate([
         'company' => 'required',
         'title'=> 'required',
         'location'=>'required',
         'email'=>['required','email'],
         'website'=>'required',
         'tags'=>'required',
         'description'=>'required',
        ]);
        if($request->hasFile('logo')){
         $formFields['logo']=$request->file('logo')->store("logos","public");
        }
        $Listing->update($formFields);
        return back()->with('message','The listing has been updated successfully!');
    }

    public function destroy(Listing $Listing){
         // Make sure
         if($Listing->user_id != auth()->id()){
            abort(403, "Unauthorized Action");
        }
        
        $Listing->delete();
        return redirect("/")->with('message','listing deleted successfully!');
    }

    public function manage(){
        return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }
}
