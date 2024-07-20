<?php

include '../Common/Header.php';
?>

 <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                    </div>
                                    <h4 class="page-title">Association Management Platform</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Events Creation</h4>
                                        <div class="card-block table-border-style">

<!-- Bootstrap Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notification Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="modalTitle"></h5>
                <p id="modalDescription"></p>
                <p id="modalEventDate"></p>
            </div>
        </div>
    </div>
</div>


<!-- Add the form within your HTML structure -->
<form id="create-event-form">
    <div class="mb-3">
        <label for="event-title" class="form-label">Event Title</label>
        <input type="text" class="form-control" id="event-title" name="title" placeholder="Enter event title" required>
    </div>
    <div class="mb-3">
        <label for="event-description" class="form-label">Event Description</label>
        <textarea class="form-control" id="event-description" name="description" placeholder="Enter event description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="event-date" class="form-label">Event Date</label>
        <input type="datetime-local" class="form-control" id="event-date" name="event_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Event</button>
</form>

                                        </div>
                                    </div>
                                    </div><!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                    </div>
                                    <!-- end col -->
                                    </div>
                                    <!-- end row -->

<?php

include '../Common/footer.php';
include '../Common/ThemeSettings.php';

?>
<script src="../js/Events.js"></script>