var addClassOpen = false;
var addClass_ArrayOfElements = document.getElementsByClassName('addClass-section');
var addClass_ArrayLength = addClass_ArrayOfElements.length;

function openClassSection() {
    if (!addClassOpen) {
        for (var i = 0; i < addClass_ArrayLength; i++)
            addClass_ArrayOfElements[i].style.display = 'inline';
        addClassOpen = true;
    }
}

function closeClassSection() {
    if (addClassOpen) {
        addClassSection.style.display = "none";
        addClassOpen = false;
    }
}

// function showAddClassOk() {
//     setTimeout(function() {
//         $('add-class-ok').fadeOut('fast');
//     }, 1000);
// }