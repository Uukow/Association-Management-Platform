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
                            <h4 class="header-title">Project Table</h4>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <button id="addNew" class="btn btn-info float-right">Add New Project</button>
                                    <br><br>
                                                <table class="table dt-responsive nowrap w-100" id="projectTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Duration</th>
                                                            <th>Donor</th>
                                                            <th>Type</th>
                                                            <th>Location</th>
                                                            <th>Person</th>
                                                            <th>Assoc Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Project Registeration</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                      <form id="projectForm">
                                        <input type="hidden" name="update_id" id="update_id">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <div id="alert-success" class="alert alert-success d-none"></div>
                                            <div id="alert-danger" class="alert alert-danger d-none"></div>

                                            </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Project Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Duration</label>
                                                <input type="date" name="duration" id="duration" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Donor</label>
                                                <input type="text" name="donor" id="donor" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Type</label>
                                                <input type="text" name="type" id="type" class="form-control" value="" required>
                                            </div>
                                            

                                            <div class="form-group">
                                                <label for="">Location</label>
                                                <input type="text" name="location" id="location" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Person</label>
                                                <input type="text" name="person" id="person" class="form-control" value="" required>
                                            </div>

                                        </div>
                                        </div>

                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary"                                 data-dismiss="modal">Close</button>
                                      </div>

                                      </form>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








<?php

include '../Common/footer.php';
include '../Common/ThemeSettings.php';

?>
<script src="../js/Association/projects.js"></script>