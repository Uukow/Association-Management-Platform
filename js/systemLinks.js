loadData();
let btnAction = "Insert";
fillLinks();
fillCategories();

$("#addNew").on("click", function() {
  $("#linkModal").modal("show");
});

$("#linkForm").on("submit", function(event) {
  event.preventDefault();

  let name = $("#name").val();
  let linkId = $("#linkId").val();
  let category = $("#categoryId").val();
  let id = $("#update_id").val();

  let sendingData = {};

  if (btnAction === "Insert") {
    sendingData = {
      "name": name,
      "link": linkId,
      "category": category,
      
      "action": "register_link"
    };
  } else {
    sendingData = {
      "id": id,
      "name": name,
      "link": linkId,
      "category": category,
      "action": "update_link"
    };
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/systemLinks.php",
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
      $("#linkModal").modal("hide");
      success.classList = "alert alert-success d-none";
      $("#linkForm")[0].reset();
    }, 3000);
  } else {
    error.classList = "alert alert-danger";
    error.innerHTML = message;
    success.classList = "alert alert-success d-none";
  }
}

function loadData() {
  $("#linkTable tbody").html('');
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
        response.forEach(res => {
          let tr = "<tr>";
          for (let r in res) {
            tr += `<td>${res[r]}</td>`;
          }

          tr += `<td><a class="btn btn-info update_info" data-update-id="${res['id']}"><i class="fa-solid fa-pen" style="color:#fff"></i></a>&nbsp;&nbsp;<a class="btn btn-danger delete_info" data-delete-id="${res['id']}"><i class="fa-solid fa-trash" style="color:#fff"></i></a></td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#linkTable tbody").html(html);
        $("#linkTable").DataTable();
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
      "action": "read_all_system_links",
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

            html += `<option value="${res}">${res}</option>`
            
            
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

  function fillCategories() {
    let sendingData = {
      "action": "get_category",
    };
  
    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/category.php",
      data: sendingData,
      success: function(data) {
        let status = data.status;
        let response = data.data;
        let html = "";
  
        if (status) {
            
          response.forEach( res => {

            html += `<option value="${res['id']}">${res['name']}</option>`
            
            
          })
          $("#categoryId").append(html);
          
        } else {
          displayMessage("error", response);
        }
      },
      error: function(data) {
        // Handle error here
      }
    });
  }

function fetchLinkInfo(id) {
  let sendingData = {
    "action": "get_link_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/systemLinks.php",
    data: sendingData,
    success: function(data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";
        $("#update_id").val(response['id']);
        $("#name").val(response['name']);
        $("#linkId").val(response['link']);
        $("#categoryId").val(response['category_id']);
        $("#linkModal").modal("show");
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

function deleteLinkInfo(id) {
  let sendingData = {
    "action": "delete_link_info",
    "id": id
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/systemLinks.php",
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

$("#linkTable").on('click', "a.update_info", function() {
  let id = $(this).data('update-id');
  fetchLinkInfo(id);
});

$("#linkTable").on('click', "a.delete_info", function() {
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
        deleteLinkInfo(id),
        'Your file has been deleted.',
        'success'
      )
    }
  })

});