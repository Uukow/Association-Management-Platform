loadData();
let btnAction = "Insert";
fillLinks();

$("#addNew").on("click", function() {
  $("#actionModal").modal("show");
});

$("#actionForm").on("submit", function(event) {
  event.preventDefault();

  let name = $("#name").val();
  let systemAction = $("#action").val();
  let linkId = $("#linkId").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "name": name,
      "systemAction": systemAction,
      "link": linkId,
      "action": "register_action"
    };
  } else {
    sendingData = {
      "id": id,
      "name": name,
      "systemAction": systemAction,
      "link": linkId,
      "action": "update_action"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/systemAction.php",
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
      $("#actionModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#actionForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#actionTable tbody").html('');
  let sendingData = {
    "action": "get_action",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/systemAction.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          for (let r in res) {
            tr += `<td>${res[r]}</td>`;
          }

          tr += `<td><a class="btn btn-info update_info" data-update-id="${res['id']}"><i class="fa-solid fa-pen" style="color:#fff"></i></a>&nbsp;&nbsp;<a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="fa-solid fa-trash" style="color:#fff"></i></a></td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#actionTable tbody").html(html);
        $("#actionTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}


function fillLinks() {
    let sendingData = {
      "action": "get_link",
    };
  
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/systemLinks.php",
      data: sendingData,
      success: function(data) {
        let status = data.status;
        let response = data.data;
        let html = "";
  
        if (status) {
            
          response.forEach( res => {

            html += `<option value="${res['id']}">${res['name']}</option>`
            
            
          })
          $("#linkId").append(html);
          
        } else {
          displayMessage("error", response);
        }
      },
      error: function(data) {
        // Handle error here
      }
    });
  }


function fetchActionInfo(id) {
  let sendingData = {
    "action": "get_action_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/systemAction.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#name").val(response['name']);
        $("#action").val(response['action']);
        $("#linkId").val(response['link_id']);
        $("#actionModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteActionInfo(id) {
  let sendingData = {
    "action": "delete_action_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/systemAction.php",
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

$("#actionTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchActionInfo(id);
});

$("#actionTable").on('click', "a.delete_info", function() {
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
        deleteActionInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

});