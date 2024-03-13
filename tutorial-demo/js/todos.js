getTodosListItems = (baseUrl) => {
    fetch(baseUrl)
        .then((response) => {
            return response.json(); // unwraps the cevapi
        })
        .then((data) => {
            // i'm consuming the cevapi
            const tableBody = document.querySelector("#todos-table tbody");

            data.map((row) => {
                const tableRow = document.createElement("tr");
                tableRow.innerHTML = `
                    <td><a target="_blank" href="${baseUrl + "/" + row.id}">${row.id}</a></td>
                    <td>${row.userId}</td>
                    <td>${row.title}</td>
                    <td>${row.completed}</td>
                `;
                tableBody.append(tableRow);
            })
        })
        .catch((error) => {
            alert("PROBLEM HAPPENED ", error);
        })
}

getTodosListItems("https://jsonplaceholder.typicode.com/todos");