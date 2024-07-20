let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/membership.php",
    success: function(data) {
        if (data.status) {
            associationName = data.associationName;
        } else {
            console.error("Failed to retrieve association name: " + data.message);
        }
    },
    error: function() {
        console.error("An error occurred while fetching the association name.");
    }
});

loadData();
fillEmailsAssociations()
fillAccounts();
let btnAction = "Insert";

$("#addNew").on("click", function () {
  $("#membershipModal").modal("show");
});

$("#membershipForm").on("submit", function (event) {
  event.preventDefault();

  let card = $("#card").val();
  let name = $("#name").val();
  let gender = $("#gender").val();
  let email = $("#email").val();
  let phone = $("#phone").val();
  let location = $("#location").val();
  let semid = $("#semId").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      card: card,
      name: name,
      gender: gender,
      email: email,
      phone: phone,
      location: location,
      semid: semid,
      action: "register_membership",
    };
  } else {
    sendingData = {
      id: id,
      card: card,
      name: name,
      gender: gender,
      email: email,
      phone: phone,
      location: location,
      semid: semid,
      action: "update_membership",
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/membership.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        displayMessage("success", response);
        btnAction = "Insert";
        loadData();
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
});

function displayMessage(type, message) {
  let success = document.querySelector("#alert-success");
  let error = document.querySelector("#alert-danger");

  if (type === "success") {
    error.classList = "alert alert-danger d-none";
    success.classList = "alert alert-success";
    success.innerHTML = message;

    setTimeout(function () {
      $("#membershipModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#membershipForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#membershipTable tbody").html("");
  let sendingData = {
    action: "get_membership",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/membership.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach((res) => {
          let tr = "<tr>";
          for (let key in res) {
            if (key !== 'id') { // Exclude 'id' from being added to the table rows
              tr += `<td>${res[key]}</td>`;
            }
          }

          tr += `<td>
            <a class="btn btn-info update_info" data-update-id="${res["id"]}"><i class="ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
            <a class="btn btn-danger delete_info" data-delete-id="${res["id"]}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
          </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#membershipTable tbody").html(html);
        $("#membershipTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

function fetchMembershipInfo(id) {
  let sendingData = {
    action: "get_membership_info",
    id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/membership.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response["id"]);
        $("#card").val(response["Card"]);
        $("#name").val(response["Name"]);
        $("#gender").val(response["Gender"]);
        $("#email").val(response["Email"]);
        $("#phone").val(response["Phone"]);
        $("#location").val(response["Location"]);
        $("#semId").val(response["semId"]);
        $("#membershipModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

function deleteMembershipInfo(id) {
  let sendingData = {
    action: "delete_membership_info",
    id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/membership.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        Swal.fire("Good job!", response, "success");
        loadData();
      } else {
        Swal.fire("Error!", response, "Error");
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

$("#membershipTable").on("click", "a.update_info", function () {
  let id = $(this).data("update-id");
  fetchMembershipInfo(id);
});

$("#membershipTable").on("click", "a.delete_info", function () {
  let id = $(this).data("delete-id");

  Swal.fire({
    title: "Are you sure?",
    text: "if you want to delete this employee Check",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        deleteMembershipInfo(id),
        "Your file has been deleted.",
        "success"
      );
    }
  });

  // deleteEmployeeInfo(id);
});


// Read All Memvership Locations in a database
function fillAccounts() {
  let sendingData = {
    action: "read_locations",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Mails.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach((res) => {
          html += `<option value="${res}">${res}</option>`;
        });
        $("#city").append(html);
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

$(document).ready(function () {
  // Add event listener to the city select element
  $("#city").change(function () {
    // Clear the input text box
    $("#msgto").val("");
    // Call the function to fill the input text box with new values
    fillEmailsAssociations();
  });

  // Initial call to fill the input text box with values
  fillEmailsAssociations();
});


function fillEmailsAssociations() {
  let city = $("#city").val(); // Get the selected city value
  let sendingData = {
    action: "read_emails_all_assoc",
    city: city, // Add the city variable to the sendingData object
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Mails.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach((res, index) => {
          html += res;
          // Add comma if it's not the last email address
          if (index < response.length - 1) {
            html += ",";
          }
        });

        // Set the value of the input field
        $("#msgto").val(html);
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}
