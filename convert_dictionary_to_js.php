<?php

//read file dictionary.js
$all_words = file('dictionary.js');

exec("rm dictionaries/en/*");

//convert all words to lowercase
//and sort all words in alphabetical order
$all_words = (order_dictionary($all_words));

//generate js arrays
$_storage_key_name = "spellc_dic_en";
$_words = $all_words;
include "dictionaries/dictionary_template.php";

/**
 * Convert all words to lowercase and sort all words in alphabetical order
 *
 * @param $words
 * @return mixed
 */
function order_dictionary($words)
{
    //convert all words to lowercase
    for ($i = 0; $i < count($words); $i++) {
        $words[$i] = strtolower($words[$i]);
    }

    //sort words in alphabetical order
    sort($words);

    //return result
    return $words;
}