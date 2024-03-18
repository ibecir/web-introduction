_getPosts = () => {
  // Through the vanilla JS / plain JS
  return fetch("https://jsonplaceholder.typicode.com/posts")
    .then((response) => response.json())
    .then((data) => {
      let output = "";
      data.forEach((post) => {
        output += `
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Post -->
                            <div class="card mb-4">
                            <a onclick="getCommentsJquery(${post.id})">
                                <div class="card-body">
                                <h5 class="card-title">${post.title}</h5>
                                <p class="card-text">${post.body}</p>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                `;
      });
      document.getElementById("container").innerHTML = output;
    })
    .catch((error) => console.log(error));
};

getPosts = () => {
  // Through the library called JQuery
  $.get("https://jsonplaceholder.typicode.com/posts", (data) => { // Callback function
    let output = "";
    data.forEach((post) => {
      output += `
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Post -->
                            <div class="card mb-4">
                            <a onclick="getCommentsJquery(${post.id})">
                                <div class="card-body">
                                <h5 class="card-title">${post.title}</h5>
                                <p class="card-text">${post.body}</p>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                `;
    });
    document.getElementById("container").innerHTML = output;
  });
}

getComments = (postId) => {
  fetch(`https://jsonplaceholder.typicode.com/posts/${postId}/comments`)
    .then((response) => response.json())
    .then((data) => {
      let commentsHtml = ``;

      data.map((comment) => {
        commentsHtml += `
                <tr>
                    <td>${comment.id}</td>
                    <td>${comment.email}</td>
                    <td>${comment.name}</td>
                    <td>${comment.body}</td>
                </tr>
            `;
      });
      $("#myModal .modal-body .table > tbody").html(commentsHtml);
      $("#myModal").modal("show");
    });
};

getCommentsJquery = (postId) => {
  $.get(
    `https://jsonplaceholder.typicode.com/posts/${postId}/comments`)
    .done(function (data) { // Callback function - once request is done
      let commentsHtml = ``;

      data.map((comment) => {
        commentsHtml += `
                <tr>
                    <td>${comment.id}</td>
                    <td>${comment.email}</td>
                    <td>${comment.name}</td>
                    <td>${comment.body}</td>
                </tr>
            `;
      });
      $("#myModal .modal-body .table > tbody").html(commentsHtml);
      $("#myModal").modal("show");
      new DataTable("#comments-table"); // Initialize datatable
    })
    .fail(function () { // Callback function - once request fails
      console.log("Error happened");
    })
    .always(function () { // Callback function - always
      console.log("Executed no matter is it finishes with success or error");
    });
};

const addComment = () => {
  $("button").click(function () {
    alert("Button clicked");
  });
  $.post(
    "https://klix.ba",
    {
      name: "Donald Duck",
      city: "Duckburg",
    },
    function (data, status) {
      alert("Data: " + data + "\nStatus: " + status);
    }
  );
}

getPosts();
//addComment();