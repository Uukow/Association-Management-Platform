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
    url: "../Api/Email.php",
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






  // Function to send email
//   function sendEmail(recipients, subject, message) {
//     let sendingData = {
//       send: true,
//       email: recipients.join(","), // Join recipients into a comma-separated string
//       subject: subject,
//       message: message,
//     };

//     $.ajax({
//       method: "POST",
//       dataType: "json",
//       url: "../Api/Email.php", // Adjust the URL to your email API endpoint
//       data: sendingData,
//       success: function (response) {
//         if (response.status) {
//           // Email sent successfully
//           alert("Email sent successfully");
//         } else {
//           // Email sending failed
//           console.error("Failed to send email: " + response.message);
//         }
//       },
//       error: function (xhr, status, error) {
//         // Handle error here
//         console.error("Error occurred while sending email: " + error);
//       },
//     });
//   }

//   // Event listener for send email button click
//   $("#send-email-btn").click(function () {
//     let recipients = $("#msgto").val().split(","); // Split recipients string into an array
//     let subject = $("#mailsubject").val();
    
//     let message = simplemde.value(); // Get value from SimpleMDE textarea

//     // Send email
//     sendEmail(recipients, subject, message);

//     // Clear form fields
//     $("#msgto").val("");
//     $("#mailsubject").val("");
//     simplemde.value(""); // Clear SimpleMDE textarea content

//     // Close modal
//     $("#compose-modal").modal("hide");
//   });

});


// $(document).ready(function () {
//   // Initialize SimpleMDE for the textarea
//   var simplemde = new SimpleMDE({
//     element: document.querySelector("#simplemde1")[0]
//   });
 
//   // Function to send email
//   function sendEmail(recipients, subject, message) {
//     let sendingData = {
//       send: true,
//       email: recipients.join(","), // Join recipients into a comma-separated string
//       subject: subject,
//       message: message,
//     };

//     $.ajax({
//       method: "POST",
//       dataType: "json",
//       url: "../Api/Email.php", // Adjust the URL to your email API endpoint
//       data: sendingData,
//       success: function (response) {
//         if (response.status) {
//           // Email sent successfully
//           alert("Email sent successfully");
//         } else {
//           // Email sending failed
//           console.error("Failed to send email: " + response.message);
//         }
//       },
//       error: function (xhr, status, error) {
//         // Handle error here
//         console.error("Error occurred while sending email: " + error);
//       },
//     });
//   }

//   // Event listener for send email button click
//   $("#send-email-btn").click(function () {
//     let recipients = $("#msgto").val().split(","); // Split recipients string into an array
//     let subject = $("#mailsubject").val();
//     let message = simplemde.value(); // Get value from SimpleMDE textarea

//     // Send email
//     sendEmail(recipients, subject, message);

//     // Clear form fields
//     $("#msgto").val("");
//     $("#mailsubject").val("");
//     simplemde.value(""); // Clear SimpleMDE textarea content

//     // Close modal
//     $("#compose-modal").modal("hide");
//   });
// });


































// $(document).ready(function () {
//   // Initialize SimpleMDE for the textarea
//   var simplemde = new SimpleMDE({
//     element: document.getElementById("simplemde1"),
//   });
//   // Function to send email
//   function sendEmail(recipient, subject, message) {
//     let sendingData = {
//       send: true,
//       email: recipient,
//       subject: subject,
//       message: message,
//     };

//     $.ajax({
//       method: "POST",
//       dataType: "json",
//       url: "../Api/Email.php", // Adjust the URL to your email API endpoint
//       data: sendingData,
//       success: function (response) {
//         if (response.status) {
//           // Email sent successfully
//           alert("Email sent successfully");
//         } else {
//           // Email sending failed
//           console.error("Failed to send email: " + response.data);
//         }
//       },
//       error: function (xhr, status, error) {
//         // Handle error here
//         console.error("Error occurred while sending email: " + error);
//       },
//     });
//   }

//   // Event listener for send email button click
//   $("#send-email-btn").click(function () {
//     let recipient = $("#msgto").val();
//     let subject = $("#mailsubject").val();
//     let message = simplemde.value(); // Get value from SimpleMDE textarea

//     // Send email
//     sendEmail(recipient, subject, message);

//     // Clear form fields
//     $("#msgto").val("");
//     $("#mailsubject").val("");
//     simplemde.value(""); // Clear SimpleMDE textarea content

//     // Close modal
//     $("#compose-modal").modal("hide");
//   });
// });
