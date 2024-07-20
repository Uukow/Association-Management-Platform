

$(document).ready(function() {
    // Handle form submission
    $('#create-event-form').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting via the browser

        // Serialize form data
        var formData = $(this).serialize();
        // Add the action parameter
        formData += '&action=createEvent';

        // Store a reference to the form for later use
        var form = this;

        // Send AJAX request to create event
        $.ajax({
            url: '../Api/Events.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Display success message using SweetAlert
                // Swal.fire({
                //     icon: 'success',
                //     title: 'Success!',
                //     text: response.message,
                // });
                alert(response.message);
                // Clear the form inputs
                form.reset();
            },
            error: function(xhr, status, error) {
                // Display error message or handle as needed
                console.error('Error creating event:', error);
            }
        });
    });
});












$(document).ready(function() {
    // Function to fetch notifications
    function fetchNotifications() {
        $.ajax({
            url: '../Api/Events.php', // Assuming this is the endpoint to fetch notifications
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Clear existing notifications
                    $('#notifications-list').empty();
                    
                    // Append new notifications
                    $.each(response.notifications, function(index, notification) {
                        var notificationItem = `
                            <a href="#" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2" data-id="${notification.id}">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-14">${notification.status} <small class="fw-normal text-muted ms-1">${notification.created_at}</small></h5>
                                            <small class="noti-item-subtitle text-muted">${notification.description}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>`;
                        $('#notifications-list').append(notificationItem);
                    });

                    // Attach click event listener to notification items
                    $('.notify-item').click(function() {
                        var id = $(this).data('id');
                        console.log('Clicked notification ID:', id); // Log clicked notification ID
                        var clickedNotification = response.notifications.find(function(notification) {
                            return notification.id === id;
                        });
                        console.log('Clicked notification data:', clickedNotification); // Log clicked notification data
                        $('#modalTitle').text(clickedNotification.title);
                        $('#modalDescription').text(clickedNotification.description);
                        $('#modalEventDate').text(clickedNotification.event_date);
                        $('#notificationModal').modal('show'); // Show the modal
                    });
                } else {
                    // Display error message or handle as needed
                    console.error('Error fetching notifications:', response.message);
                }
            },
            error: function(xhr, status, error) {
                // Display detailed error message
                console.error('Error fetching notifications. Status:', status, 'Error:', error);
            }
        });
    }

    // Fetch notifications on page load
    fetchNotifications();

    // Optionally, you can fetch notifications at regular intervals
    setInterval(fetchNotifications, 60000); // Fetch notifications every minute (adjust interval as needed)
});






