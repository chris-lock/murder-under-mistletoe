<?php

/**
 * Get a validator for an incoming registration request.
 *
 * @param  string   $path
 * @param  string   $class
 * @return string
 */
function activePathClass(string $path, string $class = 'active') {
    return Request::is("$path*")
        ? " $class"
        :  '';
}
