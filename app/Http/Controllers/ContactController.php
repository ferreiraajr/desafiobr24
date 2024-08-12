<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::get();
        $contacts = Contact::get();
        return Inertia::render('Contact/IndexContact', [
            'contacts' => $contacts,
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => ['required'],
                'last_name' => ['required'],
            ]
        );

        try{
            $result =  Contact::bitrixSetContact(
                $request->name,
                $request->last_name
            );
            Contact::create([
                'ID' => intval($result['result']),
                'NAME' => $request->name,
                'LAST_NAME' => $request->last_name,
            ]);
            return redirect()->back()->with('success', 'Contato cadastrado com sucesso');
        }catch(Exception $e){
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $contact = Contact::findOrFail(intval($id));
            $contact->update([
                'NAME' => $request->name,
                'LAST_NAME' => $request->last_name
            ]);
            $teste = Contact::bitrixUpdateContact($request->name,$request->last_name,$id);
            return redirect()->back()->with('success', 'Empresa atualizada com sucesso');
        }
        catch(Exception $e){
            return redirect()->back()->with('erro', 'Erro ao editar empresa.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $contact = Contact::findOrFail(intval($id));
            $contact->delete();
            Contact::bitrixDeleteContact($id);
            return redirect()->back()->with('success', 'Contato removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', 'Erro ao remover contato.');
        }
    }
}
