$(document).ready(function () {
    var userEmail = localStorage.getItem('userEmail');

  //  if (!userEmail) {
    //    window.location.href = 'login.html';
    //}
    if (userEmail) {
        // User is authenticated, render the profile or perform necessary actions
        console.log('User is authenticated with email:', userEmail);

        // Attach event listener to the Sign Out button
        $('#signOutBtn').on('click', function () {
            // Clear the user's email from localStorage
            localStorage.removeItem('userEmail');

            // Redirect to the login page
            window.location.href = 'login.html';
        });
    }


    function loadUserData() {
        $.ajax({
            type: "POST",
            url: "php/profile.php",
            data: { email_id: userEmail },
            dataType: "json",
            success: function (userData) {
                console.log(userData)
                // Display the user information on the page
                $("#userId").text(userData.id);
                $("#firstName").val(userData.first_name);
                $("#middleName").val(userData.middle_name);
                $("#lastName").val(userData.last_name);
                $("#email").text(userData.email_id);
                $("#phoneNumber").val(userData.phone_number);
                $("#gender").val(userData.gender);
                $("#dob").val(userData.dob);
                $("#country").val(userData.country);
                var age = moment().diff(moment(userData.dob, 'YYYY-MM-DD'), 'years');
                $("#age").val(age);
            },
            error: function () {
                // Handle errors (you can customize this)
                alert("Error fetching user information.");
            }
        });
    }

    // Load user data on page load
    loadUserData();

    // Function to update user data
    $("#updateForm").submit(function (e) {
        e.preventDefault();
        
        var formData = $(this).serialize() + "&email="+userEmail;

        $.ajax({
            type: "POST",
            url: "php/control.php",
            data: formData,
            success: function (response) {
                // Reload user data after successful update
                loadUserData();
                alert(response);
            },
            error: function () {
                console.log(response)
                // Handle errors (you can customize this)
                alert("Error updating user information.");
            }
        });
    });

});
