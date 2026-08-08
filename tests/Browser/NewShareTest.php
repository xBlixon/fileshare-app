<?php

use App\Models\File;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ShareCreate;

function collectFiles(string ...$files): string
{
    $output = '';
    foreach ($files as $key => $file) {
        $output .= base_path($file);

        if ($key + 1 != count($files)) {
            $output .= "\n";
        }
    }

    return $output;
}

it('creates a new share', function () {
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($user) {
        $fileList = collectFiles(
            'tests/Browser/Fixtures/upload_file1',
            'tests/Browser/Fixtures/upload_file2',
        );

        $title = 'Test title';
        $description = 'Test description';

        $browser->loginAs($user)
            ->visit(new ShareCreate)
            ->type('@title', $title)
            ->type('@description', $description)
            ->attach('@files', $fileList)
            ->screenshot('new-share-added-files')
            ->press('@submit')
            ->waitForText($title, 10)
            ->screenshot('new-share-submitted');
    });

    $this->assertDatabaseCount(File::class, 2);
});
