<script>
    function ajaxCall(url, userData) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                data: userData
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                if (response) {
                    processServerResponse(response);
                }
            }
        });
    }

    $(document).ready(function() {
        // Set up the CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Form validation setup
        $("#ajaxForm").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 4
                },
                customField: {
                    customRule: true
                }
            },
            messages: {
                title: {
                    required: "Please enter your title",
                    minlength: "Your title must consist of at least 4 characters"
                }
            }
        });

        // Add custom validation method
        $.validator.addMethod("customRule", function(value, element) {
            return this.optional(element) || value === "customValue";
        }, "Please enter the custom value");

        // Handle form submission via AJAX
        $('#ajaxForm').submit(function(e) {
            e.preventDefault();

            if ($("#ajaxForm").valid()) {
                const url = $(this).attr('action');
                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            processServerResponse(response);
                            $('.global.offcanvas').offcanvas('hide');
                            $('.global.modal').modal('hide');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }
        });
    });
</script>
