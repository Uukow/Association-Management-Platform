function updateTime() {
  var now = new Date();
  var dateString = now.toLocaleString("en-US", {
    year: "numeric",
    month: "short",
    day: "2-digit",
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit",
    hour12: true,
  });
  document.getElementById("current-time").innerText = dateString;
}

// Update time every second
setInterval(updateTime, 1000);


$(document).ready(function () {
  var simplemde = new SimpleMDE({
    element: $("#fariin")[0] // replace "#your-textarea" with the selector of your textarea
});



// Function to send email
function sendEmail(recipients, subject, message, files) {
  let formData = new FormData();
  formData.append('send', true);
  formData.append('email', recipients.join(","));
  formData.append('subject', subject);
  formData.append('message', message);

  // Append files to FormData
  if (files && files.length > 0) {
    for (let i = 0; i < files.length; i++) {
      formData.append('attachments[]', files[i]);
    }
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Email.php",
    data: formData,
    processData: false,
    contentType: false, // Ensure proper content type for file uploads
    success: function (response) {
      if (response.status) {
        // Email sent successfully
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Email sent successfully",
          showConfirmButton: false,
          timer: 3000
        });
        // alert("Email sent successfully");
      } else {
        // Email sending failed
        console.error("Failed to send email: " + response.message);
      }
    },
    error: function (xhr, status, error) {
      // Handle error here
      console.error("Error occurred while sending email: " + error);
    },
  });
}

// Event listener for send email button click
$("#send-email-btn").click(function () {
  let recipients = $("#msgto").val().split(",");
  let subject = $("#mailsubject").val();
  let message = simplemde.value();

  // Get files
  let files = $('#file-input').prop('files');

  // Send email with attachments
  sendEmail(recipients, subject, message, files);

  // Clear form fields
  $("#msgto").val("");
  $("#mailsubject").val("");
  simplemde.value("");
  $('#file-input').val("");

  // Close modal
  $("#compose-modal").modal("hide");
});







});

