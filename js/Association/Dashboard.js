loadData();
totalDepit();
totalDepit2();
totalDepitPersentage();
totalCredit();
totalCredit2();
totalCreditPersentage();
totalBalance();
totalBalance2();
totalBalancePersentage();
loadUsers();
loadTransections();
totalProposers();
totalEmployees();
totalAccounts();
totalMembership();
totalSiminars();
totalParticipant();
totalPartners();
totalProjects();
totalPending();
totalJobs();
// simple_chart();
// tree_chart();







function loadData() {
  $("#LocationsContainer").html(''); // Clear previous content

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Dashboard.php", // Change this to the path of your PHP file
    data: { action: "read_locations" }, // Assuming this is how you identify the action
    success: function(data) {
      let status = data.status;
      let response = data.data;
      let html = "";

      if (status) {
        response.forEach(location => {
          html += `<div class="flex-grow-1 ms-2" id="LocationsContainer">
                      <div class="d-flex align-items-center mb-3">
                          <div class="flex-shrink-0">
                              <div class="avatar-sm rounded">
                                  <!-- Icon and styling -->
                                            <span class="avatar-title bg-warning-lighten text-warning border border-warning rounded-circle h3 my-0">
                                                <i class="mdi mdi-map-marker"></i>
                                            </span>
                                        
                              </div>
                          </div>
                          <div class="flex-grow-1 ms-2">
                              <a href="javascript:void(0);" class="h4 my-0 fw-semibold text-reset">${location}</a>
                          </div>
                          
                      </div>
                  </div>
                  <hr>`;
        });
        $("#LocationsContainer").html(html);
      } else {
        displayMessage("error", response);
      }
    },
    error: function(data) {
      // Handle error here
    }
  });
}

// Debit works
function totalDepit(){
  let sendingData = {
    "action": "get_total_debit"
};

// Send the AJAX request to the login.php file
$.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Dashboard.php",
    data: sendingData,
    success: function(data) {
        let status = data.status;
        let response = data.data;

        if (status) {
            document.querySelector(".totalDebit").innerText = "$ " + response['total']
          
        } else {
            
        }
    },
    error: function(data) {
        // Handle error here
        // This part of the code will be executed if the AJAX request encounters an error.
    }
});
}
function totalDepit2(){
  let sendingData = {
    "action": "get_total_debit"
};

// Send the AJAX request to the login.php file
$.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Dashboard.php",
    data: sendingData,
    success: function(data) {
        let status = data.status;
        let response = data.data;

        if (status) {
            document.querySelector("#totalDebit").innerText = "$ " + response['total']
          
        } else {
            
        }
    },
    error: function(data) {
        // Handle error here
        // This part of the code will be executed if the AJAX request encounters an error.
    }
});
}
function totalDepitPersentage(){
  let sendingData = {
    "action": "get_total_debit_percentage"
};

// Send the AJAX request to the login.php file
$.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Dashboard.php",
    data: sendingData,
    success: function(data) {
        let status = data.status;
        let response = data.data;

        if (status) {
            document.querySelector("#debitPercentage").innerText = response['debiPercentageTotal']
          
        } else {
            
        }
    },
    error: function(data) {
        // Handle error here
        // This part of the code will be executed if the AJAX request encounters an error.
    }
});
}

// Credit Works

function totalCredit(){
  let sendingData = {
    "action": "get_total_credit"
};

// Send the AJAX request to the login.php file
$.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Dashboard.php",
    data: sendingData,
    success: function(data) {
        let status = data.status;
        let response = data.data;

        if (status) {
            document.querySelector(".totalCredit").innerText = "$ " + response['totalCredit']
          
        } else {
            
        }
    },
    error: function(data) {
        // Handle error here
        // This part of the code will be executed if the AJAX request encounters an error.
    }
});
}
function totalCredit2(){
  let sendingData = {
    "action": "get_total_credit"
};

// Send the AJAX request to the login.php file
$.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Dashboard.php",
    data: sendingData,
    success: function(data) {
        let status = data.status;
        let response = data.data;

        if (status) {
            document.querySelector("#totalCredit").innerText = "$ " + response['totalCredit']
          
        } else {
            
        }
    },
    error: function(data) {
        // Handle error here
        // This part of the code will be executed if the AJAX request encounters an error.
    }
});
}
function totalCreditPersentage(){
  let sendingData = {
    "action": "get_total_credit_percentage"
};

// Send the AJAX request to the login.php file
$.ajax({
    method: "POST",
    dataType: "json",
    url: "../Api/Association/Dashboard.php",
    data: sendingData,
    success: function(data) {
        let status = data.status;
        let response = data.data;

        if (status) {
            document.querySelector("#creditPercentage").innerText = response['creditPercentageTotal']
          
        } else {
            
        }
    },
    error: function(data) {
        // Handle error here
        // This part of the code will be executed if the AJAX request encounters an error.
    }
});
}

