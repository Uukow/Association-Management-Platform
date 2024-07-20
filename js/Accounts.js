loadData();
let btnAction = "Insert";

$("#addNew").on("click", function () {
  $("#accountModal").modal("show");
});

$("#accountForm").on("submit", function (event) {
  event.preventDefault();

  let title = $("#title").val();
  let number = $("#number").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      title: title,
      number: number,

      action: "register_accounts",
    };
  } else {
    sendingData = {
      id: id,
      title: title,
      number: number,
      action: "update_accounts",
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Accounts.php",
    data: sendingData,
    success: function (data) {
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
    error: function (data) {
      // Handle error here
    },
  });
});

function displayMessage(type, message) {
  let success = document.querySelector("#alert-success");
  let error = document.querySelector("#alert-danger");

  if (type === "success") {
    error.classList = "alert alert-danger d-none";
    success.classList = "alert alert-success";
    success.innerHTML = message;

    setTimeout(function () {
      $("#accountModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#accountForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#accountTable tbody").html("");
  let sendingData = {
    action: "get_accounts",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Accounts.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach((res) => {
          let tr = "<tr>";
          for (let r in res) {
            tr += `<td>${res[r]}</td>`;
          }

          tr += `<td>
          <a class="btn btn-info update_info" data-update-id="${res["id"]}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
          <a class="btn btn-danger delete_info" data-delete-id="${res["id"]}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
      </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#accountTable tbody").html(html);
        // Initialize DataTable
        $("#accountTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

function fetchAccountInfo(id) {
  let sendingData = {
    action: "get_accounts_info",
    id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Accounts.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response["id"]);
        $("#title").val(response["AccountTitle"]);
        $("#number").val(response["AccountNo"]);
        $("#accountModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

function deleteAccountInfo(id) {
  let sendingData = {
    action: "delete_accounts_info",
    id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Accounts.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        Swal.fire("Good job!", response, "success");
        loadData();
      } else {
        Swal.fire("Error!", response, "Error");
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

$("#accountTable").on("click", "a.update_info", function () {
  let id = $(this).data("update-id");
  fetchAccountInfo(id);
});

$("#accountTable").on("click", "a.delete_info", function () {
  let id = $(this).data("delete-id");

  Swal.fire({
    title: "Are you sure?",
    text: "if you want to delete this Account Check",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        deleteAccountInfo(id),
        "Your file has been deleted.",
        "success"
      );
    }
  });
});
