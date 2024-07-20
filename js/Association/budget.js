
let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/budget.php",
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
  $("#budgetModal").modal("show");
});

$("#budgetForm").on("submit", function(event) {
  event.preventDefault();

  let semId = $("#semId").val();
  let description = $("#description").val();
  let amount = $("#amount").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "semId": semId,
      "description": description,
      "amount": amount,
      "action": "register_budget"
    };
  } else {
    sendingData = {
      "id": id,
      "semId": semId,
      "description": description,
      "amount": amount,
      "action": "update_budget"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/budget.php",
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
      $("#budgetModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#budgetForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#budgetTable tbody").html('');
  let sendingData = {
    "action": "get_budget",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/budget.php",
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
          <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
          <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
      </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#budgetTable tbody").html(html);
        $("#budgetTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function fetchBudgetInfo(id) {
  let sendingData = {
    "action": "get_budget_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/budget.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#semId").val(response['SeminarID']);
        $("#description").val(response['Description']);
        $("#amount").val(response['Amount']);
        $("#budgetModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteBudgetInfo(id) {
  let sendingData = {
    "action": "delete_budget_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/budget.php",
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

$("#budgetTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchBudgetInfo(id);
});

$("#budgetTable").on('click', "a.delete_info", function() {
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
        deleteBudgetInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

});