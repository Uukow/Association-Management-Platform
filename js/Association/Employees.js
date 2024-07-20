
let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/Employees.php",
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


fillJobs();
loadData();
let btnAction = "Insert";

$("#addNew").on("click", function() {
  $("#employeeModal").modal("show");
  $("#statuss").parent().hide();
});

$("#employeeForm").on("submit", function(event) {
  event.preventDefault();

  let name = $("#name").val();
  let position = $("#position").val();
  let phone = $("#phone").val();
  let email = $("#email").val();
  let location = $("#location").val();
  let statuss = $("#statuss").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "name": name,
      "position": position,
      "phone": phone,
      "email": email,
      "location": location,
      "statuss": statuss,
      "action": "register_employees"
    };
  } else {
    sendingData = {
      "id": id,
      "name": name,
      "position": position,
      "phone": phone,
      "email": email,
      "location": location,
      "statuss": statuss,
      "action": "update_employees"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Employees.php",
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
      $("#employeeModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#employeeForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}





function loadData() {
  $("#EmployeeTable tbody").html('');
  let sendingData = {
    "action": "get_employees",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Employees.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          for (let key in res) {
            // Exclude 'id' from being added to the table rows
            if (key !== 'id') {
              let cellContent = res[key];
              if (key === 'Status') {
                let textColorClass = cellContent === 'Active' ? 'text-success font-weight-bold badge-success' : 'text-danger font-weight-bold';
                tr += `<td class="${textColorClass}">${cellContent}</td>`;
              } else {
                tr += `<td>${cellContent}</td>`;
              }
            }
          }

          tr += `<td>
            <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class="ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
            <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
          </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#EmployeeTable tbody").html(html);
        // Initialize DataTable
        $("#EmployeeTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}




// Read All Jobs

function fillJobs() {
  let sendingData = {
    "action": "read_all_associations_jobs",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Employees.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
          
        response.forEach( res => {

          html += `<option value="${res}">${res}</option>`
          
          
        })
        $("#position").append(html);
        
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
//   $("#EmployeeTable tbody").html('');
//   let sendingData = {
//     "action": "get_employees",
//   };

//   $.ajax({
//     method: "POST",
//     dataType: "json",
//     url: "../Api/Association/Employees.php",
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

          
//           tr += `<td>
//           <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
//           <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
//       </td>`;
//           tr += "</tr>";

//           html += tr;
//         });
//         $("#EmployeeTable tbody").html(html);
//         // Initialize DataTable
//         $("#EmployeeTable").DataTable();
//       } else {
//         displayMessage("error", response);
//       }
//     },
//     error: function(data) {
//       // Handle error here
//     }
//   });
// }

function fetchEmployeeInfo(id) {
  let sendingData = {
    "action": "get_employees_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Employees.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#name").val(response['Name']);
        $("#position").val(response['Position']);
        $("#phone").val(response['Phone']);
        $("#email").val(response['Email']);
        $("#location").val(response['Location']);
        $("#statuss").val(response['Status']);
        $("#statuss").parent().show(); // Show status input when updating
        $("#employeeModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteEmployeeInfo(id) {
  let sendingData = {
    "action": "delete_employees_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Employees.php",
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

$("#EmployeeTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchEmployeeInfo(id);
});

$("#EmployeeTable").on('click', "a.delete_info", function() {
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
        deleteEmployeeInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

  // deleteEmployeeInfo(id);
});