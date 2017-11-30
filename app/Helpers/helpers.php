<?php

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
 * @param  \Illuminate\Database\Eloquent\Model  $model
 * @param  string  $action
 * @return string
 */
function model_route(\Illuminate\Database\Eloquent\Model $model, string $action) {
    $route_name = str_plural(model_name($model)) . '.' . $action;

    return ($action !== 'index' && $action !== 'create' && $action !== 'store')
        ? route($route_name, $model->id)
        : route($route_name);
}

/**
 * Get a model name.
 *
 * @param  \Illuminate\Database\Eloquent\Model  $model
 * @return string
 */
function model_name(\Illuminate\Database\Eloquent\Model $model) {
    return strtolower(class_basename($model));
}
