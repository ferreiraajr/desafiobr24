<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::get();
//        $companies2 = Company::bitrixCompanyList();
        return Inertia::render('Company/IndexCompany', [
            'companies' => $companies
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => ['required'],
                'email' => ['required', 'email'],
            ]
        );

        try{
           $result =  Company::bitrixSetCompany(
                $request->title,
                $request->email
            );
             Company::create([
                'ID' => intval($result['result']),
                'TITLE' => $request->title,
                'EMAIL' => $request->email,
            ]);
            return redirect()->back()->with('success', 'Empresa cadastrada com sucesso');
        }catch(Exception $e){
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(Request $request,  $id)
    {
        try{
            $company = Company::findOrFail(intval($id));
            $company->update([
                'TITLE' => $request->title,
                'EMAIL' => $request->email
            ]);
            Company::bitrixUpdateCompany($request->title,$request->email,$id);
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
            $company = Company::findOrFail(intval($id));
            $company->delete();
            Company::bitrixDeleteCompany($id);
            return redirect()->back()->with('success', 'Empresa removida com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('erro', 'Erro ao remover empresa.');
        }
    }
}
