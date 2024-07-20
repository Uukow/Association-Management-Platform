

let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/Transection.php",
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
fillAccounts();
fillOrganizations();
let btnAction = "Insert";

$("#addNew").on("click", function() {
  $("#transectionModal").modal("show");
});

$("#transectionForm").on("submit", function(event) {
  event.preventDefault();

  let title = $("#title").val();
  let org = $("#org").val();
  let type = $("#type").val();
  let date = $("#date").val();
  let number = $("#number").val();
  let name = $("#name").val();
  let memo = $("#memo").val();
  let split = $("#split").val();
  let category = $("#category").val();
  let amount = $("#amount").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "title": title,
      "org": org,
      "type": type,
      "date": date,
      "number": number,
      "name": name,
      "memo": memo,
      "split": split,
      "category": category,
      "amount": amount,
      "action": "register_transections"
    };
  } else {
    sendingData = {
      "id": id,
      "title": title,
      "org": org,
      "type": type,
      "date": date,
      "number": number,
      "name": name,
      "memo": memo,
      "split": split,
      "category": category,
      "amount": amount,
      "action": "update_transections"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Transection.php",
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
      $("#transectionModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#transectionForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#TransectionTable tbody").html('');
  let sendingData = {
      "action": "get_transections",
  };

  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Transection.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;

          if (status) {
              response.forEach(res => {
                  let tr = "<tr>";
                  for (let r in res) {
                      if (r === "id" || r === "AssociationName") {
                          continue; // Skip these fields
                      } else if (r === "Category") {
                          let categoryClass = res[r] === "Debit" ? "text-success fw-bold" : "text-danger fw-bold";
                          tr += `<td><span class="badge bg-light ${categoryClass}">${res[r]}</span></td>`;
                      } else if (r === "Date") {
                          tr += `<td><i class="uil uil-calender me-1"></i>${res[r]}</td>`;
                      } else {
                          tr += `<td>${res[r]}</td>`;
                      }
                  }

                  tr += `<td>
                      <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
                      <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
                  </td>`;
                  tr += "</tr>";

                  $("#TransectionTable tbody").append(tr);
              });
              // Initialize DataTable
              $("#TransectionTable").DataTable();
          } else {
              displayMessage("error", response);
          }
      },
      error: function(data) {
          // Handle error here
      }
  });
}


function fetchTransectionInfo(id) {
  let sendingData = {
    "action": "get_transections_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Transection.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#title").val(response['AccoutTitle']);
        $("#org").val(response['Org']);
        $("#type").val(response['Type']);
        $("#date").val(response['Date']);
        $("#number").val(response['Number']);
        $("#name").val(response['Name']);
        $("#memo").val(response['Memo']);
        $("#split").val(response['Split']);
        $("#category").val(response['Category']);
        $("#amount").val(response['Amount']);
        $("#transectionModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteTransectionInfo(id) {
  let sendingData = {
    "action": "delete_transections_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Transection.php",
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

$("#TransectionTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchTransectionInfo(id);
});

$("#TransectionTable").on('click', "a.delete_info", function() {
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
        deleteTransectionInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

});




// read all organizations 
function fillOrganizations() {
  let sendingData = {
    "action": "read_organizations",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Transection.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
          
        response.forEach( res => {

          html += `<option value="${res}">${res}</option>`
          
          
        })
        $("#org").append(html);
        
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}


// Read All Accounts in a database 
function fillAccounts() {
  let sendingData = {
    "action": "read_accounts",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Accounts.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
          
        response.forEach( res => {

          html += `<option value="${res}">${res}</option>`
          
          
        })
        $("#title").append(html);
        
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}