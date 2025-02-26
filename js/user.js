let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/users.php",
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
let btnAction = "Insert";

$("#addNew").on("click", function() {
  $("#userModal").modal("show");
  $("#statuss").parent().hide(); // Show status input when updating
});

$("#userForm").on("submit", function(event) {
  event.preventDefault();

  let name = $("#name").val();
  let username = $("#username").val();
  let password = $("#password").val();
  let role = $("#role").val();
  let statuss = $("#statuss").val();
  let email = $("#email").val();
  let verify = $("#verify").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "name": name,
      "username": username,
      "password": password,
      "role": role,
      "statuss": statuss,
      "email": email,
      "verify": verify,
      "associationName": associationName,
      "action": "register_user"
    };
  } else {
    sendingData = {
      "id": id,
      "name": name,
      "username": username,
      "password": password,
      "role": role,
      "statuss": statuss,
      "email": email,
      "verify": verify,
      "associationName": associationName,
      "action": "update_user"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/users.php",
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
      $("#userModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#userForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}





function loadData() {
  $("#userTable tbody").html('');
  let sendingData = {
    "action": "get_user",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/users.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          for (let r in res) {
            // Check if the field is joinDate
            if (r === 'joinDate') {
              tr += `<td>${res[r]}</td>`; // Assuming joinDate is already formatted as desired
            } else {
              tr += `<td>${res[r]}</td>`;
            }
          }

          tr += `<td>
          <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
          <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
      </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#userTable tbody").html(html);
        $("#userTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}









// function loadData() {
//   $("#userTable tbody").html('');
//   let sendingData = {
//     "action": "get_user",
//   };

//   $.ajax({
//     method: "POST",
//     dataType: "json",
//     url: "../Api/users.php",
//     data: sendingData,
//     success: function(data) {
//       let status = data.status;
//       let response = data.data;
//       let html = "";

//       if (status) {
//         response.forEach(res => {
//           let tr = "<tr>";
//           for (let r in res) {
//             tr += `<td>${res[r]}</td>`;
//           }

//           tr += `<td><a class="btn btn-info update_info" data-update-id="${res['id']}"><i class="fa-solid fa-pen" style="color:#fff"></i></a>&nbsp;&nbsp;<a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="fa-solid fa-trash" style="color:#fff"></i></a></td>`;
//           tr += "</tr>";

//           html += tr;
//         });
//         $("#userTable tbody").html(html);
//         $("#userTable").DataTable();
//       } else {
//         displayMessage("error", response);
//       }
//     },
//     error: function(data) {
//       // Handle error here
//     }
//   });
// }

function fetchUserInfo(id) {
  let sendingData = {
    "action": "get_user_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/users.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#name").val(response['Name']);
        $("#username").val(response['Username']);
        $("#password").val(response['Password']);
        $("#role").val(response['role']);
        $("#statuss").val(response['status']);
        $("#email").val(response['Email']);
        $("#verify").val(response['Verify']);
        $("#statuss").parent().show(); // Show status input when updating
        $("#userModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteUserInfo(id) {
  let sendingData = {
    "action": "delete_user_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/users.php",
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

$("#userTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchUserInfo(id);
});

$("#userTable").on('click', "a.delete_info", function() {
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
        deleteUserInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })


});