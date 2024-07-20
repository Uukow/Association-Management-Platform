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
                            <h4 class="header-title">Association Table</h4>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <button id="addNew" class="btn btn-info float-right">Add New Association</button>
                                    <br><br>
                                                <table class="table dt-responsive nowrap w-100" id="userTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Full Name</th>
                                                            <th>UserName</th>
                                                            <th>Password</th>
                                                            <th>Status</th>
                                                            <th>Email</th>
                                                            <th>Verified</th>
                                                            <th>Short Name</th>
                                                            <th>Join Date</th>
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

                            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Association Registeration</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body m-1">
												<div class="alert alert-success p-2 d-none"role="alert">
																Successfully
															</div>
															<div class="alert alert-danger p-2 d-none"role="alert">
																Error
															</div>
  
                                                            
                            <form id="userForm">
                                <input type="hidden" name="update_id" id="update_id">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="alert-success" class="alert alert-success d-none"></div>
                                        <div id="alert-danger" class="alert alert-danger d-none"></div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Full Name</label>
                                            <input type="text" name="name" id="name" class="form-control" pattern="[^0-9]*" title="Please enter a valid String without numbers" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" value="" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="text" name="password" id="password" class="form-control" value="" required>
                                        </div>
<!-- 
                                        <div class="form-group">
                                            <label for="">Roles</label>
                                            <select name="role" id="role" class="form-select" aria-label="Default select example">
                                                <option selected>Open this select menu</option>
                                                <option value="admin">Admin</option>
                                                <option value="member">Member</option>
                                            </select>

                                        </div> -->


                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="statuss" id="statuss" class="form-select" aria-label="Default select example">
                                                <option value="Active">Active</option>
                                                <option value="disActive">DisActive</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="Email" name="email" id="email" class="form-control" value="" required>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="">Verication</label>
                                            <select name="verify" id="verify" class="form-select" aria-label="Default select example">
                                                <option selected> </option>
                                                <option value="mdi mdi-check-decagram text-primary">Verified</option>
                                                
                                            </select>

                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="">Short Name`</label>
                                            <input type="text" name="associationName" id="associationName" class="form-control" value="" required>
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
<script src="../js/association.js"></script>