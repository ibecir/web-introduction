class Person {
    constructor(name, age) {
        this.name = name;
        this.age = age;
    }

    greet = () => {
        return `Hello, ${this.name}!`;
    }

    getAge = () => {
        return this.age;
    }
}

const p = new Person("Becir", 30);
console.log(p.greet(), p.getAge());
