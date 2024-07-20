loadData();
let btnAction = "Insert";

$("#addNew").on("click", function() {
  $("#attendenceModal").modal("show");
});

$("#employeeForm").on("submit", function(event) {
  event.preventDefault();

  let empid = $("#empid").val();
  let name = $("#name").val();
  let attDate = $("#attDate").val();
  let statuss = $("#statuss").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "empid": empid,
      "name": name,
      "attDate": attDate,
      "statuss": statuss,
      "action": "register_attendence"
    };
  } else {
    sendingData = {
      "id": id,
      "empid": empid,
      "name": name,
      "attDate": attDate,
      "statuss": statuss,
      "action": "update_attendence"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/AttendenceC.php",
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
      $("#attendenceModal").modal("hide");
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
    $("#AttendenceTable tbody").html('');
    let sendingData = {
      "action": "get_attendence",
    };
  
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/AttendenceC.php",
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
                        let textColorClass = cellContent === 'Present' ? 'text-primary fw-bold bg-success' : 'text-danger fw-bold';
                        tr += `<td class="${textColorClass}">${cellContent}</td>`;
                    } else if (key === "AttendanceDate") {
                        tr += `<td><i class="uil uil-calender me-1"></i>${cellContent}</td>`;
                    } else {
                        tr += `<td>${cellContent}</td>`;
                    }
                }
            
  
            tr += `<td>
            <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class=" ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
            <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
        </td>`;
            tr += "</tr>";
  
            html += tr;
          });
          $("#AttendenceTable tbody").html(html);
          $("#AttendenceTable").DataTable();
        } else {
          displayMessage("error", response);
        }
      },
      error: function(data) {
        // Handle error here
      }
    });
  }
  




function fetchAttendenceInfo(id) {
  let sendingData = {
    "action": "get_attendence_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/AttendenceC.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#empid").val(response['EmployeeID']);
        $("#name").val(response['Name']);
        $("#attDate").val(response['AttendanceDate']);
        $("#statuss").val(response['Status']);
        $("#attendenceModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteAttendenceInfo(id) {
  let sendingData = {
    "action": "delete_attendence_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/AttendenceC.php",
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

$("#AttendenceTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchAttendenceInfo(id);
});

$("#AttendenceTable").on('click', "a.delete_info", function() {
  let id = $(this).data('delete-id');


  Swal.fire({
    title: 'Are you sure?',
    text: "if you want to delete this Attendence Check",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        deleteAttendenceInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

  // deleteEmployeeInfo(id);
});