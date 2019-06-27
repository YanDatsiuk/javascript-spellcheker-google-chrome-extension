<?php

//read file dictionary.js
$all_words = file('dictionary.js');

//convert all words to lowercase
//and sort all words in alphabetical order
$all_words = (order_dictionary($all_words));

//split array of words into chunks
$chunked_words = array_chunk($all_words, 1000);

//generate js arrays
$index = 0;
foreach ($chunked_words as $_words) {
    $_storage_key_name = "spellc_dic_en_$index";
    include "dictionaries/dictionary_template.php";
    $index++;
}

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
    for ($i = 0; $i< count($words); $i++){
        $words[$i] = strtolower($words[$i]);
    }

    //sort words in alphabetical order
    sort($words);

    //return result
    return $words;
}