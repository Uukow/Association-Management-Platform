loadData();
let btnAction = "Insert";

$("#addNew").on("click", function() {
  $("#projectModal").modal("show");
});

$("#projectForm").on("submit", function(event) {
  event.preventDefault();

  let name = $("#name").val();
  let duration = $("#duration").val();
  let donor = $("#donor").val();
  let type = $("#type").val();
  let location = $("#location").val();
  let person = $("#person").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "name": name,
      "duration": duration,
      "donor": donor,
      "type": type,
      "location": location,
      "person" : person,
      "action": "register_project"
    };
  } else {
    sendingData = {
      "id": id,
      "name": name,
      "duration": duration,
      "donor": donor,
      "type": type,
      "location": location,
      "person" : person,
      "action": "update_project"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/projects.php",
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
      $("#projectModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#projectForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#projectTable tbody").html('');
  let sendingData = {
    "action": "get_project",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/projects.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          
          // Exclude 'id' from being added to the table rows
          Object.keys(res).forEach(key => {
            if (key !== 'id') {
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
          });

          tr += `<td>
          <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
          <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
      </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#projectTable tbody").html(html);
        $("#projectTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}


function fetchProjectInfo(id) {
  let sendingData = {
    "action": "get_project_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/projects.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#name").val(response['Name']);
        $("#duration").val(response['Duration']);
        $("#donor").val(response['Donor']);
        $("#type").val(response['Type']);
        $("#location").val(response['Location']);
        $("#person").val(response['Person']);
        $("#projectModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteProjectInfo(id) {
  let sendingData = {
    "action": "delete_project_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/projects.php",
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

$("#projectTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchProjectInfo(id);
});

$("#projectTable").on('click', "a.delete_info", function() {
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
        deleteProjectInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

});