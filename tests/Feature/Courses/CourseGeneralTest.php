<?php

test('unauthenticated users are redirected to login when entering the url', function () {
    $this->get('/courses')->assertRedirect('/login');
});
