<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(5);
        return view('pages.contacts.index', compact('contacts'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required',
           'phone_number' => 'required',
        ]);
        Contact::create($request->all());
        return back()->with('success', 'Contact Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('pages.contacts.edit', compact('contact'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);
        Contact::find($id)->update($request->all());
        return redirect()->route('contact.index')->with('success', 'Contact updated Successfully');
    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Contact::find($id)->delete();
        return back()->with('success', 'Contact deleted Successfully');
    }
}
