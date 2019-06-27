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

inject_generated_scripts_into_manifest();

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

//todo comment what is going on here...
function inject_generated_scripts_into_manifest()
{
    $manifest = file_get_contents("manifest.json");

    $manifest_as_array = json_decode($manifest, true);

    exec("ls dictionaries/en", $chunked_en_dictionaries);

    $scripts_to_include = array_merge($manifest_as_array["content_scripts"][0]["js"], $chunked_en_dictionaries);

    $scripts_to_include = array_unique($scripts_to_include);

    $manifest_as_array["content_scripts"][0]["js"] = $scripts_to_include;

//    print_r($manifest_as_array);

    file_put_contents("manifest.json", json_encode($manifest_as_array, JSON_PRETTY_PRINT));
}