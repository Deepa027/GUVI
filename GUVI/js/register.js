$(document).ready(function () {
    // Check if the user's email is present in localStorage
    var userEmail = localStorage.getItem('userEmail');

   if (userEmail) {
        window.location.href='profile.html'
    }
    $("#register").click(function(){
        validateAndRegister();
    })
    
function validateAndRegister() {
    // Basic client-side validation
    var requiredFields = ["email_id", "phone_number","password"];
    for (var i = 0; i < requiredFields.length; i++) {
        var field = requiredFields[i];
        if (!$("[name='" + field + "']").val()) {
            alert("Please fill in all required fields.");
            return;
        }
    }

    // If validation passes, proceed with registration
    registerUser();
}

    function registerUser() {
        var formData = $("#registrationForm").serialize();

        $.ajax({
            type: "POST",
            url: "php/register.php",
            data: formData,
            success: function(response) {
                console.log(response)
            if(response=='success'){
                window.location.href ='login.html'
            }else{
                alert('Failed')
            }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error:", textStatus, errorThrown);
                alert("Registration failed. Please try again.");
            }
        });
    }
});
