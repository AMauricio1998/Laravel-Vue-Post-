<?php

namespace App\Http\Controllers;

use auth;
use App\Contact;
use App\Helpers\CustomUrl;
use App\ContactImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin']);
    }
    
    public function index()
    {
        $contacts = Contact::orderBy('created_at','desc')
            ->paginate(5);

        return view('dashboard.contact.index',['contacts' => $contacts]);
    }

    
     public function show(Contact $contact)
     {
        //  $contact = Contact::findOrFail($contact);

             return view("dashboard.contact.show", ["contact" => $contact]);
     }


     public function destroy(Contact $contact)
     {
         $contact->delete();
         return back()->with('status', 'Contact borrado con exito!');
     }
}
