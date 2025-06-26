<?php

test('env is correctly configured for testing', function () {
    dump([
        'APP_ENV' => app()->environment(),
        'DB_CONNECTION' => config('database.default'),
        'DB_DATABASE' => config('database.connections.sqlite.database'),
    ]);

    expect(app()->environment())->toBe('testing');
    expect(config('database.default'))->toBe('sqlite');
    expect(config('database.connections.sqlite.database'))->toBe(':memory:');
});
