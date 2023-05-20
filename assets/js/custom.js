$(document).ready(function () {
  // This line is not required
  // $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({ pageNotFound: "error_404" }); // initialize
  app.route({
    view: "todo",
    load: "todo.html",
  });

  // run app
  app.run();
});

/*// Inside your custom.js file
document.querySelector('form').addEventListener('submit', function(e) {
  e.preventDefault(); // Prevent form submission
});

// Inside your custom.js file
document.querySelector('.todo-button').addEventListener('click', function(e) {
  e.preventDefault(); // Prevent form submission

  // Get the input value
  var inputValue = document.querySelector('.todo-input').value;

  // Check if the input value is not empty
  if (inputValue !== '') {
    // Create a new todo item
    var todoItem = document.createElement('li');
    todoItem.innerText = inputValue;
    document.querySelector('.todo-list').appendChild(todoItem);

    // Clear the input field
    document.querySelector('.todo-input').value = '';
  }
});*/
