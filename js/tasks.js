let associationName = '';

// Fetch the association name from the server
$.ajax({
    method: "GET",
    dataType: "json",
    url: "../Api/Association/Tasks.php",
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

let btnAction = "Insert";


// Display All Tables first
loadDataTasks();
loadDataProgress();
loadDataComplete();


$("#addNew").on("click", function() {
    $("#taskModal").modal("show");
});

// // update form

// update the test into progress
$(document).ready(function() {
  $("#updateForm").on("submit", function(event) {
      event.preventDefault();

      let id = $("#update_id").val();
      let wax = $("#wax").val(); // Ensure this matches the ID of your select element
      console.log("Selected status is", wax);

      let sendingData = {
          "id": id,
          "wax": wax,
          "action": "update_tasks"
      };

      $.ajax({
          method: "POST",
          dataType: "json",
          url: "../Api/Association/Tasks.php",
          data: sendingData,
          success: function(data) {
            let status = data.status;
            let response = data.data;
        
            if (status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response,
                    onClose: () => {
                        btnAction = "Insert";
                        loadDataTasks();
                    }
                });
                setTimeout(function() {
                  loadDataTasks();
                  $("#updateModal").modal("hide");
                  $("#updateForm")[0].reset();
                }, 3000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response
                });
            }
                
          },
          error: function(xhr, status, error) {
              console.error("An error occurred while registering/updating the task:", error);
          }
      });
  });
});

// update the progress into Complete
$(document).ready(function() {
  $("#updateForm").on("submit", function(event) {
      event.preventDefault();

      let id = $("#update_id").val();
      let wax = $("#wax").val(); // Ensure this matches the ID of your select element
      console.log("Selected status is", wax);

      let sendingData = {
          "id": id,
          "wax": wax,
          "action": "update_tasks"
      };

      $.ajax({
          method: "POST",
          dataType: "json",
          url: "../Api/Association/Tasks.php",
          data: sendingData,
          success: function(data) {
            let status = data.status;
            let response = data.data;
        
            if (status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response,
                    onClose: () => {
                        btnAction = "Insert";
                        loadDataProgress();
                    }
                });
                setTimeout(function() {
                  loadDataProgress();
                  $("#updateModal").modal("hide");
                  $("#updateForm")[0].reset();
                }, 3000);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response
                });
            }
                
          },
          error: function(xhr, status, error) {
              console.error("An error occurred while registering/updating the task:", error);
          }
      });
  });
});


// register Tasks
$("#taskForm").on("submit", function(event) {
    event.preventDefault();

    let empId = $("#empId").val();
    let description = $("#description").val();
    let type = $("#type").val();
    let startDate = $("#startDate").val();
    let endDate = $("#endDate").val();
    let statuss = $("#statuss").val();
    let id = $("#update_id").val();

    let sendingData = {};

    if (btnAction === "Insert") {
        sendingData = {
            "empId": empId,
            "description": description,
            "type": type,
            "startDate": startDate,
            "endDate": endDate,
            "statuss": statuss,
            "action": "register_tasks"
        };
    } else {
        sendingData = {
            "id": id,
            "statuss": statuss,
            "action": "update_tasks"
        };
    }

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                displayMessage("success", response);
                btnAction = "Insert";
                loadDataTasks();
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            console.error("An error occurred while registering/updating the task.");
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
            $("#taskModal").modal("hide");
            success.classList = "alert alert-success d-none";
            $("#taskForm")[0].reset();
        }, 3000);
    } else {
        error.classList = "alert alert-danger";
        error.innerHTML = message;
        success.classList = "alert alert-success d-none";
    }
}

