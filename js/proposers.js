


loadData();
let btnAction = "Insert";

$("#addNew").on("click", function() {
  $("#proposerModal").modal("show");
});

$("#proposerForm").on("submit", function(event) {
  event.preventDefault();

  let semId = $("#semId").val();
  let name = $("#name").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "semId": semId,
      "name": name,
      "action": "register_proposers"
    };
  } else {
    sendingData = {
      "id": id,
      "semId": semId,
      "name": name,
      "action": "update_proposers"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/proposers.php",
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
      $("#proposerModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#proposerForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}


function loadData() {
  $("#proposerTable tbody").html('');
  let sendingData = {
    "action": "get_proposers",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/proposers.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(res => {
          let tr = "<tr>";
          // Iterate through each key in res excluding 'id'
          Object.keys(res).forEach(key => {
            if (key !== 'id') {
              tr += `<td>${res[key]}</td>`;
            }
          });

          tr += `<td>
          <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
          <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
      </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#proposerTable tbody").html(html);
        $("#proposerTable").DataTable();
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
//   $("#proposerTable tbody").html('');
//   let sendingData = {
//     "action": "get_proposers",
//   };

//   $.ajax({
//     method: "POST",
//     dataType: "json",
//     url: "../Api/proposers.php",
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
//         $("#proposerTable tbody").html(html);
//         $("#proposerTable").DataTable();
//       } else {
//         displayMessage("error", response);
//       }
//     },
//     error: function(data) {
//       // Handle error here
//     }
//   });
// }

function fetchProposerInfo(id) {
  let sendingData = {
    "action": "get_proposers_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/proposers.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#semId").val(response['SeminarID']);
        $("#name").val(response['ProposerName']);
        $("#proposerModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteProposerInfo(id) {
  let sendingData = {
    "action": "delete_proposers_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/proposers.php",
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

$("#proposerTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchProposerInfo(id);
});

$("#proposerTable").on('click', "a.delete_info", function() {
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
        deleteProposerInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

});