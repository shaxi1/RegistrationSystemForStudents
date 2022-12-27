var search_ArrayOfElements = document.getElementsByClassName('search-section');
var search_ArrayLength = search_ArrayOfElements.length;
var searchOpen = false;

function openSearchSection() {
    if (!searchOpen) {
        for (var i = 0; i < search_ArrayLength; i++)
            search_ArrayOfElements[i].style.display = 'inline';
        searchOpen = true;
    }
}

function closeSearchSection() {
    if (searchOpen) {
        for (var i = 0; i < search_ArrayLength; i++)
            search_ArrayOfElements[i].style.display = "none";
        searchOpen = false;
    }
}