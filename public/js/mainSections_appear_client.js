var search_ArrayOfElements = document.getElementsByClassName('search-section');
var search_ArrayLength = search_ArrayOfElements.length;
var searchOpen = false;

var cart_ArrayOfElements = document.getElementsByClassName('cart-section');
var cart_ArrayLength = cart_ArrayOfElements.length;
var cartOpen = false;

function openSearchSection() {
    if (!searchOpen) {
        for (var i = 0; i < search_ArrayLength; i++)
            search_ArrayOfElements[i].style.display = 'inline';
        searchOpen = true;

        closeCartSection();
    }
}

function closeSearchSection() {
    if (searchOpen) {
        for (var i = 0; i < search_ArrayLength; i++)
            search_ArrayOfElements[i].style.display = "none";
        searchOpen = false;
    }
}

function openCartSection() {
    if (!cartOpen) {
        for (var i = 0; i < cart_ArrayLength; i++)
            cart_ArrayOfElements[i].style.display = 'inline';
        cartOpen = true;

        closeSearchSection();
    }
}

function closeCartSection() {
    if (cartOpen) {
        for (var i = 0; i < cart_ArrayLength; i++)
            cart_ArrayOfElements[i].style.display = "none";
        cartOpen = false;
    }
}

function closeAllSections() {
    closeSearchSection();
    closeCartSection();
}