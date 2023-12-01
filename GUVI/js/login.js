$(document).ready(function () {
    var userEmail = localStorage.getItem('userEmail');

    if (userEmail) {
        window.location.href = 'profile.html';
    }
    $("#loginForm").submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting in the traditional way

        // Get form data
        var formData = $(this).serialize();

        // Send the data using AJAX
        $.ajax({
            type: "POST",
            url: "php/login.php", // Specify the URL of your login.php file
            data: formData,
            success: function (response) {
                if(response=='Success'){
                    var userEmail = $('[name="email_id"]').val();

                    // Store email in localStorage
                    localStorage.setItem('userEmail', userEmail);
                    window.location.href='profile.html'
                }else{
                    alert(response)
                }
            },
            error: function () {
                // Handle errors (you can customize this)
                alert("Login failed. Please try again.");
            }
        });
    });
});