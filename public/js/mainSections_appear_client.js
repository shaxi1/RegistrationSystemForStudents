var search_ArrayOfElements = document.getElementsByClassName('search-section');
var search_ArrayLength = search_ArrayOfElements.length;
var searchOpen = false;

var cart_ArrayOfElements = document.getElementsByClassName('cart-section');
var cart_ArrayLength = cart_ArrayOfElements.length;
var cartOpen = false;

var messageSection_ArrayOfElements = document.getElementsByClassName('message-section');
var messageSection_ArrayLength = messageSection_ArrayOfElements.length;
var messageSectionOpen = true;

function openSearchSection() {
    if (!searchOpen) {
        for (var i = 0; i < search_ArrayLength; i++)
            search_ArrayOfElements[i].style.display = 'inline';
        searchOpen = true;

        closeCartSection();
        closeMessageSection();
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
        closeMessageSection();
    }
}

function closeCartSection() {
    if (cartOpen) {
        for (var i = 0; i < cart_ArrayLength; i++)
            cart_ArrayOfElements[i].style.display = "none";
        cartOpen = false;
    }
}

function openMessageSection() {
    if (!messageSectionOpen) {
        for (var i = 0; i < messageSection_ArrayLength; i++)
            messageSection_ArrayOfElements[i].style.display = 'inline';
        messageSectionOpen = true;

        closeSearchSection();
        closeCartSection();
    }
}

function closeMessageSection() {
    if (messageSectionOpen) {
        for (var i = 0; i < messageSection_ArrayLength; i++)
            messageSection_ArrayOfElements[i].style.display = "none";
        messageSectionOpen = false;
    }
}

function closeAllSections() {
    closeSearchSection();
    closeCartSection();

    closeMessageSection();
}