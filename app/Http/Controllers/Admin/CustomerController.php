<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \App\Http\Requests\StoreCustomerRequest;
use \App\Http\Requests\UpdateCustomerRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;
class CustomerController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::all();

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customers.create');
    }


    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());
       
        return redirect()->route('admin.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->route('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        Customer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    /*
    public function insert(Request $request)
    {
        $errormsg ="";
        $flgerror = false;

        if(!$request->has('company_name') || $request->company_name == null || $request->company_name == ''){
            $flgerror = true;
            $errormsg = $errormsg."Campo 'company_name' non compilato  ";
        }
        
        if($flgerror == true){
            return response()->json(
                    [
                        'Response'=>[

                         ],
                        "Status" => [
                            "ReturnStatus" => "KO",
                            "StatusMessage" => "Si sono verificati i seguenti errori: ".$errormsg
                        ]
                    ], 200);
        }
        try{
            $tmpuserU=Customer::where('company_name',$request->company_name)->first();
            if($tmpuserU!=NULL)
            {
                return response()->json(
                    [

                        "Status" => [
                            "ReturnStatus" => "KO",
                            "StatusMessage" => "Impossibile inserire cliente, cliente presente in Db"
                        ]
                    ], 200);

            }
            else
            {
                $user = Customer::create([
                            "company_name"              => $request->company_name,
                            "address"                   => $request->address,
                            "city"                      => $request->city,
                            "country"                   => $request->country,
                            "zip"                       => $request->zip,
                            "phone"                     => $request->phone,
                            "email"                     => $request->email,
                            "contact_person"            => $request->contact_person,
                            "phone_contact_person"      => $request->phone_contact_person,
                            'email_contact_person'      => $request->email_contact_person
                           
                    ]);

                return response()->json(
                    [
                        "Response" => [
                            "company_name"              => $request->company_name,
                            "address"                   => $request->address,
                            "city"                      => $request->city,
                            "country"                   => $request->country,
                            "zip"                       => $request->zip,
                            "phone"                     => $request->phone,
                            "email"                     => $request->email,
                            "contact_person"            => $request->contact_person,
                            "phone_contact_person"      => $request->phone_contact_person,
                            'email_contact_person'      => $request->email_contact_person
                        ],
                        "Status" => [
                            "ReturnStatus" => "OK",
                            "StatusMessage" => "Operazione riuscita."
                        ]
                    ], 200);

            }

        }
        catch(\Exception $e)
        {
            return response()->json(
                [
                    'Response'=>[

                     ],
                    "Status" => [
                        "ReturnStatus" => "KO",
                        "StatusMessage" => "Errore - Exception: ".$e
                    ]
                ], 200);

        }


    }

    public function update(Request $request, Customer $customer)
    {
        try
        {
            if (Customer::where('id', $customer->id)->exists())
            {
                return response()->json(
                    [
                        "Response" => [
                            "company_name"              => $request->company_name,
                            "address"                   => $request->address,
                            "city"                      => $request->city,
                            "country"                   => $request->country,
                            "zip"                       => $request->zip,
                            "phone"                     => $request->phone,
                            "email"                     => $request->email,
                            "contact_person"            => $request->contact_person,
                            "phone_contact_person"      => $request->phone_contact_person,
                            'email_contact_person'      => $request->email_contact_person
                        ],
                        "Status" => [
                            "ReturnStatus" => "KO",
                            "StatusMessage" => "Impossibile modificare cliente, cliente non presente in Db"
                        ]
                    ], 200);

            }
            else
            {
                $customer->update([
                            "company_name"              => $request->company_name,
                            "address"                   => $request->address,
                            "city"                      => $request->city,
                            "country"                   => $request->country,
                            "zip"                       => $request->zip,
                            "phone"                     => $request->phone,
                            "email"                     => $request->email,
                            "contact_person"            => $request->contact_person,
                            "phone_contact_person"      => $request->phone_contact_person,
                            'email_contact_person'      => $request->email_contact_person
                           
                    ]);

                return response()->json(
                    [
                        "Response" => [
                            "company_name"              => $request->company_name,
                            "address"                   => $request->address,
                            "city"                      => $request->city,
                            "country"                   => $request->country,
                            "zip"                       => $request->zip,
                            "phone"                     => $request->phone,
                            "email"                     => $request->email,
                            "contact_person"            => $request->contact_person,
                            "phone_contact_person"      => $request->phone_contact_person,
                            'email_contact_person'      => $request->email_contact_person
                        ],
                        "Status" => [
                            "ReturnStatus" => "OK",
                            "StatusMessage" => "Operazione riuscita."
                        ]
                    ], 200);

            }

        }
        catch(\Exception $e)
        {
            return response()->json(
                [
                    'Response'=>[

                     ],
                    "Status" => [
                        "ReturnStatus" => "KO",
                        "StatusMessage" => "Errore - Exception: ".$e
                    ]
                ], 200);

        }


    }
    
    */
}
