<?php

use System\UID\UID;

define('STEP1', 1);
define('STEP2', 2);
define('STEP3', 3);
define('STEP4', 4);

/**
 * Get default value to array key
 * @param array $arr
 * @param $key
 * @param null $default
 * @return mixed|null
 */
function __get(array $arr, $key, $default = null)
{
    return isset($arr[$key]) ? $arr[$key] : $default;
}

function value_cleanse($numberFormatted)
{
    return floatval(str_replace(',', '', $numberFormatted));
}

function value_format($value, $precision = 2)
{
    return number_format(round(value_cleanse($value)), $precision);
}


/**
 * Current user
 * @return \Illuminate\Contracts\Auth\Authenticatable|null [User] [User model return]
 */
function user()
{
    if (auth()->check()) {
        return auth()->user();
    }
    return null;
}

/**
 * @return $tenant_id|null
 */
function tenant()
{
    if (user()) {
        return user()->tenant_id;
    }
    return null;
}

/**
 * @param $fully_qualified_namespace = fully qualified namespace of the constant interface
 * @param bool|false $to_lower = change to lower case of not
 * @return array
 */
function constants($fully_qualified_namespace, $to_lower = false)
{
    $reflectedClass = new \ReflectionClass($fully_qualified_namespace);
    $constants = $reflectedClass->getConstants();
    if ($to_lower) {
        return array_change_key_case($constants, CASE_LOWER);
    }
    return $constants;
}

/**
 * @param $fully_qualified_namespace = fully qualified namespace of the constant interface
 * @param $key
 * @return array
 */
function get_constant_value($key, $fully_qualified_namespace)
{
    $constants = constants($fully_qualified_namespace, true);
    return $constants[$key];
}

/**
 * @param $value
 * @param $fully_qualified_namespace
 * @return mixed|null
 */
function get_constant_string($value, $fully_qualified_namespace)
{
    try {
        return array_flip(constants($fully_qualified_namespace, true))[$value];
    } catch (\Exception $e) {
        return 0;
    }
}

function constant_strings($fully_qualified_namespace)
{
    try {
        $list = [];
        $constants = constants($fully_qualified_namespace);

        foreach ($constants as $value) {
            $list[] = $value;
        }

        return $list;
    } catch (\Exception $e) {
        return [];
    }
}

/**
 *  Return only top value of an array
 * @param Array
 * @param $nested_level
 * @return mixed|null
 */
function unwrap($data, $nested_level = 2)
{
    if ($nested_level == 1) {
        return current($data);
    }
    return current(unwrap($data, $nested_level - 1));
}

function new_version($model, $reference = "ancestor_id")
{
    if (empty($model->$reference)) {
        $model->$reference = $model->id;
    }
    $version = $model->where($reference, $model->$reference)->max('version');
    return $version + 1;
}

/**
 * Convert array to object
 * @param array $arr
 * @param bool $assoc convert to associative array
 * @return mixed
 */

function to_object(array $arr)
{
    return json_decode(json_encode($arr), false);
}


/**
 * Convert object(s) to array
 * @param mixed $object stdClass $object or collection of stdClass $objects
 * @return mixed
 */
function to_array($object)
{
    return json_decode(json_encode($object), true);
}

/**
 * Generate Password
 * @return string
 */
function generate_password()
{
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);
}

/**
 * Set default value if required value is not set
 * @param $original_value
 * @param $default_value
 * @return mixed
 */
function default_value($original_value, $default_value = null)
{
    return isset($original_value) ? $original_value : $default_value;
}

/**
 * Generate random string
 * @param int $length
 * @return string
 */
function openssl_random_key($length = 16)
{
    $bytes = openssl_random_pseudo_bytes($length, $cstrong);
    return bin2hex($bytes);
}

function remove_file($file)
{
    unlink($file);
}

function uid($value)
{
    return app(UID::class)->generate($value);
}

function unique_invoice_id($value, $prefix = 'CCF-')
{
    return reference_generator($value, $prefix);
}

function reference_generator($value, $prefix)
{
    $prefix = $prefix . date('Ymd') . '-';
    if (empty($value)) {
        $value = 99999;
    }
    ++$value;
    return $prefix . $value;
}

function isActiveRoute($route, $output = "nav-link-selected")
{
    if(is_array($route)){

        foreach($route as $ro){
            if (Route::currentRouteName() == $ro){
                return $output;
            }
        }

    }else{
        if (Route::currentRouteName() == $route) return $output;
    }
    return null;
}

function isActiveUrl($input, $output = "nav-link-selected"){
    if (strpos(Request::url(), $input) !== false) {
        return  $output;
    }
}

function getLocationAvailableStates($locations){

    $list = [];

    if(count($locations)){
        foreach ($locations as $location){
            if($location){
                $list[] = $location['states_id'];
            }
        }
    }

    return $list;
}

function countActualDataList( $data_list){

    $count =0;
    if($data_list){
        $count = count(array_filter($data_list, function($var){ return !is_null($var); } ));
    }
    return $count;
}