//todo add some code here 
console.log("hello from call");

//

var spellc_webpage = function() {

    //get dictionary from storage
    chrome.storage.local.get(["spellc_dic_en"], function (result) {
        console.log("ok2");
        console.log(result);
    });
    console.log("ok");
}