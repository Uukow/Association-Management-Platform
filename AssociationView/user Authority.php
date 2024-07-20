<?php
include '../Common/Header.php';
?>



<style>
    fieldset.authorityBorder{
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0PX #000;
                box-shadow: 0pc 0px 0px 0PX #000;
    }
    legend.authorityBorder{
        width: inherit ;
        padding: 0 10px;
        border-bottom: none;
    }
    input[type=checkbox]{
        transform: scale(1.5);
    }
    #allAuthority{
        transform: scale(2);
    }
</style>

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
                            <h4 class="header-title">User Authority</h4>
                                        </div>
                                        <div class="card-block table-border-style">

                                        <form id="authorityForm">
                                        <div class="row">

                                        <div class="col-sm-12">
                                            <div id="alert-success" class="alert alert-success d-none"></div>
                                            <div id="alert-danger" class="alert alert-danger d-none"></div>

                                            </div>
                                                
                                                <div class="col-sm-12">
                                                    <select name="userId" id="userId" class="form-control m-3">
                                                        

                                                    </select>
                                                </div>
                                                

                                                
                                                    <div class="col-sm-12">
                                                        <fieldset class="authorityBorder">

                                                        <legend class="authorityBorder">
                                                        <input type="checkbox" id="allAuthority" name="allAuthority">
                                                               All Authorities
                                                        </legend>

                                                        <div class="row" id="authorityArea">
                                                            <!-- <div class="col-sm-4">
                                                                <fieldset class="authorityBorder">
                                                                    <legend class="authorityBorder">
                                                                    <input type="checkbox" name="" id="">
                                                                        Dashboard
                                                                    </legend>

                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin: 10px;">
                                                                    Dashboard
                                                                    </label>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Register
                                                                    </label>
                                                                    </div>
                                                                    
                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Update
                                                                    </label>
                                                                    </div>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Delete
                                                                    </label>
                                                                    </div>

                                                                </fieldset>

                                                            </div>


                                                            <div class="col-sm-4">
                                                                <fieldset class="authorityBorder">
                                                                    <legend class="authorityBorder">
                                                                    <input type="checkbox" name="" id="">
                                                                        Dashboard
                                                                    </legend>

                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin: 10px;">
                                                                    Dashboard
                                                                    </label>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Register
                                                                    </label>
                                                                    </div>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Update
                                                                    </label>
                                                                    </div>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Delete
                                                                    </label>
                                                                    </div>

                                                                </fieldset>

                                                            </div>

                                                            <div class="col-sm-4">
                                                                <fieldset class="authorityBorder">
                                                                    <legend class="authorityBorder">
                                                                    <input type="checkbox" name="" id="">
                                                                        Dashboard
                                                                    </legend>

                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin: 10px;">
                                                                    Dashboard
                                                                    </label>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Register
                                                                    </label>
                                                                    </div>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Update
                                                                    </label>
                                                                    </div>

                                                                    <div class="linkActions">
                                                                    <label for="">
                                                                    <input type="checkbox" name="" id="" style="margin-left: 30px;">
                                                                    Delete
                                                                    </label>
                                                                    </div>

                                                                </fieldset>

                                                            </div> -->

                                                        </div>

                                                        

                                                        </fieldset>
                                                    </div>
                                                
                                                

                                        </div>

                                        <button type="submit" id="Submit" class="btn btn-info float-right m-2">Authorize User</button>

                                                </form>
                                        
                                                



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
    </div>









<?php
include '../Common/footer.php';
include '../Common/ThemeSettings.php';

?>

<script src="../js/userAuthority.js"></script>




