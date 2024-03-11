getPosts = () => {
    return fetch('https://jsonplaceholder.typicode.com/posts')
        .then(response => response.json())
        .then(data => {
            let output = '';
            data.forEach(post => {
                output += `
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Post -->
                            <div class="card mb-4">
                            <a onclick="getComments(${post.id})">
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
            document.getElementById('container').innerHTML = output;
        })
        .catch(error => console.log(error));
}

getComments = (commentId) => {
    fetch(`https://jsonplaceholder.typicode.com/posts/${commentId}/comments`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
    });
}

getPosts();