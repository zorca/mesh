<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadExcelFileRequest;
use App\Imports\RowsImport;
use App\Jobs\ExcelImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ManageExcelFiles extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ManageExcelFiles/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UploadExcelFileRequest $uploadExcelFileRequest)
    {
        $file = $uploadExcelFileRequest->file('file');
        $fileExtension = $file->extension();
        $uniqueID = Str::uuid()->toString();
        $path = $file->storeAs('files', $uniqueID . '.' . $fileExtension);

        ExcelImport::dispatch('imports_' . $uniqueID, $path);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
