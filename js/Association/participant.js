
let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/participant.php",
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


// new DataTable("#participantTable");
let btnAction = "Insert";

$("#addNew").on("click", function() {
  $("#participantModal").modal("show");
});

$("#participantForm").on("submit", function(event) {
  event.preventDefault();

  let name = $("#name").val();
  let email = $("#email").val();
  let phone = $("#phone").val();
  let location = $("#location").val();
  let semid = $("#semId").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "name": name,
      "email": email,
      "phone": phone,
      "location": location,
      "semid": semid,
      "action": "register_participant"
    };
  } else {
    sendingData = {
      "id": id,
      "name": name,
      "email": email,
      "phone": phone,
      "location": location,
      "semid": semid,
      "action": "update_participant"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/participant.php",
    data: sendingData,
    success: function(data) {
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
    error: function(data) {
      // Handle error here
    }
  });
});

function displayMessage(type, message) {
  let success = document.querySelector("#alert-success");
  let error = document.querySelector("#alert-danger");

  if (type === "success") {
    error.classList = "alert alert-danger d-none";
    success.classList = "alert alert-success";
    success.innerHTML = message;

    setTimeout(function() {
      $("#participantModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#participantForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#participantTable tbody").html('');
  let sendingData = {
    "action": "get_participant",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/participant.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          for (let key in res) {
            if (key !== 'id') { // Exclude 'id' from being added to the table rows
              tr += `<td>${res[key]}</td>`;
            }
          }

          tr += `<td>
            <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class="ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
            <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
          </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#participantTable tbody").html(html);
        $("#participantTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}



//  // Function to show participant details in a modal
//  function showParticipantDetails(id) {
//   let sendingData = {
//     "action": "get_participant_info",
//     "id": id
//   };

//   $.ajax({
//     method: "POST",
//     dataType: "json",
//     url: "../Api/Association/participant.php",
//     data: sendingData,
//     success: function(data) {
//       let status = data.status;
//       let response = data.data;

//       if (status) {
//         $("#viewBtn").hide();
//         $("#update_id").val(response['id']);
//         $("#pName").text("Name: " + response['Name']);
//         $("#pEmail").text("Name: " + response['Email']);
//         $("#pPhone").text("Name: " + response['Phone']);
//         $("#pLocation").text("Name: " + response['Location']);
//         $("#pSemId").text("Name: " + response['SemId']);
//         $("#participantModalDetails").modal("show");
//       } else {
//         displayMessage("error", response);
//       }
//     },
//     error: function(data) {
//       // Handle error here
//     }
//   });
// }

// // Function to display success or error messages
// function displayMessage(type, message) {
//   let success = $("#alert-success");
//   let error = $("#alert-danger");

//   if (type === "success") {
//     error.addClass("d-none");
//     success.removeClass("d-none").addClass("alert-success").html(message);

//     setTimeout(function() {
//       $("#participantModal").modal("hide");
//       success.addClass("d-none");
//       $("#participantForm")[0].reset();
//     }, 3000);
//   } else {
//     error.removeClass("d-none").addClass("alert-danger").html(message);
//     success.addClass("d-none");
//   }
// }

//fethching data

function fetchParticipantInfo(id) {
  let sendingData = {
    "action": "get_participant_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/participant.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#name").val(response['Name']);
        $("#email").val(response['Email']);
        $("#phone").val(response['Phone']);
        $("#location").val(response['Location']);
        $("#semId").val(response['SemId']);
        $("#participantModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteParticipantInfo(id) {
  let sendingData = {
    "action": "delete_participant_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/participant.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        Swal.fire(
          'Good job!',
          response,
          'success'
        );
        loadData();
      } else {
        Swal.fire(
          'Error!',
          response,
          'Error'
        );
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}



$("#participantTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchParticipantInfo(id);
});


$("#participantTable").on('click', "a.delete_info", function() {
  let id = $(this).data('delete-id');


  Swal.fire({
    title: 'Are you sure?',
    text: "if you want to delete this employee Check",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        deleteParticipantInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

  // deleteEmployeeInfo(id);
});




// $("#participantTable").on('click', "a.view_info", function() {
//   let id = $(this).data('view-id');
//   showParticipantDetails(id);
// });



