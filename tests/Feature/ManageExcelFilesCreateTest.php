<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

it('returns a successful response', function () {
    $response = $this->get(route('manage-excel-files.create'));

    $response->assertStatus(200);
});

it('can upload excel files', function () {
    Storage::fake('files');

    $file = UploadedFile::fake()->create(
        'test.xls',
        128,
        'application/excel',
    );

    $response = $this->post(route('manage-excel-files.store'), [
        'file' => $file,
    ]);

    $response->assertValid();

    $file = UploadedFile::fake()->create(
        'test.xlsx',
        128,
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    );

    $response = $this->post(route('manage-excel-files.store'), [
        'file' => $file,
    ]);

    $response->assertValid();
});

it('cannot upload jpeg or js file', function () {
    Storage::fake('files');

    $file = UploadedFile::fake()->create(
        'test.jpg',
        128,
        'image/jpeg',
    );

    $response = $this->post(route('manage-excel-files.store'), [
        'file' => $file,
    ]);

    $response->assertInvalid();

    $file = UploadedFile::fake()->create(
        'test.js',
        128,
        'text/javascript',
    );

    $response = $this->post(route('manage-excel-files.store'), [
        'file' => $file,
    ]);

    $response->assertInvalid();
});
