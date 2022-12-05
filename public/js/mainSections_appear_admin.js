var addClassOpen = false;
var arrayOfElements = document.getElementsByClassName('addClass-section');
var lengthOfArray = arrayOfElements.length;

function openClassSection() {
    if (!addClassOpen) {
        for (var i = 0; i < lengthOfArray; i++)
            arrayOfElements[i].style.display = 'inline';
        addClassOpen = true;
    }
}

function closeClassSection() {
    if (addClassOpen) {
        addClassSection.style.display = "none";
        addClassOpen = false;
    }
}