<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadExcelFileRequest;
use App\Jobs\ExcelImport;
use App\Models\Row;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ManageExcelFiles extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entities = Row::paginate(10);
        return Inertia::render('ManageExcelFiles/Index', [
            'entities' => $entities->setCollection($entities->groupBy('date')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ManageExcelFiles/Create');
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

    /**
     * Remove resources from storage.
     */
    public function destroyAll(Filesystem $filesystem): \Illuminate\Http\RedirectResponse
    {
        Row::query()->delete();
        $filesystem->cleanDirectory(storage_path('files'));
        return back();
    }
}
