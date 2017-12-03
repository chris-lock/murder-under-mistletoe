<?php

use \Illuminate\Database\Eloquent\Model;
use App\Models\Character;

/**
 * Get a validator for an incoming registration request.
 *
 * @param  string  $path
 * @param  string  $class
 * @return string
 */
function active_path_class(string $path, string $class = 'active') {
    return Request::is("$path*")
        ? " $class"
        :  '';
}

/**
 * Get a route for a model.
 *
 * @param  Model  $model
 * @param  string  $action
 * @return string
 */
function model_route(Model $model, string $action) {
    $route_name = str_plural(model_name($model)) . '.' . $action;

    return ($action !== 'index' && $action !== 'create' && $action !== 'store')
        ? route($route_name, $model->id)
        : route($route_name);
}

/**
 * Get a model name.
 *
 * @param  Model  $model
 * @return string
 */
function model_name(Model $model) {
    return strtolower(class_basename($model));
}

function mailto_character(Character $character) {
    return mail_with_message(
        $character,
        "Here's a link to your character for Saturday night, "
    );
}

function mailto_relationships(Character $character) {
    return mail_with_message(
        $character,
        "Here's a link to additional information about your character and their relationships for Saturday night, "
    );
}

function mail_with_message(Character $character, string $message) {
    $character_name = $character->full_name;
    $email = $character->email;
    $subject = config('app.name', 'Murder Under Mistletoe') . ' - Character';
    $url = url("/welcome/{$character->slug}");

    $body = rawurlencode("${message}{$character_name} - {$url}. Please do not share this or discuss it with other guests as it may ruin the mystery for them.");

    return "mailto:{$email}?subject={$subject}&body={$body}";
}
