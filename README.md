# IT 207 - Introduction to Web Programming

Project for university level course called - Introduction to Web Programming

Welcome to the Introduction to Web Programming course! This course is designed to introduce you to the fundamentals of web development, covering essential topics and technologies needed to create dynamic and interactive websites.

## Course Description

This course provides a comprehensive introduction to web programming concepts and techniques. Through a combination of lectures, practical exercises, and projects, you will learn the basics of PHP, MySql, HTML, CSS, JavaScript, and more.

## Course Structure

### Week 1: Introduction to HTML

- Introduction to tutorials format
  - How tutorials will be conducted
  - How quizzes will be conducted
- Environment Setup
  - How to install necessary tools on different platforms:
    - Windows 10/11 - https://pureinfotech.com/install-xampp-windows-10/
    - MacOS - https://phpandmysql.com/extras/installing-mamp/
    - Linux - https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-22-04
      - Apache
      - PHP 8
      - MySql Server VS MySql RDBMS
    - VSCode
      - Prettier
      - HTML CSS Support
      - PHP Debug
      - PHP Intelephense
      - vscode-icons
    - DBeaver [https://dbeaver.com/academic-license/]
- Internet concepts
  - Overview of internet
  - Internet protocols
  - Debugging requests and packages
  - Github overview (creating repository and opening PR)
  - Backend and frontend
  - Amela as a collaborator for PRs
- Reading materials (https://docs.google.com/document/d/1nc05FpIhOQ5hfRPiKAiicOd1oAe22TpvqEx-VMKG5rQ/edit?usp=sharing)
- ## Overview of web technologies

### Week 2: Styling with CSS

- Introduction to HTML
  - Basics
  - Navbar
  - Images and videos
  - Forms
  - Lists
  - Links
  - Tables
  - Canvas
- CSS
  - Levels of CSS
  - Selectors
- SCSS
  - What is SCSS and how it works
  - How to compile it to CSS
- Bootstrap
  - Overview
  - Grid system
  - Tables
  - Forms
  - Alerts and badges
  - Carousel
  - Modal
- Theme
  - How to download and tweak the bootstrap theme so it fits your project

### Week 3: Introduction to JavaScript

- Introduction to Javascript
- Javascript rendering
- ECMAScript (ES) Standards
- Variables and datatypes
- Events
- Functions
- Classes
- DOM Manipulation
- Asynchronous Programming

### Week 4: Utilities libraries for frontend development

- Bootstrap
- JQuery
- Datatables
- SPApp
- Highcharts
- Select2

### Week 5: Forms and validation

- Validating form data with JQuery
- Utility libraries for blocking the UI and providing proper user experience
- Integrating Google Recaptcha for in forms
- Saving form data into JSON objects and files
- Sending form data to API and acting on response
- Creating utility custom-made library for all form validations with callbacks

### Week 6: Frontend project structure

- Structure of frontend project
- Utility functions
- Sending the POST modal request
- Server side datatable

### Week 7: Backend project setup and connecting to database

- Recap of SQL concepts
- Recap of data modeling
- Backend project structure
- Multi layer DAO
- Service layer

### Week 8: Version Control Systems

- Git basic commands
  - https://www.youtube.com/watch?v=f1wnYdLEpgI
- Github
  - issues
  - conflicts
  - actions
  - tickets
  - github keywords

### Week 9: Web frameworks

- Configuring XDebug with VSCode

  - Windows
    - https://medium.com/@asd66998854/php-code-debug-using-xampp-on-vscode-editor-97c5f6cc4487
  - MacOS
    - https://dev.to/scriptmint/installing-xdebug-3-on-macos-and-debug-in-vs-code-3l5h
  - Linux
    - https://php.tutorials24x7.com/blog/how-to-debug-php-using-xdebug-and-visual-studio-code-on-ubuntu

- Composer package manager
  - https://getcomposer.org/doc/00-intro.md
- Flight PHP
  - https://docs.flightphp.com/
- CORS
  - https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS

### Week 10: OpenAPI 3.0 and Swagger

- Swagger setup
- Using swagger parameters

  - https://swagger.io/docs/specification/describing-parameters/

- How to setup your swagger
  1. Download the required library - composer require zircote/swagger-php:3.3.7
  2. Add the vendor folder to our .gitignore file
  3. Change configuration files (doc_setup.php, swagger.php in the public/v1/docs folder)
  4. Visit you swagger setup BASE_URL + /public/v1/docs/
  5. Document your routes based on the swagger documentation website shown above

### Week 11: Json Web Token

- Introduction to JWT
- Installation
  - composer require firebase/php-jwt
- Setup JWT Secret
- Create backend logic for issuing JWT
- Create frontend logic for managing and storing JWT

### Week 12: Middlewares

- Flight PHP Middleware
- Middleware for global error handling

### Week 13: CI/CD Continuous Integration and Continuous Delivery/Deployment

- DigitalOcean Deployment
  - Create DO database
  - Create local DB dump
  - Import dump to a remote DO database
  - Set the environment variables
  - Changes to following files
    - swagger.php
    - constants.js

### Week 14: Websockets and WebRTC

- Flight PHP

## Prerequisites

- Basic understanding of programming concepts (variables, loops, functions, etc.)
- Familiarity with HTML and CSS is helpful but not required
- Access to a computer with a text editor and a web browser

## Resources

- [W3Schools](https://www.w3schools.com/)
- [MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web)
- [FreeCodeCamp](https://www.freecodecamp.org/)
- [Codecademy](https://www.codecademy.com/learn)

## License

This course material is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact Information

For any questions or concerns regarding the course, please contact:

- [Dzelila Mehanovic](mailto:dzelila.mehanovic@ibu.edu.ba)
- [Becir Isakovic](mailto:becir.isakovic@ibu.edu.ba)
- [Amela Vatres](mailto:ta@amela.vatres@ibu.edu.ba)