// Read the balance

function totalBalance(){
    let sendingData = {
      "action": "get_total_balance"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalBalance").innerText = "$ " + response['balance']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
function totalBalance2(){
    let sendingData = {
      "action": "get_total_balance"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector(".totalBalance").innerText = "$ " + response['balance']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
// read the balance percentage
function totalBalancePersentage(){
    let sendingData = {
      "action": "get_total_balance_percentage"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#balancePercentage").innerText = response['difference']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }

// Read the Proposers Count

function totalProposers(){
    let sendingData = {
      "action": "get_total_proposers"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalUser").innerText = response['total_proposers']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
//   Employees
function totalEmployees(){
    let sendingData = {
      "action": "get_total_employees"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalEmployees").innerText = response['total_employees']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
//   Accounts
function totalAccounts(){
    let sendingData = {
      "action": "get_total_accounts"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalAccounts").innerText = response['total_accounts']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
//   membership
function totalMembership(){
    let sendingData = {
      "action": "get_total_membership"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalMembership").innerText = response['total_membership']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
//   Seminars
function totalSiminars(){
    let sendingData = {
      "action": "get_total_siminars"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalSiminars").innerText = response['total_siminars']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
//   participant
function totalParticipant(){
    let sendingData = {
      "action": "get_total_participant"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalParticipant").innerText = response['total_participant']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
//   partners
function totalPartners(){
    let sendingData = {
      "action": "get_total_partners"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalPartners").innerText = response['total_partners']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }
//   projects
function totalProjects(){
    let sendingData = {
      "action": "get_total_projects"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalProjects").innerText = response['total_projects']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }


//   projects
function totalPending(){
    let sendingData = {
      "action": "get_total_pending"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalPending").innerText = response['total_pending']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }


//   projects
function totalJobs(){
    let sendingData = {
      "action": "get_total_jobs"
  };
  
  // Send the AJAX request to the login.php file
  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/Association/Dashboard.php",
      data: sendingData,
      success: function(data) {
          let status = data.status;
          let response = data.data;
  
          if (status) {
              document.querySelector("#totalJobs").innerText = response['total_jobs']
            
          } else {
              
          }
      },
      error: function(data) {
          // Handle error here
          // This part of the code will be executed if the AJAX request encounters an error.
      }
  });
  }















// Read ALl Users
  function loadUsers() {
    $("#userTable tbody").html('');
    let sendingData = {
        "action": "get_user",
    };

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "../Api/Association/users.php",
        data: sendingData,
        success: function(data) {
            let status = data.status;
            let response = data.data;

            if (status) {
                response.forEach(res => {
                    let statusClass = res['status'] === 'Active' ? 'text-success font-weight-bold' : 'text-danger font-weight-bold';
                    let tr = `
                        <tr>
                            <td>
                                <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body">${res['Name']}</a></h5>
                                
                            </td>
                            <td>
                                <span class="text-muted font-13">Username</span> <br />
                                <span>${res['Username']}</span>
                            </td>
                            <td class="${statusClass}">
                                <span class="text-muted font-13">Status</span>
                                <h5 class="font-14 mt-1 fw-normal">${res['status']}</h5>
                            </td>
                            <td>
                                <span class="text-muted font-13">Last Seem</span>
                                <h5 class="font-14 mt-1 fw-normal">${res['joinDate']}</h5>
                            </td>
                            
                        </tr>`;
                    $("#userTable tbody").append(tr);
                });
                $("#userTable").DataTable(); // Initialize DataTable
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            // Handle error here
        }
    });
}



function loadTransections() {
    $("#TransectionTable tbody").html('');
    let sendingData = {
        "action": "get_transections_limit",
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
                // Slice the response array to get only the first 10 rows
                let firstTenRows = response.slice(0, 10);

                firstTenRows.forEach(res => {
                    let tr = "<tr>";
                    for (let r in res) {
                        if (r === "Category") {
                            let categoryClass = res[r] === "Debit" ? "text-success fw-bold" : "text-danger fw-bold";
                            tr += `<td><span class="badge bg-light ${categoryClass}">${res[r]}</span></td>`;
                        } else if (r === "Date") {
                            tr += `<td><i class="uil uil-calender me-1"></i>${res[r]}</td>`;
                        } else {
                            tr += `<td>${res[r]}</td>`;
                        }
                    }

                    tr += "</tr>";

                    $("#TransectionTable tbody").append(tr);
                });
            } else {
                displayMessage("error", response);
            }
        },
        error: function(data) {
            // Handle error here
        }
    });
}

// All charts in Dashboard

// pie chart tasks
$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChart"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var labels = [];
                var series = [];
                
                // Populate labels and series arrays
                data.forEach(function(item) {
                    labels.push(item.label);
                    series.push(parseInt(item.value));  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Labels:", labels);
                console.log("Series:", series);

                // Check if labels and series are populated
                if (labels.length > 0 && series.length > 0) {
                    simple_chart(labels, series); // Call function to render chart
                } else {
                    console.error("Labels or series array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function simple_chart(labels, series) {
    var colors = ["#727cf5", "#6c757d", "#0acf97", "#fa5c7c", "#e3eaef"],
        dataColors = document.querySelector("#simple-pie2").dataset.colors,
        options = {
            chart: { height: 320, type: "pie" },
            series: series,
            labels: labels,
            colors: dataColors ? dataColors.split(",") : colors,
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7,
            },
            responsive: [
                {
                    breakpoint: 600,
                    options: { chart: { height: 240 }, legend: { show: false } },
                },
            ],
        },
        chart = new ApexCharts(document.querySelector("#simple-pie2"), options);

    // Log options for debugging

    chart.render();
}





// pie chart Employees
$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChartEmployees"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var labels = [];
                var series = [];
                
                // Populate labels and series arrays
                data.forEach(function(item) {
                    labels.push(item.label);
                    series.push(parseInt(item.value));  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Labels:", labels);
                console.log("Series:", series);

                // Check if labels and series are populated
                if (labels.length > 0 && series.length > 0) {
                    simple_chart_employees(labels, series); // Call function to render chart
                } else {
                    console.error("Labels or series array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function simple_chart_employees(labels, series) {
    var colors = ["#727cf5", "#6c757d", "#0acf97", "#fa5c7c", "#e3eaef"],
        dataColors = document.querySelector("#simple-pie3").dataset.colors,
        options = {
            chart: { height: 320, type: "pie" },
            series: series,
            labels: labels,
            colors: dataColors ? dataColors.split(",") : colors,
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7,
            },
            responsive: [
                {
                    breakpoint: 600,
                    options: { chart: { height: 240 }, legend: { show: false } },
                },
            ],
        },
        chart = new ApexCharts(document.querySelector("#simple-pie3"), options);

    // Log options for debugging

    chart.render();
}











// pie chart Memberships
$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChartMemberships"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var labels = [];
                var series = [];
                
                // Populate labels and series arrays
                data.forEach(function(item) {
                    labels.push(item.label);
                    series.push(parseInt(item.value));  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Labels:", labels);
                console.log("Series:", series);

                // Check if labels and series are populated
                if (labels.length > 0 && series.length > 0) {
                    simple_chart_membership(labels, series); // Call function to render chart
                } else {
                    console.error("Labels or series array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function simple_chart_membership(labels, series) {
    var colors = ["#727cf5", "#6c757d", "#0acf97", "#fa5c7c", "#e3eaef"],
        dataColors = document.querySelector("#simple-pie4").dataset.colors,
        options = {
            chart: { height: 320, type: "pie" },
            series: series,
            labels: labels,
            colors: dataColors ? dataColors.split(",") : colors,
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 7,
            },
            responsive: [
                {
                    breakpoint: 600,
                    options: { chart: { height: 240 }, legend: { show: false } },
                },
            ],
        },
        chart = new ApexCharts(document.querySelector("#simple-pie4"), options);

    // Log options for debugging

    chart.render();
}




































// treemap tasks
$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChart"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var seriesData = [];
                
                // Populate seriesData array
                data.forEach(function(item) {
                    seriesData.push({ x: item.label, y: parseInt(item.value) });  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Series Data:", seriesData);

                // Check if seriesData is populated
                if (seriesData.length > 0) {
                    tree_chart(seriesData); // Call function to render chart
                } else {
                    console.error("Series data array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function tree_chart(seriesData) {
    var colors = ["#727cf5", "#0acf97", "#fa5c7c"],
        dataColors = document.querySelector("#basic-treemap").dataset.colors,
        options = {
            series: [
                {
                    data: seriesData
                }
            ],
            colors: dataColors ? dataColors.split(",") : colors,
            legend: { show: false },
            chart: { height: 350, type: "treemap" },
            title: { text: "Treemap Chart", align: "left" },
        },
        chart = new ApexCharts(document.querySelector("#basic-treemap"), options);

    // Log options for debugging
    console.log(options);

    chart.render();
}




// treemap tasks
$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChartEmployees"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var seriesData = [];
                
                // Populate seriesData array
                data.forEach(function(item) {
                    seriesData.push({ x: item.label, y: parseInt(item.value) });  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Series Data:", seriesData);

                // Check if seriesData is populated
                if (seriesData.length > 0) {
                    tree_chart_employees(seriesData); // Call function to render chart
                } else {
                    console.error("Series data array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function tree_chart_employees(seriesData) {
    var colors = ["#727cf5", "#0acf97", "#fa5c7c"],
        dataColors = document.querySelector("#basic-treemap1").dataset.colors,
        options = {
            series: [
                {
                    data: seriesData
                }
            ],
            colors: dataColors ? dataColors.split(",") : colors,
            legend: { show: false },
            chart: { height: 350, type: "treemap" },
            title: { text: "Treemap Chart", align: "left" },
        },
        chart = new ApexCharts(document.querySelector("#basic-treemap1"), options);

    // Log options for debugging
    console.log(options);

    chart.render();
}





// treemap tasks
$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChartMemberships"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var seriesData = [];
                
                // Populate seriesData array
                data.forEach(function(item) {
                    seriesData.push({ x: item.label, y: parseInt(item.value) });  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Series Data:", seriesData);

                // Check if seriesData is populated
                if (seriesData.length > 0) {
                    tree_chart_memberships(seriesData); // Call function to render chart
                } else {
                    console.error("Series data array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function tree_chart_memberships(seriesData) {
    var colors = ["#727cf5", "#0acf97", "#fa5c7c"],
        dataColors = document.querySelector("#basic-treemap2").dataset.colors,
        options = {
            series: [
                {
                    data: seriesData
                }
            ],
            colors: dataColors ? dataColors.split(",") : colors,
            legend: { show: false },
            chart: { height: 350, type: "treemap" },
            title: { text: "Treemap Chart", align: "left" },
        },
        chart = new ApexCharts(document.querySelector("#basic-treemap2"), options);

    // Log options for debugging
    console.log(options);

    chart.render();
}






















// radial Chart tasks

$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChart"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var labels = [];
                var series = [];
                
                // Populate labels and series arrays
                data.forEach(function(item) {
                    labels.push(item.label);
                    series.push(parseInt(item.value));  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Labels:", labels);
                console.log("Series:", series);

                // Check if labels and series are populated
                if (labels.length > 0 && series.length > 0) {
                    radial_chart(labels, series); // Call function to render chart
                } else {
                    console.error("Labels or series array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function radial_chart(labels, series) {
    var colors = ["#727cf5", "#0acf97", "#fa5c7c"],
        dataColors = document.querySelector("#circle-angle-radial").dataset.colors,
        options = {
            series: series,
            labels: labels,
            chart: {
                height: 350,
                type: 'radialBar'
            },
            colors: dataColors ? dataColors.split(",") : colors,
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                // By default this function returns the average of all series. The below is just an example of how you can customize it.
                                return w.globals.series.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            },
            legend: {
                show: true,
                floating: true,
                fontSize: '13px',
                position: 'left',
                offsetX: 10,
                offsetY: 10,
                labels: {
                    useSeriesColors: true
                },
                markers: {
                    size: 0
                },
                formatter: function (seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
                },
                itemMargin: {
                    horizontal: 1,
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        },
        chart = new ApexCharts(document.querySelector("#circle-angle-radial"), options);

    // Log options for debugging
    console.log(options);

    chart.render();
}

// radial Chart employees

$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChartEmployees"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var labels = [];
                var series = [];
                
                // Populate labels and series arrays
                data.forEach(function(item) {
                    labels.push(item.label);
                    series.push(parseInt(item.value));  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Labels:", labels);
                console.log("Series:", series);

                // Check if labels and series are populated
                if (labels.length > 0 && series.length > 0) {
                    radial_chart_employees(labels, series); // Call function to render chart
                } else {
                    console.error("Labels or series array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function radial_chart_employees(labels, series) {
    var colors = ["#727cf5", "#0acf97", "#fa5c7c"],
        dataColors = document.querySelector("#circle-angle-radial1").dataset.colors,
        options = {
            series: series,
            labels: labels,
            chart: {
                height: 350,
                type: 'radialBar'
            },
            colors: dataColors ? dataColors.split(",") : colors,
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                // By default this function returns the average of all series. The below is just an example of how you can customize it.
                                return w.globals.series.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            },
            legend: {
                show: true,
                floating: true,
                fontSize: '13px',
                position: 'left',
                offsetX: 10,
                offsetY: 10,
                labels: {
                    useSeriesColors: true
                },
                markers: {
                    size: 0
                },
                formatter: function (seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
                },
                itemMargin: {
                    horizontal: 1,
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        },
        chart = new ApexCharts(document.querySelector("#circle-angle-radial1"), options);

    // Log options for debugging
    console.log(options);

    chart.render();
}

// radial Chart Membership

$(document).ready(function() {
    // Prepare data to be sent in the AJAX request
    let sendingData = {
        "action": "loadChartMemberships"
    };
    
    $.ajax({
        url: '../Api/Association/Dashboard.php',
        type: 'POST',
        data: sendingData,
        dataType: "JSON",
        async: true,
        success: function(response) {
            // Check if data is received successfully
            if (response && response.status) {
                var data = response.data;
                if (!Array.isArray(data)) {
                    console.error("Unexpected data format: data is not an array.");
                    return;
                }
                
                var labels = [];
                var series = [];
                
                // Populate labels and series arrays
                data.forEach(function(item) {
                    labels.push(item.label);
                    series.push(parseInt(item.value));  // Ensure values are integers
                });

                // Log data for debugging
                console.log("Labels:", labels);
                console.log("Series:", series);

                // Check if labels and series are populated
                if (labels.length > 0 && series.length > 0) {
                    radial_chart_membership(labels, series); // Call function to render chart
                } else {
                    console.error("Labels or series array is empty.");
                }
            } else {
                console.error("Data status is false or data not found.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
});

function radial_chart_membership(labels, series) {
    var colors = ["#727cf5", "#0acf97", "#fa5c7c"],
        dataColors = document.querySelector("#circle-angle-radial2").dataset.colors,
        options = {
            series: series,
            labels: labels,
            chart: {
                height: 350,
                type: 'radialBar'
            },
            colors: dataColors ? dataColors.split(",") : colors,
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                // By default this function returns the average of all series. The below is just an example of how you can customize it.
                                return w.globals.series.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            },
            legend: {
                show: true,
                floating: true,
                fontSize: '13px',
                position: 'left',
                offsetX: 10,
                offsetY: 10,
                labels: {
                    useSeriesColors: true
                },
                markers: {
                    size: 0
                },
                formatter: function (seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex];
                },
                itemMargin: {
                    horizontal: 1,
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        },
        chart = new ApexCharts(document.querySelector("#circle-angle-radial2"), options);

    // Log options for debugging
    console.log(options);

    chart.render();
}
