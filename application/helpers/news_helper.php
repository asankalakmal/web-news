<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('imageNameGenerate')) {

     /**
     * Upload image name rename process
     */
    function imageNameGenerate($id, $name) {
    	$path_info = pathinfo($name);
        return $id.'_'.time().'.'.$path_info['extension'];
    }   
}

if (!function_exists('termNameToKey')) {

    /**
     * Name convert to key (replacing space to underscro)
     */
	function termNameToKey($name) {
		return strtolower(str_replace(' ','-', $name));
	}
}

if (!function_exists('str_truncate_words'))
{
   
    /**
     * Truncates a string to the number of words specified.
     */
    function str_truncate_words($string, $length, $suffix = '...')
    {
        $length = abs((int)$length);
        if (strlen($string) > $length)
            $string = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1' . $suffix, $string);

        return $string;
    }
}