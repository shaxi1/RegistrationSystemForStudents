function logout() {
    $.ajax({
        url : 'http://localhost/phplogin/logout.php',
        type : 'POST',
        success : function(data) {
            window.location='index.html'
        }
    });
}