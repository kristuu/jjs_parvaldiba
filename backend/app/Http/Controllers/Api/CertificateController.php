<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateRequest;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function index()
    {
        return Certificate::all();
    }

    public function store(CertificateRequest $request)
    {
        return Certificate::create($request->validated());
    }

    public function show(Certificate $certificate)
    {
        return $certificate;
    }

    public function update(CertificateRequest $request, Certificate $certificate)
    {
        $certificate->update($request->validated());

        return $certificate;
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return response()->json();
    }
}
