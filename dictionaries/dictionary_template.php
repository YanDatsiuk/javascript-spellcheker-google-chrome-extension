<?php

/** @var string[] $_words */
/** @var string $_storage_key_name */

//begin of the array
$result = "var spellc_dictionary_words = [". PHP_EOL;

foreach ($_words as $word) {
    $result .= '"' . trim($word) . '",' . PHP_EOL;
}

//end of the array
$result .= "];". PHP_EOL;

$result .= <<< JS
    chrome.storage.sync.set({"$_storage_key_name": spellc_dictionary_words}, function () {
        console.log('data was recorded into $_storage_key_name');
});

JS;

//store generated data
file_put_contents("dictionaries/en/$_storage_key_name.js", $result);