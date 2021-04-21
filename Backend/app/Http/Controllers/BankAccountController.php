<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\FinancialOrganization;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response['bank_account'] = BankAccount::join('financial_organizations as fo', 'fo.id', 'bank_accounts.financial_organization_id')
                ->select('bank_accounts.*', 'fo.name')->get();

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response['fin_org'] = FinancialOrganization::all();
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $this->validate($request, [
            'account_name' => 'required',
            'financial_organization_id' => 'required',
            'account_no' => 'required|numeric',
            'branch' => 'required',
            'account_type' => 'required',
            'swift_code' => 'required',
            'route_no' => 'required|numeric',
        ]);

        try {

            $data = $request->all();

            if ($request->id){
                $product = BankAccount::where('id', $request->id)->first();
                $response['product'] = $product->update($data);
                $response['status'] = 1;
            }else{
                $response['product'] = BankAccount::create($data);
                $response['status'] = 1;
            }
            $response['message'] = 'Data saved successfully!!';

        }catch (\Exception $e){
            $response['message'] = response()->json($e->getMessage());
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $response['fin_org'] = FinancialOrganization::all();
            $response['formData'] = BankAccount::findOrFail($id);
            $response['status'] = 1;

        }catch (\Exception $e){

            $response['message'] = response()->json($e);
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = BankAccount::findOrFail($id);
            $data->delete();

            $response['message'] = 'Data deleted successfully!!';
            $response['status'] = 1;

        }catch (\Exception $e){
            $response['message'] = response()->json($e);
        }

        return response()->json($response);
    }
}
