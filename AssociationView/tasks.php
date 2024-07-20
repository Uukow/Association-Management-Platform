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
                            <h4 class="header-title">Tasks Table</h4>
                            <div class="card-block table-border-style">
                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#pending" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Pending</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#inprogress" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                            <span class="d-none d-md-block">In Progress</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#completed" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Complete</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="pending">
                                        <div class="table-responsive">
                                            <button id="addNew" class="btn btn-info float-right">Add New Task</button>
                                            <br><br>
                                            <table class="table dt-responsive nowrap w-100" id="pendingTable">
                                                <thead>
                                                    <tr>
                                                        <th>EmployeeId</th>
                                                        <th>Description</th>
                                                        <th>Type</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="inprogress">
                                        <div class="table-responsive">
                                            <table class="table dt-responsive nowrap w-100" id="progressTable">
                                                <thead>
                                                    <tr>
                                                        <th>EmployeeId</th>
                                                        <th>Description</th>
                                                        <th>Type</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="completed">
                                        <div class="table-responsive">
                                            
                                            <table class="table dt-responsive nowrap w-100" id="completeTable">
                                                <thead>
                                                    <tr>
                                                        <th>EmployeeId</th>
                                                        <th>Description</th>
                                                        <th>Type</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Status</th>
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
                    </div>
                </div>

                <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Task Registeration</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="taskForm">
                                    <input type="hidden" name="update_id" id="update_id">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="alert-success" class="alert alert-success d-none"></div>
                                            <div id="alert-danger" class="alert alert-danger d-none"></div>

                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Employees Id</label>
                                                <input type="text" name="empId" id="empId" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Task Description</label>
                                                <input type="text" name="description" id="description" class="form-control" value="" required>
                                            </div>



                                            <div class="form-group">
                                                <label for="">Type</label>
                                                <select name="type" id="type" class="form-select" aria-label="Default select example">
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly">Monthly</option>
                                                </select>
                                            </div>



                                            <div class="form-group">
                                                <label for="">StartDate</label>
                                                <input type="date" name="startDate" id="startDate" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">EndtDate</label>
                                                <input type="date" name="endDate" id="endDate" class="form-control" value="" required>
                                            </div>



                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="statuss" id="statuss" class="form-select" aria-label="Default select example">
                                                    <option value="Pending">Pending</option>
                                                    <option value="in progress">In Progress</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>




                <!-- update -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Task Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="updateForm">
                                    <input type="hidden" name="update_id" id="update_id">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="alert-success" class="alert alert-success d-none"></div>
                                            <div id="alert-danger" class="alert alert-danger d-none"></div>

                                        </div>

                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="wax" id="wax" class="form-select" aria-label="Default select example">
                                                <option value="in progress">In Progress</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>


                                    </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<script src="../js/Association/tasks.js"></script>