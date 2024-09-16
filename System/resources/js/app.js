import './bootstrap';

$(document).ready(function() {
    $('#addTaskForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Reset any previous errors
        clearErrors();

        $.ajax({
            url: $(this).attr('action'), // Get form's action (route URL)
            type: 'POST',
            data: $(this).serialize(), // Serialize form data for sending
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log("Success Response:", response); 
                    //$('#addTaskModal').modal('hide'); // Close the modal
                    // Handle successful task addition:
                    // - Display a success message
                    // - Update your task list (if applicable)
                } 
            },
            error: function(response) {
                console.log("Error Response:", response);

                /*if (response.status === 422) { // Validation errors 
                    handleValidationErrors(response.responseJSON.errors);
                } else {
                    // Handle other types of errors (server error, etc.)
                    displayGenericError(); 
                }*/
            }
        });
    });

    function handleValidationErrors(errors) {
        console.log("Errors:", errors);    
    }
    

    function clearErrors() {
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    }

    function displayGenericError() {
        // Example: Display simple alert
        alert('An error occurred. Please try again later.');  
    }
});
