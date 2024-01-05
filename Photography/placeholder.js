document.addEventListener("DOMContentLoaded", function() {
    
    function addToPlaceholder(toAdd, el) {
        el.attr('placeholder', el.attr('placeholder') + toAdd);
   
        return new Promise(resolve => setTimeout(resolve, 100));
    }


    function clearPlaceholder(el) {
        el.attr("placeholder", "");
    }


    function printPhrase(phrase, el) {
        return new Promise(resolve => {
         
            clearPlaceholder(el);
            let letters = phrase.split('');
           
            letters.reduce(
                (promise, letter, index) => promise.then(_ => {
                    
                    if (index === letters.length - 1) {
                 
                        setTimeout(resolve, 1000);
                    }
                    return addToPlaceholder(letter, el);
                }),
                Promise.resolve()
            );
        });
    } 

    function printPhrases(phrases, el) {

        return phrases.reduce(
            (promise, phrase) => promise.then(_ => printPhrase(phrase, el)), 
            Promise.resolve()
        );
    }


    function run() {
        let phrases = [
            "Search What you want....",
            "Describe your imagine....",
            "We try our best to Provide your need....",
            "Just give a Hint...."
        ];

        printPhrases(phrases, $('#searchInput')).then(run);
    }

    run();
});
