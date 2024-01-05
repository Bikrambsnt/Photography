function handleSearch(event) {
    if (event.keyCode === 13) {
    
        searchFunction();
    }
}

function searchFunction() {
    var searchInput = document.getElementById("searchInput").value;
    alert("Search for: " + searchInput);
}