<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SerialNumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \App\Http\Requests\StoreSerialNumberRequest;
use \App\Http\Requests\UpdateSerialNumberRequest;
use \App\Http\Requests\MassDestroySerialNumberRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SerialNumberController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('serial_number_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serialnumbers = SerialNumber::all();

        return view('admin.serialnumbers.index', compact('serialnumbers'));
    }

    public function create()
    {
        abort_if(Gate::denies('serial_number_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serialnumbers.create');
    }


    public function store(StoreSerialNumberRequest $request)
    {
        $customer = SerialNumber::create($request->all());
       
        return redirect()->route('admin.serialnumbers.index');
    }

    public function edit(SerialNumber $serialnumber)
    {
        abort_if(Gate::denies('serial_number_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serialnumbers.edit', compact('serialnumber'));
    }


    public function update(UpdateSerialNumberRequest $request, SerialNumber $serialnumber)
    {
        $serialnumber->update($request->all());

        return redirect()->route('admin.serialnumbers.index');
    }

    public function show(SerialNumber $serialnumber)
    {
        abort_if(Gate::denies('serial_number_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serialnumbers.show', compact('serialnumber'));
    }

    public function destroy(SerialNumber $serialnumber)
    {
        abort_if(Gate::denies('serial_number_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serialnumber->delete();

        return back();
    }


    public function massDestroy(MassDestroySerialNumberRequest $request)
    {
        SerialNumber::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
