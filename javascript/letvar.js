function example() {
  if (true) {
    var varVariable = "I am declared with var";
    let letVariable = "I am declared with let";
  }

  console.log(varVariable); // Outputs: "I am declared with var"
  console.log(letVariable); // Throws a ReferenceError: letVariable is not defined
}

example();