<?php

use Inertia\Testing\AssertableInertia as Assert;

it('returns a successful response', function () {
    $response = $this->get(route('manage-excel-files.index'));

    $response->assertStatus(200);
});

it('see old rows', function () {
    $this->seed(\Database\Seeders\DatabaseSeeder::class);

    $response = $this->get(route('manage-excel-files.index'));

    $response->assertInertia(fn (Assert $page) => $page
        ->component('ManageExcelFiles/Index')
        ->has('entities', fn (Assert $page) => $page
            ->where('total', 51)
            ->etc()
        )
    );
});
