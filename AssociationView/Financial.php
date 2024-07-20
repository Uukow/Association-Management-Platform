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
                                        <h4 class="header-title">Transection Table</h4>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <button id="addNew" class="btn btn-info float-right">Add New Transection</button>
                                                <br><br>
                                                <table class="table dt-responsive nowrap w-100" id="TransectionTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Acount Title</th>
                                                            <th>Org</th>
                                                            <th>Type</th>
                                                            <th>Date</th>
                                                            <th>Number</th>
                                                            <th>Name</th>
                                                            <th>Memo</th>
                                                            <th>Split</th>
                                                            <th>Category</th>
                                                            <th>Amount</th>
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

                            <div class="modal fade" id="transectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Transection Registeration</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <form id="transectionForm">
                                        <input type="hidden" name="update_id" id="update_id">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <div id="alert-success" class="alert alert-success d-none"></div>
                                            <div id="alert-danger" class="alert alert-danger d-none"></div>

                                            </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">AccoutTite</label>
                                                <select name="title" id="title" class="form-control">
                                                    
                                                </select>
                                            </div>

                                                
                                            <div class="form-group">
                                                <label for="">Organization</label>
                                                <select name="org" id="org" class="form-control">
                                                    
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="">Type</label>
                                                <input type="text" name="type" id="type" class="form-control" value="" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Date</label>
                                                <input type="date" name="date" id="date" class="form-control" value="" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="">Number</label>
                                                <input type="number" name="number" id="number" class="form-control" value="" required>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="">Memo</label>
                                                <input type="text" name="memo" id="memo" class="form-control" value="" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="">Split</label>
                                                <input type="text" name="split" id="split" class="form-control" value="" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="">Category</label>
                                                <select name="category" id="category" class="form-control">
                                                    <option value="Debit">
                                                        Debit
                                                    </option>
                                                    <option value="Credit">
                                                        Credit
                                                    </option>
                                                </select>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="">Amout</label>
                                                <input type="text" name="amount" id="amount" class="form-control" value="" required>
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
<script src="../js/Association/Transections.js"></script>