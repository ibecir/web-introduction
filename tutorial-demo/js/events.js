sayHello = () => {
  alert("HELLO");
};

let button = document.getElementById("myButton");

button.addEventListener("click", () => {
  let outputPrint = document.getElementById("output-print");
  outputPrint.innerHTML = "<h1>Button has been clicked</h1>";
});
