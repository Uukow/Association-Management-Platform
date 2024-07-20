loadData();
// Read All In database Attendence 
function loadData() {
  $("#AttendanceTable tbody").html("");
  let sendingData = {
    action: "read_attendence",
  };

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Attendence.php",
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
          &nbsp;&nbsp;
          <input type="checkbox" name="attendance2" value="present" class="form-check-input">
      </td>`;
          tr += "</tr>";

          html += tr;
        });
        $("#AttendanceTable tbody").html(html);
        $("#AttendanceTable").DataTable();
      } else {
        displayMessage("error", response);
      }
    },
    error: function (data) {
      // Handle error here
    },
  });
}

// Registration The Attendence Using Checkbox in Table

$(document).ready(function () {
  loadData();

  $("#registerAttendanceBtn").click(function () {
      let attendanceData = [];

      $("#AttendanceTable tbody tr").each(function () {
          let row = $(this);
          let employeeID = row.find("td:eq(0)").text();
          let name = row.find("td:eq(1)").text();
          let attendanceDate = row.find("td:eq(2)").text();
          let status = row.find("td:eq(3)").text();
          let isChecked = row.find('input[name="attendance2"]').is(":checked") ? "present" : "absent";

          attendanceData.push({
              EmployeeID: employeeID,
              Name: name,
              AttendanceDate: attendanceDate,
              Status: isChecked,
          });
      });

      Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to update the attendance for today?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, update it!'
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  method: "POST",
                  dataType: "json",
                  url: "../Api/Association/Attendence.php",
                  data: {
                      action: "register_attendance",
                      attendanceData: attendanceData,
                  },
                  success: function (response) {
                      if (response.status) {
                          Swal.fire(
                              'Updated!',
                              'Attendance has been Submited Successfully.',
                              'success'
                          );
                          loadData(); // Reload data to reflect changes
                      } else {
                          displayMessage("error", response.data);
                      }
                  },
                  error: function (response) {
                      // Handle error here
                  },
              });
          }
      });
  });
});