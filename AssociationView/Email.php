 <?php

    include '../Common/Header.php';
    ?>


 <!-- Start Page Content here -->
 <!-- ============================================================== -->

 <div class="content-page">
     <div class="content">

         <!-- Start Content-->
         <div class="container-fluid">

             <!-- start page email-title -->
             <!-- start page title -->
             <div class="row">
                 <div class="col-12">
                     <div class="page-title-box">


                         <h4 class="page-title">Email Read</h4>
                     </div>
                 </div>
             </div>
             <!-- end page title -->
             <!-- end page email-title -->

             <div class="row">

                 <!-- Right Sidebar -->
                 <div class="col-12">
                     <div class="card">
                         <div class="card-body">
                             <!-- Left sidebar -->
                             <div class="page-aside-left">

                                 <div class="d-grid">
                                     <button type="button" class="btn bnb" data-bs-toggle="modal" data-bs-target="#compose-modal">Compose</button>
                                 </div>


                             </div>
                             <!-- End Left sidebar -->

                             <div class="page-aside-right">

                                 <div class="btn-group">
                                     <button type="button" class="btn btn-secondary"><i class="mdi mdi-archive font-16"></i></button>
                                     <button type="button" class="btn btn-secondary"><i class="mdi mdi-alert-octagon font-16"></i></button>
                                     <button type="button" class="btn btn-secondary"><i class="mdi mdi-delete-variant font-16"></i></button>
                                 </div>
                                 <div class="btn-group">
                                     <button type="button" class="btn btn-secondary dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-folder font-16"></i>
                                         <i class="mdi mdi-chevron-down"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <span class="dropdown-header">Move to:</span>
                                         <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                     </div>
                                 </div>
                                 <div class="btn-group">
                                     <button type="button" class="btn btn-secondary dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-label font-16"></i>
                                         <i class="mdi mdi-chevron-down"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <span class="dropdown-header">Label as:</span>
                                         <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                     </div>
                                 </div>

                                 <div class="btn-group">
                                     <button type="button" class="btn btn-secondary dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                         <i class="mdi mdi-dots-horizontal font-16"></i> More
                                         <i class="mdi mdi-chevron-down"></i>
                                     </button>
                                     <div class="dropdown-menu">
                                         <span class="dropdown-header">More Options :</span>
                                         <a class="dropdown-item" href="javascript: void(0);">Mark as Unread</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Add Star</a>
                                         <a class="dropdown-item" href="javascript: void(0);">Mute</a>
                                     </div>
                                 </div>

                                 <div class="mt-3">
                                     <h5 class="font-18">Pagekaan waxaa uu Tusaale u yahay in aad kaga dirdo dadka Membershipka ah Email ee taabo <span style="color: red;">Compose</span> Meesha ay ku qorantahay Mahadsanid</h5>

                                     <hr />

                                     <div class="d-flex mb-3 mt-1">
                                         <img class="d-flex me-2 rounded-circle" src="../assets/images/users/avatar-2.jpg" alt="placeholder image" height="32">
                                         <div class="w-100 overflow-hidden">
                                             <small class="float-end" id="current-time"><?php
                                                                                        date_default_timezone_set('Africa/Mogadishu'); // Set Somalia timezone

                                                                                        $currentDateTime = date('M d, Y, g:i A');

                                                                                        echo " $currentDateTime";
                                                                                        ?>
                                             </small>
                                             <h6 class="m-0 font-14">Media Women Network</h6>
                                             <small class="text-muted">Send: info@mediawomennetwork.com</small>
                                         </div>
                                     </div>

                                     <p>Hi Team!</p>
                                     <p>I wanted to share some exciting news with you all. As you know, here at <b>[Media Women Network]</b>, we're always looking for opportunities to collaborate and expand our impact. I'm thrilled to inform you that we've been presented with a fantastic opportunity to partner with <b>[FESOJ]</b>, a leading organization in our industry.</p>
                                     <p>This collaboration has the potential to be incredibly beneficial for both parties involved. By joining forces with <b>[FESOJ]</b>, we'll have access to their extensive network, resources, and expertise, which will undoubtedly enhance our ability to achieve our goals and make a positive difference in our field.</p>

                                     <p>I believe that this partnership aligns perfectly with our mission and values, and I'm confident that together, we can accomplish great things. I encourage each of you to embrace this opportunity and bring your creativity, dedication, and passion to the table as we embark on this exciting journey together.</p>
                                     <p>YI'll be sure to keep you updated as things progress, but in the meantime, if you have any questions or ideas regarding this collaboration, please don't hesitate to reach out to me or <b>[Abdulkadir Uukow]</b>.</p>
                                     <p>Thank you for your hard work and commitment to excellence. I couldn't be more proud to have such a talented and dedicated team.</p>
                                     <p><b style="color: red;">Best,</b> <br /> Fardowsa Sheik Abdirahman </p>
                                     <b style="color: red;">CEO </b>
                                     <p> Media Women Network</p>
                                     <hr />


                                 </div>
                                 <!-- end .mt-4 -->

                             </div>
                             <!-- end inbox-rightbar-->
                         </div>

                         <div class="clearfix"></div>
                     </div> <!-- end card-box -->

                 </div> <!-- end Col -->
             </div><!-- End row -->

         </div> <!-- container -->

     </div> <!-- content -->

     <!-- Compose Modal -->
     <div id="compose-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="compose-header-modalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header modal-colored-header text-bg-primary">
                     <h4 class="modal-title" id="compose-header-modalLabel">New Message</h4>
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="p-1">
                     <div class="modal-body px-3 pt-3 pb-0">

















                         <form id="compose-form">


                             <div class="form-group">
                                 <label for="">Choose City</label>
                                 <select name="city" id="city" class="form-control">

                                 </select>
                             </div>

                             <div class="mb-2">
                                 <label for="msgto" class="form-label">To</label>
                                 <input type="text" id="msgto" class="form-control" placeholder="Example@email.com">
                             </div>
                             <div class="mb-2">
                                 <label for="mailsubject" class="form-label">Subject</label>
                                 <input type="text" id="mailsubject" class="form-control" placeholder="Your subject">
                             </div>
                             <div class="write-mdg-box mb-3">
                                 <label class="form-label">Message</label>
                                 <textarea id="fariin" class="message"></textarea>
                             </div>

                             <div class="mb-2">
                                 <label for="mailsubject" class="form-label">File</label>
                                 <input type="file" id="file-input" class="form-control" placeholder="Your File" multiple>
                             </div>

                         </form>
                     </div>
                     <div class="px-3 pb-3">
                         <button type="button" id="send-email-btn" class="btn btn-primary"><i class="mdi mdi-send me-1"></i> Send Message</button>
                         <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                     </div>
                 </div>
             </div><!-- /.modal-content -->
         </div><!-- /.modal-dialog -->
     </div>
     <!-- /.modal -->



 </div>

 <!-- ============================================================== -->


 <?php

    include '../Common/footer.php';
    include '../Common/ThemeSettings.php';

    ?>
 <script src="../js/Association/Email.js"></script>
 <script src="../js/Association/membership.js"></script>