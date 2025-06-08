function loadUsers() {
  RestClient.get("users", function (data) {
    const columns = [
      { data: "name", title: "Name" },
      { data: "surname", title: "Surname" },
      { data: "email", title: "Email" },
      {
        data: null,
        title: "Actions",
        render: function (data, type, row) {
          return `
            <button class="edit-btn" data-id="${row.id || row.user_id}" data-name="${row.name}" data-surname="${row.surname}" data-email="${row.email}">Edit</button>
            <button class="delete-btn" data-id="${row.id || row.user_id}">Delete</button>
          `;
        },
      },
    ];

    $("#admin-section").html(`
      <h2>Users</h2>
      <table id="users-table" class="display"></table>
      <h3>Add New User</h3>
      <form id="add-user-form">
        <input name="name" placeholder="Name" required />
        <input name="surname" placeholder="Surname" required />
        <input name="email" placeholder="Email" required />
        <input name="password" placeholder="Password" required type="password" />
        <button type="submit">Add</button>
      </form>
    `);

    Utils.datatable("users-table", columns, data);

    $("#add-user-form").on("submit", function (e) {
      e.preventDefault();
      const formData = Object.fromEntries(new FormData(this).entries());

      RestClient.post("users", formData, function () {
        toastr.success("User added successfully");
        loadUsers();
      });
    });

    $("#users-table").on("click", ".edit-btn", function () {
      const id = $(this).data("id");
      const name = $(this).data("name");
      const surname = $(this).data("surname");
      const email = $(this).data("email");

      $("#admin-section").append(`
        <div id="edit-user-modal">
          <h3>Edit User</h3>
          <form id="edit-user-form">
            <input name="name" value="${name}" required />
            <input name="surname" value="${surname}" required />
            <input name="email" value="${email}" required />
            <button type="submit">Save</button>
            <button type="button" onclick="$('#edit-user-modal').remove()">Cancel</button>
          </form>
        </div>
      `);

      $("#edit-user-form").on("submit", function (e) {
        e.preventDefault();
        const updatedData = Object.fromEntries(new FormData(this).entries());

        RestClient.patch(`users/${id}`, updatedData, function () {
          toastr.success("User updated");
          $("#edit-user-modal").remove();
          loadUsers();
        });
      });
    });

    $("#users-table").on("click", ".delete-btn", function () {
      const id = $(this).data("id");
      if (confirm("Are you sure you want to delete this user?")) {
        RestClient.delete(`users/${id}`, {}, function () {
          toastr.success("User deleted");
          loadUsers();
        });
      }
    });
  });
}

$(document).ready(function () {
  const token = localStorage.getItem("user_token");
  const decoded = Utils.parseJwt(token);

  if (decoded && decoded.user && decoded.user.roles === Constants.ADMIN_ROLE) {
    loadUsers();
  } else {
    $("#admin-section").html("<p>Access denied. Admins only.</p>");
  }
});
