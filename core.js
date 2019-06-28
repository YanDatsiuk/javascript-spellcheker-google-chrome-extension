//todo add some code here 
console.log("hello from core");

/**
 * Config
 */

var spellc_whitelist_classnames = [
    "question",
    "answer"
];

var spellc_dic_en = [];

//

var spellc_webpage = function () {
    console.log("spellc_webpage started");

    //get dictionary from storage
    //chrome.storage.local.get(["spellc_dic_en"], function (result) {
    // console.log(result);
    //});

    console.log("spellc_webpage ended");
}

//document.querySelector("").textContent
//

//select all document elements
var all_elements = document.querySelectorAll('*');

//get only elements which suits to specified configs
var filtered_elements = filter_elements(all_elements);

//for each document element
for (let i = 0; i < filtered_elements.length; i++) {

    //take innerHTML
    let _el_inner_html = filtered_elements[i].innerHTML;

    //trim the inner html content
    let _el_text = _el_inner_html.trim();

    //
    _el_text = _el_text.replace(/(\r\n|\n|\r)/gm, "");

    //strip/delete tags from with its content if there is any
    _el_text = _el_text.replace(/<[^>]+>[^>]+>/g, "");

    //get words from the element
    let words = _el_text.split(" ");

    //filter words
    words = words.filter(Boolean);

    //find misspelled words
    let misspelled_words = get_misspelled_words(words);

    //wrap each misspelled word with some styled element
    set_style_for_misspelled_words(filtered_elements[i], misspelled_words);
}


//split words by whitespace
//do spellchecking for each word
//highlight word with error

function filter_elements(elements) {
    console.log("filter_elements started");

    _result_arr = [];
    for (let i = 0; i < elements.length; i++) {
        if (is_element_in_whitelist(elements[i])) {
            _result_arr.push(elements[i]);
        }
    }
    console.log("filter_elements ended");
    return _result_arr;
}

function filter_word() {

}

function is_element_in_whitelist(element) {
    for (let i = 0; i < spellc_whitelist_classnames.length; i++) {
        if (element.className === spellc_whitelist_classnames[i]) {
            return true;
        }
    }
    return false;
}

function get_misspelled_words(words) {
    let _misspelled_words = [];
    for (let i = 0; i < words.length; i++) {
        if (is_word_in_dictionary(words[i]) === false) {
            _misspelled_words.push(words[i]);
        }
    }
    return _misspelled_words;
}

function is_word_in_dictionary(word) {
    word = word.toLowerCase();
    word = word.replace(/[\u{0080}-\u{FFFF}]/gu, "");
    word = word.replace(",", "");
    word = word.replace(".", "");
    word = word.replace(":", "");
    word = word.replace("{", "");
    word = word.replace("}", "");
    word = word.replace("(", "");
    word = word.replace(")", "");
    word = word.toLowerCase().replace(/[^a-zA-Z]+/g, "");
    for (let i = 0; i < spellc_dictionary_words.length; i++) {
        if (word === spellc_dictionary_words[i]) {
            return true;
        }
    }
    return false;
}

function set_style_for_misspelled_words(element, misspelled_words) {

    for (let i = 0; i<misspelled_words.length; i++){
        element.innerHTML = element.innerHTML.replace(misspelled_words[i], "<span style='color: red;'>"+ misspelled_words[i]+"</span>");
    }
}