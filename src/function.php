<?php
/**
 * File with general functions.
 */


/**
 * Check if key is set in POST.
 *
 * @param mixed $key     to look for
 *
 * @return boolean true if key is set, otherwise false
 */
function hasKeyPost($key)
{
    return array_key_exists($key, $_POST);
}

/**
 * Create a slug of a string, to be used as url.
 *
 * @param string $str the string to format as slug.
 *
 * @return str the formatted slug.
 */
function slugify($str)
{
    $str = mb_strtolower(trim($str));
    $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
    $str = preg_replace('/[^a-z0-9-]/', '-', $str);
    $str = trim(preg_replace('/-+/', '-', $str), '-');
    return $str;
}


/**
 * Sanitize value for output in view.
 *
 * @param string $value to sanitize
 *
 * @return string beeing sanitized
 */
function esc($value)
{
    return htmlentities($value);
}

/**
 * Function to create links for sorting.
 *
 * @param string $column the name of the database column to sort by
 * @param string $route  prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby($column, $route)
{
    return <<<EOD
<span class="orderby">
<a href="{$route}orderby={$column}&order=asc">&darr;</a>
<a href="{$route}orderby={$column}&order=desc">&uarr;</a>
</span>
EOD;
}

/**
 * Function to create links for sorting and keeping the original querystring.
 *
 * @param string $column the name of the database column to sort by
 * @param string $route  prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby2($column, $route)
{
    $asc = mergeQueryString(["orderby" => $column, "order" => "asc"], $route);
    $desc = mergeQueryString(["orderby" => $column, "order" => "desc"], $route);

    return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>
<a href="$desc">&uarr;</a>
</span>
EOD;
}

/**
 * Use current querystring as base, extract it to an array, merge it
 * with incoming $options and recreate the querystring using the
 * resulting array.
 *
 * @param array  $options to merge into exitins querystring
 * @param string $prepend to the resulting query string
 *
 * @return string as an url with the updated query string.
 */
function mergeQueryString($options, $prepend = "?")
{
    // Parse querystring into array
    $query = [];
    parse_str($_SERVER["QUERY_STRING"], $query);

    // Merge query string with new options
    $query = array_merge($query, $options);

    // Build and return the modified querystring as url
    return $prepend . http_build_query($query);
}


/**
 * Get value from POST variable or return default value.
 *
 * @param mixed $key     to look for, or value array
 * @param mixed $default value to set if key does not exists
 *
 * @return mixed value from POST or the default value
 */
function getPost($key, $default = null)
{
    if (is_array($key)) {
        // $key = array_flip($key);
        // return array_replace($key, array_intersect_key($_POST, $key));
        foreach ($key as $val) {
            $post[$val] = getPost($val);
        }
        return $post;
    }

    return isset($_POST[$key])
        ? $_POST[$key]
        : $default;
}

/**
*   function to set a checkbox checked or not
*   @param string stackstring
*   @param string needle to search for
*   @return string checked or empty string
*/
function checkChecked($aStack, $aNeedle)
{
    if (strpos($aStack, $aNeedle) !== false) {
        return "checked";
    } else {
        return "";
    }
}

/**
*   function to set a selectbox selected or not
*   @param string stackstring
*   @param string needle to search for
*   @return string selected or empty string
*/
function checkSelected($aStack, $aNeedle)
{
    if (strpos($aStack, $aNeedle) !== false) {
        return "selected";
    } else {
        return "";
    }
}

/**
*   function that returns a unique value of a certain column in db content
*   @param AppDIMagic $app
*   @param String $value from user
*   @param String $column in db, slug or path
*/
function getUniqueName($app, $value, $column, $id)
{
    //check if null first, that is ok
    if ($value == null) {
        return $value;
    }
    // else...

    if ($column == "slug") {
        $sql = "SELECT id, count(id) AS Dublett FROM content WHERE slug = ?;";
    } else {
        $sql = "SELECT id, count(id) AS Dublett FROM content WHERE path = ?;";
    }
    $res = $app->db->executeFetchAll($sql, [$value]);

    if ($res[0]->Dublett == 0) {
        //a unique title!
        return $value;
    } elseif ($res[0]->id == $id) {
        //value found, but it is my own
        return $value;
    }
    //else find a unique name by adding a suffix
    $suffix = 1;
    while ($res[0]->Dublett > 0) {
        $testValue = $value . $suffix;
        $res = $app->db->executeFetchAll($sql, [$testValue]);
        $suffix += 1;
    }
    return $value . ($suffix - 1);
}
