loadData();
setTimeout(function () {
  document.querySelectorAll(".nav-item").forEach((item) => {
    item.addEventListener("click", function () {
      item.classList.toggle(".pcoded-trigger");
      item.querySelector(".pcoded-submenu").classList.toggle("show-menu-now");
    });
  });
}, 2000);




function loadData() {
  let sendingData = {
      action: "getUserMenus",
  };

  $.ajax({
      method: "POST",
      dataType: "json",
      url: "../Api/userAuthority.php",
      data: sendingData,
      success: function (data) {
          let status = data.status;
          let response = data.data;

          if (status) {
              let uniqueMenuLinks = {}; // Store unique menu links
              response.forEach((menu) => {
                  let categoryId = `category_${menu.category_id}`; // Use category_id as the unique identifier
                  let categoryElement = $(`#${categoryId}`);
                  if (categoryElement.length === 0) {
                      // Create the category element if it doesn't exist
                      categoryElement = $(`
                          <li class="side-nav-item">
                              <a data-bs-toggle="collapse" href="#${categoryId}" aria-expanded="false" aria-controls="${categoryId}" class="side-nav-link">
                                  <i class="uil-store"></i>
                                  <span> ${menu.category_name} </span>
                                  <span class="menu-arrow"></span>
                              </a>
                              <div class="collapse" id="${categoryId}">
                                  <ul class="side-nav-second-level">
                                  </ul>
                              </div>
                          </li>
                      `);
                      $("#userMenu").append(categoryElement);
                  }

                  // Append the menu item to the corresponding category if it's not already added
                  if (!uniqueMenuLinks[menu.link_name]) {
                      categoryElement.find(".side-nav-second-level").append(`
                      <li>
                      <a href="${menu.link_name}.php" current_link="${menu.link_name}" class="">${menu.link_name}</a>
                  </li>
                      `);
                      uniqueMenuLinks[menu.link_name] = true; // Mark the menu link as added
                  }
              });

              let href = window.location.href;
              let currentPage = document.querySelector(`[href="${href}"]`);

              if (currentPage) {
                  currentPage.classList.add("active");
                  currentPage.parentElement.classList.add("side-nav-link");
              }

              // Handle opening and closing of collapse elements
              $('.side-nav-item a[data-bs-toggle="collapse"]').on(
                  "click",
                  function () {
                      $('.side-nav-item a[data-bs-toggle="collapse"]')
                          .not(this)
                          .removeClass("active");
                      $(this).toggleClass("active");
                  }
              );
          } else {
              displayMessage("Error", response);
          }
      },
  });
}
