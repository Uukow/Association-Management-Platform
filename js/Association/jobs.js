let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/jobs.php",
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
  $("#jobModal").modal("show");
});

$("#jobsForm").on("submit", function(event) {
  event.preventDefault();

  let jobTitle = $("#jobTitle").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "jobTitle": jobTitle,
      "action": "register_jobs"
    };
  } else {
    sendingData = {
      "id": id,
      "jobTitle": jobTitle,
      "action": "update_jobs"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/jobs.php",
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
      $("#jobModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#jobsForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}





function loadData() {
  $("#jobsTable tbody").html('');
  let sendingData = {
    "action": "get_jobs",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/jobs.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          for (let key in res) {
            if (key !== 'id' && key !== 'AssociationName') { // Exclude 'id' and 'AssociationName' from being added to the table rows
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
        $("#jobsTable tbody").html(html);
        // Initialize DataTable
        $("#jobsTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}






function fetchJobInfo(id) {
  let sendingData = {
    "action": "get_jobs_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/jobs.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#jobTitle").val(response['jobTitle']);
        $("#jobModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteJobInfo(id) {
  let sendingData = {
    "action": "delete_jobs_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/jobs.php",
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

$("#jobsTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchJobInfo(id);
});

$("#jobsTable").on('click', "a.delete_info", function() {
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
        deleteJobInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

  // deleteEmployeeInfo(id);
});