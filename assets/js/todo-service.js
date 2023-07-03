var TodoService = {
  init: function () {
    $("#addTodoForm").validate({
      submitHandler: function (form) {
        var todo = Object.fromEntries(new FormData(form).entries());
        TodoService.addTodo(todo);
        form.reset();
      },
    });
    $("#editTodoForm").validate({
      submitHandler: function (form) {
        var todo = Object.fromEntries(new FormData(form).entries());
        TodoService.editTodo(todo);
      },
    });

    TodoService.get_todo_rest();
  },
  getTodo: function () {
    $.get("rest/todo", function (data) {
      var html = "";
      for (var i = 0; i < data.length; i++) {
        data[i].email = data[i].email ? data[i].email : "-";
        data[i].edit_todo =
          '<button class="btn btn-info" onClick="TodoService.showEditDialog(' +
          data[i].id +
          ')">Edit Todo</button>';
        data[i]._todo =
          '<button class="btn btn-danger" onClick="TodoService.openConfirmationDialog(' +
          data[i].id +
          ')"> Todo</button>';
        /*html +=
          "<tr>" +
          "<td>" +
          data[i].first_name +
          "</td>" +
          "<td>" +
          data[i].last_name +
          "</td>" +
          "<td>" +
          (data[i].email ? data[i].email : "No data") +
          "</td>" +
          "<td>" +
          (data[i].password ? data[i].password : "No data") +
          "</td>" +
          '<td><button class="btn btn-info" onClick="StudentService.showEditDialog(' +
          data[i].id +
          ')">Edit Student</button></td>' +
          '<td><button class="btn btn-danger" onClick="StudentService.openConfirmationDialog(' +
          data[i].id +
          ')"> Student</button></td>' +
          "</tr>";*/
      }
      //$("#students-table").html(html);

      Utils.datatable(
        "todo-table",
        [
          { data: "description", title: "Description" },
          /*{ data: "last_name", title: "Surname" },
          { data: "password", title: "Password" },
          { data: "email", title: "Email" },*/
          { data: "edit_todo", title: "Edit Todo" },
          { data: "_todo", title: " Todo" },
        ],
        data
      );

      console.log(data);
    });
  },

  addTodo: function (todo) {
    console.log("post");
    $.ajax({
      url: "rest/todo",
      type: "POST",
      beforeSend: function (xhr) {
        xhr.setRequestHeader(
          "Authorization",
          localStorage.getItem("user_token")
        );
      },
      data: JSON.stringify(todo),
      contentType: "application/json",
      dataType: "json",
      success: function (todo) {
        $("#addTodoModal").modal("hide");
        toastr.success("Todo has been added!");
        TodoService.get_todo_rest();
      },
    });
  },

  showEditDialog: function (id) {
    $("#editTodoModal").modal("show");
    $("#editModalSpinner").show();
    $("#editTodoForm").hide();
    $.ajax({
      url: "rest/todo/" + id,
      beforeSend: function (xhr) {
        xhr.setRequestHeader(
          "Authorization",
          localStorage.getItem("user_token")
        );
      },
      type: "GET",
      success: function (data) {
        console.log(data);
        /*$("#edit_first_name").val(data.first_name);
        $("#edit_last_name").val(data.last_name);
        $("#edit_email").val(data.email);*/
        $("#edit_description").val(data.description);
        $("#edit_todo_id").val(data.id);
        $("#editModalSpinner").hide();
        $("#editTodoForm").show();
      },
    });
  },

  editTodo: function(todo) {
    console.log("edit");
    if (!todo.id) {
      console.error("Todo ID is missing.");
      return;
    }
  
    $.ajax({
      url: "rest/todo/" + todo.id,
      beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        console.log("Before sending PUT request");
      },
      type: "PUT",
      data: JSON.stringify(todo),
      contentType: "application/json",
      dataType: "json",
      success: function(result) {
        toastr.success("Todo has been updated successfully");
        $("#editTodoModal").modal("toggle");
        TodoService.get_todo_rest();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error("Error! Todo has not been updated.");
      },
    });
  },
  

  openConfirmationDialog: function (id) {
    $("#deleteTodoModal").modal("show");
    $("#delete-todo-body").html(
      "Do you want to delete todo with ID = " + id
    );
    $("#todo_id").val(id);
  },

  deleteTodo: function () {
    $.ajax({
      url: "rest/todo/" + $("#todo_id").val(),
      beforeSend: function (xhr) {
        xhr.setRequestHeader(
          "Authorization",
          localStorage.getItem("user_token")
        );
      },
      type: "DELETE",
      success: function (response) {
        console.log(response);
        $("#deleteTodoModal").modal("hide");
        toastr.success(response.message);
        TodoService.get_todo_rest();
        //alert('deleted')
      },
      error: function (XMLHttpRequest, textStatus, errorThrow) {
        console.log("Error: " + errorThrow);
      },
    });
  },
  get_todo_rest: function () {
    RestClient.get(
      "todo",
      function (data) {
        for (var i = 0; i < data.length; i++) {
          data[i].email = data[i].email ? data[i].email : "-";
          data[i].edit_todo =
            '<button class="btn btn-info" onClick="TodoService.showEditDialog(' +
            data[i].id +
            ')">Edit Todo</button>';
          data[i].delete_todo =
            '<button class="btn btn-danger" onClick="TodoService.openConfirmationDialog(' +
            data[i].id +
            ')">Delete Todo</button>';
          /*html +=
              "<tr>" +
              "<td>" +
              data[i].first_name +
              "</td>" +
              "<td>" +
              data[i].last_name +
              "</td>" +
              "<td>" +
              (data[i].email ? data[i].email : "No data") +
              "</td>" +
              "<td>" +
              (data[i].password ? data[i].password : "No data") +
              "</td>" +
              '<td><button class="btn btn-info" onClick="StudentService.showEditDialog(' +
              data[i].id +
              ')">Edit Student</button></td>' +
              '<td><button class="btn btn-danger" onClick="StudentService.openConfirmationDialog(' +
              data[i].id +
              ')">Delete Student</button></td>' +
              "</tr>";*/
        }
        //$("#students-table").html(html);

        Utils.datatable(
          "todo-table",
          [
            /*{ data: "first_name", title: "Name" },
            { data: "last_name", title: "Surname" },
            { data: "password", title: "Password" },*/
            { data: "description", title: "Description" },
            { data: "edit_todo", title: "Edit Todo" },
            { data: "delete_todo", title: "Delete Todo" },
          ],
          data
        );

        console.log(data);
      },
      function (data) {
        toastr.error(data.responseText);
      }
    );
  },
};
