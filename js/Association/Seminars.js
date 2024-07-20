
let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/Siminars.php",
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
  $("#SiminarModal").modal("show");
});

$("#SiminarForm").on("submit", function(event) {
  event.preventDefault();

  let semid = $("#SiminarId").val();
  let title = $("#SiminarTitle").val();
  let partner = $("#SiminarPartner").val();
  let date = $("#SiminarData").val();
  let location = $("#SiminarLocation").val();
  let id = $("#update_id").val();
  

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "title": title,
      "partner": partner,
      "date": date,
      "location": location,
      "action": "register_siminar"
    };
  } else {
    sendingData = {
      "id": id,
      "title": title,
      "partner": partner,
      "date": date,
      "location": location,
      "action": "update_siminars"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Siminars.php",
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
  let success = $("#alert-success");
  let error = $("#alert-danger");

  if (type === "success") {
    error.addClass("d-none");
    success.removeClass("d-none");
    success.html(message);

    setTimeout(function() {
      $("#SiminarModal").modal("hide");
      success.addClass("d-none");
      $("#SiminarForm")[0].reset();
    }, 3000);
  } else {
    error.removeClass("d-none");
    error.html(message);
    success.addClass("d-none");
  }
}



function loadData() {
  $("#SiminarTable tbody").html("");
  let sendingData = {
    "action": "get_siminars",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Siminars.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          for (let key in res) {
            let cellContent = res[key];
            if (key === 'Status') {
              let badgeClass;
              switch (cellContent) {
                case 'Expired':
                  badgeClass = 'badge bg-danger text-light';
                  break;
                case 'Current Now':
                  badgeClass = 'badge bg-success text-light';
                  break;
                case 'Coming Soon':
                  badgeClass = 'badge bg-primary text-light';
                  break;
                default:
                  badgeClass = '';
              }
              tr += `<td><span class="${badgeClass}">${cellContent}</span></td>`;
            } else {
              tr += `<td>${cellContent}</td>`;
            }
          }

          tr += `<td>
          <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class="ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
          <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
      </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#SiminarTable tbody").html(html);
        $("#SiminarTable").DataTable();
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
//   $("#SiminarTable tbody").html("");
//   let sendingData = {
//     "action": "get_siminars",
//   };

//   $.ajax({
//     method: "POST",
//     dataType: "json",
//     url: "../Api/Association/Siminars.php",
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
//         $("#SiminarTable tbody").html(html);
//         $("#SiminarTable").DataTable();
//       } else {
//         displayMessage("error", response);
//       }
//     },
//     error: function(data) {
//       // Handle error here
//     }
//   });
// }

function fetchSiminarInfo(id) {
  let sendingData = {
    "action": "get_siminars_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Siminars.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#SiminarTitle").val(response['Title']);
        $("#SiminarPartner").val(response['Partner']);
        $("#SiminarData").val(response['Data']);
        $("#SiminarLocation").val(response['Location']);
        $("#SiminarModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}
function deleteSiminarInfo(id) {
  let sendingData = {
    "action": "delete_siminars_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Siminars.php",
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
          'error'
        );
      }
    },
    error: function(xhr, status, error) {
      if (xhr.status === 409) {
        Swal.fire(
          'Error!',
          'Cannot delete the seminar due to related records. Please remove the related records first.',
          'error'
        );
      } else {
        Swal.fire(
          'Error!',
          'An error occurred while deleting the seminar.',
          'error'
        );
      }
    }
  });
}

$(document).on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchSiminarInfo(id);
});

$("#SiminarTable").on('click', "a.delete_info", function() {
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
          deleteSiminarInfo(id),
          'Your file has been deleted.',
          'success'
        )
      }
    })
  
    // deleteEmployeeInfo(id);
  });
