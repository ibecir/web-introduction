// 1. Number:
   var age = 25;
   var price = 9.99;

// 2. String: 
   var userName = "John Doe";
   var message = 'Hello, world!';

   let length = userName.length;
   let upperCase = userName.toUpperCase();
   let lowerCase = userName.toLowerCase();
   let firstChar = userName.charAt(0);
   let lastChar = userName.charAt(userName.length - 1);
   let index = userName.indexOf("Doe");
   let replaced = userName.replace("Doe", "Smith");
   let sliced = userName.slice(0, 4);
   let split = userName.split(" ");
   let includes = userName.includes("Doe");
   let startsWith = userName.startsWith("John");
   let endsWith = userName.endsWith("Doe");
   let trim = "  Hello  ".trim();

// 3. Boolean:
   var isAdult = true;
   var hasPermission = false;

// 4. Null:
   var myVar = null;
   
// 5. Undefined:
   var undefinedVar;
   
// 6. Symbol (ES6+):
   var id = Symbol("id");

// 7. Object:
   var person = {
       name: "Alice",
       age: 30,
       isStudent: false
   };

// 8. Array:
   var numbers = [1, 2, 3, 4, 5];
   var colors = ["red", "green", "blue"];

// 9. Function:
   function greet(name) {
       return "Hello, " + name + "!";
   }
   
//10. RegExp:
   var pattern = /hello/i; // Case-insensitive regular expression to match "hello"