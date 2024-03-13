class Person {
    constructor(name, age){
        this.name = name;
        this.age = age;
    }

    greet = () => {
        return `Greetings you are old ${this.age}`;
    }
}

const p = new Person("Becir", 29);
console.log(p.greet());