<?php

use Illuminate\Support\Facades\Storage;

test('command outputs error if it cannot find a changelog file', function() {
    Storage::delete('CHANGELOG.md');

    $this->withoutExceptionHandling();
    $this->artisan('changelog:get-recent')
        ->expectsOutput('Cannot locate CHANGELOG.md file within project')
       ->assertExitCode(1);
});

test('command throws error message if it can\'t find a recent item', function() {
    Storage::put('CHANGELOG.md', Storage::get('tests/Mocks/Input/invalid-changelog.md'));

    $this->artisan('changelog:get-recent')
        ->expectsOutput('Could not find most recent changelog item.')
        ->assertExitCode(1);

    Storage::delete('CHANGELOG.md');
});

test('command outputs what is expected with changelog in standard format', function () {
    Storage::put('CHANGELOG.md', Storage::get('tests/Mocks/Input/standard-changelog.md'));

    $this->artisan('changelog:get-recent')
          ->expectsOutput(Storage::get('tests/Mocks/Output/standard-changelog.md'))
             ->assertExitCode(0);

    Storage::delete('CHANGELOG.md');
});

// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;

// class GetRecentChangelogItemTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
//     public function test_get_recent_changelog()
//     {
//         // Get a Mocked Changelog.

//         $this->artisan('changelog:get-recent')
//           // ->expectsOutput('')
//              ->assertExitCode(0);
//     }
// }
