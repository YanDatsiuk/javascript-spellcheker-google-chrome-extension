<?php

//read dictionary.js
$all_words = file('dictionary.js');

//split array of words into chunks
$chunked_words = array_chunk($all_words, 1000);

//generate js arrays
$index = 0;
foreach ($chunked_words as $_words) {
    $_storage_key_name = "spellc_dic_en_$index";
    include "dictionaries/dictionary_template.php";
    $index++;
}
//todo prepare template

include "dictionaries/dictionary_template.php";