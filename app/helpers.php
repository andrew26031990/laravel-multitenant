<?php

if (! function_exists('user')) {
    function userAuthenticated() {
        return auth()->user();
    }
}