// read all tasks
function loadDataTasks() {
    $("#pendingTable tbody").html('');
    let sendingData = {
        "action": "get_tasks",
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;
            let html = "";

            if (status) {
                response.forEach(res => {
                    let tr = "<tr>";
                    for (let key in res) {
                        // Exclude 'id' from being added to the table rows
                        if (key !== 'id') {
                            let cellContent = res[key];
                            if (key === 'status') {
                                let textColorClass = cellContent === 'Complete' ? 'text-success font-weight-bold badge-success' : 'text-danger font-weight-bold';
                                tr += `<td class="${textColorClass}">${cellContent}</td>`;
                            } else {
                                tr += `<td style="white-space: normal;">${cellContent}</td>`;
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
                $("#pendingTable tbody").html(html);
                // Initialize DataTable
                $("#pendingTable").DataTable();
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            console.error("An error occurred while loading tasks.");
        }
    });
}

// read all in progress
function loadDataProgress() {
    $("#progressTable tbody").html('');
    let sendingData = {
        "action": "get_progress",
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;
            let html = "";

            if (status) {
                response.forEach(res => {
                    let tr = "<tr>";
                    for (let key in res) {
                        // Exclude 'id' from being added to the table rows
                        if (key !== 'id') {
                            let cellContent = res[key];
                            if (key === 'status') {
                                let textColorClass = cellContent === 'in progress' ? 'text-primary font-weight-bold badge-success' : 'text-danger font-weight-bold';
                                tr += `<td class="${textColorClass}">${cellContent}</td>`;
                            } else {
                                tr += `<td style="white-space: normal;">${cellContent}</td>`;
                            }
                        }
                    }

                    tr += `<td>
                        <a class="btn btn-info update_info" data-update-id="${res['id']}"><i class="ri-ball-pen-fill" style="color:#fff"></i></a>&nbsp;&nbsp;
                        
                    </td>`;
                    tr += "</tr>";

                    html += tr;
                });
                $("#progressTable tbody").html(html);
                // Initialize DataTable
                $("#progressTable").DataTable();
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            console.error("An error occurred while loading tasks.");
        }
    });
}

// read all in progress
function loadDataComplete() {
    $("#completeTable tbody").html('');
    let sendingData = {
        "action": "get_complete",
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;
            let html = "";

            if (status) {
                response.forEach(res => {
                    let tr = "<tr>";
                    for (let key in res) {
                        // Exclude 'id' from being added to the table rows
                        if (key !== 'id') {
                            let cellContent = res[key];
                            if (key === 'status') {
                                let textColorClass = cellContent === 'completed' ? 'text-success font-weight-bold badge-success' : 'text-danger font-weight-bold';
                                tr += `<td class="${textColorClass}">${cellContent}</td>`;
                            } else {
                                tr += `<td style="white-space: normal;">${cellContent}</td>`;
                            }
                        }
                    }

                    tr += `<td>
                        
                        <a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="ri-delete-bin-5-fill" style="color:#fff"></i></a>
                    </td>`;
                    tr += "</tr>";

                    html += tr;
                });
                $("#completeTable tbody").html(html);
                // Initialize DataTable
                $("#completeTable").DataTable();
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            console.error("An error occurred while loading tasks.");
        }
    });
}

// Fetch One Task In  that Table
function fetchTaskInfo(id) {
    let sendingData = {
        "action": "get_tasks_info",
        "id": id
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                $("#update_id").val(response['id']);
                $("#statuss").val(response['status']);
                $("#updateModal").modal("show");
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            console.error("An error occurred while fetching task info.");
        }
    });
}

// Fetch One Task In  that Table
function fetchProgressInfo(id) {
    let sendingData = {
        "action": "get_progress_info",
        "id": id
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                $("#update_id").val(response['id']);
                $("#statuss").val(response['status']);
                $("#updateModal").modal("show");
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            console.error("An error occurred while fetching task info.");
        }
    });
}

// Fetch One Compete In  that Table
function fetchCompleteInfo(id) {
    let sendingData = {
        "action": "get_complete_info",
        "id": id
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                $("#update_id").val(response['id']);
                $("#statuss").val(response['status']);
                $("#updateModal").modal("show");
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            console.error("An error occurred while fetching task info.");
        }
    });
}

// delete task
function deleteTaskInfo(id) {
    let sendingData = {
        "action": "delete_tasks_info",
        "id": id
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
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
                loadDataTasks();
            } else {
                Swal.fire(
                    'Error!',
                    response,
                    'error'
                );
            }
        },
        error: function(data) {
            console.error("An error occurred while deleting the task.");
        }
    });
}
// delete Complete
function deleteProgressInfo(id) {
    let sendingData = {
        "action": "delete_progress_info",
        "id": id
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/Tasks.php",
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
                loadDataComplete();
            } else {
                Swal.fire(
                    'Error!',
                    response,
                    'error'
                );
            }
        },
        error: function(data) {
            console.error("An error occurred while deleting the task.");
        }
    });
}

// pending
$("#pendingTable").on('click', "a.update_info", function() {
    let id = $(this).data('update-id');
    fetchTaskInfo(id);
});

$("#pendingTable").on('click', "a.delete_info", function() {
    let id = $(this).data('delete-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "if you want to delete this task Check",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteTaskInfo(id);
        }
    });
});


// progress
$("#progressTable").on('click', "a.update_info", function() {
    let id = $(this).data('update-id');
    fetchProgressInfo(id);
});

$("#progressTable").on('click', "a.delete_info", function() {
    let id = $(this).data('delete-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "if you want to delete this task Check",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            de(id);
        }
    });
});


// Complete
$("#completeTable").on('click', "a.update_info", function() {
    let id = $(this).data('update-id');
    fetchCompleteInfo(id);
});

$("#completeTable").on('click', "a.delete_info", function() {
    let id = $(this).data('delete-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "if you want to delete this task Check",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteProgressInfo(id);
        }
    });
});
