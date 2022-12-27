var addClass_ArrayOfElements = document.getElementsByClassName('addClass-section');
var addClass_ArrayLength = addClass_ArrayOfElements.length;
var addClassOpen = false;

var addLecturer_ArrayOfElements = document.getElementsByClassName('addLecturer-section');
var addLecturer_ArrayLength = addLecturer_ArrayOfElements.length;
var addLecturerOpen = false;

var searchLecturers_ArrayOfElements = document.getElementsByClassName('listLecturers-section');
var searchLecturers_ArrayLength = searchLecturers_ArrayOfElements.length;
var searchLecturersOpen = false;

var searchClasses_ArrayOfElements = document.getElementsByClassName('listClasses-section');
var searchClasses_ArrayLength = searchClasses_ArrayOfElements.length;
var searchClassesOpen = false;

var msgSection_ArrayOfElements = document.getElementsByClassName('msg-section');
var msgSection_ArrayLength = msgSection_ArrayOfElements.length;
var msgSectionOpen = false;

function openClassSection() {
    if (!addClassOpen) {
        for (var i = 0; i < addClass_ArrayLength; i++)
            addClass_ArrayOfElements[i].style.display = 'inline';
        addClassOpen = true;
        
        closeLecturerSection();
        closeSearchLecturersSection();
        closeSearchClassesSection();
        closeMsgSection();
    }
}

function closeClassSection() {
    if (addClassOpen) {
        for (var i = 0; i < addLecturer_ArrayLength; i++)
            addClass_ArrayOfElements[i].style.display = "none";
        addClassOpen = false;
    }
}

function openLecturerSection() {
    if (!addLecturerOpen) {
        for (var i = 0; i < addLecturer_ArrayLength; i++)
            addLecturer_ArrayOfElements[i].style.display = 'inline';
        addLecturerOpen = true;

        closeClassSection();
        closeSearchLecturersSection();
        closeSearchClassesSection();
        closeMsgSection();
    }
}

function closeLecturerSection() {
    if (addLecturerOpen) {
        for (var i = 0; i < addLecturer_ArrayLength; i++)
            addLecturer_ArrayOfElements[i].style.display = "none";
        addLecturerOpen = false;
    }
}

function openSearchLecturersSection() {
    if (!searchLecturersOpen) {
        for (var i = 0; i < searchLecturers_ArrayLength; i++)
            searchLecturers_ArrayOfElements[i].style.display = 'inline';
        searchLecturersOpen = true;

        closeClassSection();
        closeLecturerSection();
        closeSearchClassesSection();
        closeMsgSection();
    }
}

function closeSearchLecturersSection() {
    if (searchLecturersOpen) {
        for (var i = 0; i < searchLecturers_ArrayLength; i++)
            searchLecturers_ArrayOfElements[i].style.display = "none";
        searchLecturersOpen = false;
    }
}

function openSearchClassesSection() {
    if (!searchClassesOpen) {
        for (var i = 0; i < searchClasses_ArrayLength; i++)
            searchClasses_ArrayOfElements[i].style.display = 'inline';
        searchClassesOpen = true;

        closeClassSection();
        closeLecturerSection();
        closeSearchLecturersSection();
        closeMsgSection();
    }
}

function closeSearchClassesSection() {
    if (searchClassesOpen) {
        for (var i = 0; i < searchClasses_ArrayLength; i++)
            searchClasses_ArrayOfElements[i].style.display = "none";
        searchClassesOpen = false;
    }
}

function closeAllSections() {
    closeClassSection();
    closeLecturerSection();
    closeSearchLecturersSection();
    closeSearchClassesSection();
    closeMsgSection();
}

function openMsgSection() {
    if (!msgSectionOpen) {
        for (var i = 0; i < msgSection_ArrayLength; i++)
            msgSection_ArrayOfElements[i].style.display = 'inline';
        msgSectionOpen = true;

        closeClassSection();
        closeLecturerSection();
        closeSearchLecturersSection();
        closeSearchClassesSection();
    }
}

function closeMsgSection() {
    if (msgSectionOpen) {
        for (var i = 0; i < msgSection_ArrayLength; i++)
            msgSection_ArrayOfElements[i].style.display = "none";
        msgSectionOpen = false;
    }
}

// function showAddClassOk() {
//     setTimeout(function() {
//         $('add-class-ok').fadeOut('fast');
//     }, 1000);
// }