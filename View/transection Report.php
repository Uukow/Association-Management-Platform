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
                            <h4 class="header-title">Transections Report</h4>
                            <div class="card-block table-border-style">

                                        <form id="transectionForm">
                                        <div class="row">
                                                
                                                <div class="col-sm-3">
                                                <label for="">Method</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="0">All</option>
                                                        <option value="Custom">Custom</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-3">
                                                    
                                                <div class="form-group">
                                                <label for="">Organization</label>
                                                <select name="org" id="org" class="form-control">
                                                    
                                                </select>
                                            </div>
                                                </div>

                                                <div class="col-sm-3">
                                                <label for="">From</label>
                                                    <input type="date" name="from" id="from" class="form-control">
                                                </div>

                                                <div class="col-sm-3">
                                                <label for="">To</label>
                                                    <input type="date" name="to" id="to" class="form-control">
                                                </div>

                                                <button type="submit" id="addNew" class="btn btn-info float-right m-2">Get Statements</button>

                                        </div>

                                                </form>
                                                <div class="row">
                                                    <div class="col-sm-12 float-right text-right">
                                                    <button class="btn btn-success" id="print_statment"><i class="ri-printer-fill"></i> Print</button>
                                            <button onclick="exportToExcel()" class="btn btn-info" id="export_statment"><i class="fa-solid fa-file-export"></i> Export</button>
                                                    </div>
                                                </div>


                                            </div>

                                            

                                            <div class="table-responsive " id="print_area">

                                            <!-- <img src="../assets/img/logo.png" width="100%" >
                                                 -->
                                                <table class="table table-striped" id="transectionTable">
                                                    <thead>
                                                        
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
            </div>
        </div>
    </div>








<?php

include '../Common/footer.php';
include '../Common/ThemeSettings.php';

?>
<script src="../js/TransReport.js"></script>