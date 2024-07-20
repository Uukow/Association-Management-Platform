loadData();
let btnAction = "Insert";

$("#addNew").on("click", function () {
  $("#associationModal").modal("show");
});

$("#associationForm").on("submit", function (event) {
  event.preventDefault();

  let name = $("#name").val();
  let phone = $("#phone").val();
  let email = $("#email").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      name: name,
      phone: phone,
      email: email,
      action: "register_association",
    };
  } else {
    sendingData = {
      id : id,  
      name: name,
      phone: phone,
      email: email,
      action: "update_association",
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/associations.php",
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
      $("#associationModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#associationForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#associationTable tbody").html("");
  let sendingData = {
    action: "get_association",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/associations.php",
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
        $("#associationTable tbody").html(html);
        $("#associationTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

function fetchAssociationInfo(id) {
  let sendingData = {
    action: "get_association_info",
    id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/associations.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response["id"]);
        $("#name").val(response["Name"]);
        $("#email").val(response["Email"]);
        $("#phone").val(response["Phone"]);
        $("#associationModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

function deleteAssociationInfo(id) {
  let sendingData = {
    action: "delete_association_info",
    id: id,
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/associations.php",
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

$("#associationTable").on("click", "a.update_info", function () {
  let id = $(this).data("update-id");
  fetchAssociationInfo(id);
});

$("#associationTable").on("click", "a.delete_info", function () {
  let id = $(this).data("delete-id");

  Swal.fire({
    title: "Are you sure?",
    text: "if you want to delete this employee Check",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        deleteAssociationInfo(id),
        "Your file has been deleted.",
        "success"
      );
    }
  });

  // deleteEmployeeInfo(id);
});
