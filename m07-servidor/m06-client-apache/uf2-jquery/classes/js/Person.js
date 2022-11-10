class Person {
	//atributs
	#name; //#fa que name tingui àmbit private
	#age;
	surname; //no tenir # fa que sigui d'àmbit públic
	//constructor

	// persona1 = new Person();
	// persona2 = new Person("Mario");
	// persona3 = new Person("", 19);

	//
	constructor(name, age, surname) {
		this.#age = age;
		this.#name = name;
		this.surname = surname;
	}
	//getters & setters

	get name() {
		return this.#name;
	}

	get age() {
		return this.#age;
	}
	get surname() {
		return this.surname;
	}

	set name(name) {
		this.#name = name;
	}

	set age(age) {
		this.#age = age;
	}

	/**
	 * @param {any} surname
	 */
	set surname(surname) {
		this.surname = surname;
	}

	loadingFullName() {
		return (
			"My name is " +
			this.name +
			" my surname is " +
			this.surname +
			", and my age is " +
			this.age
		);
	}

	#loadingMyName() {
		//àmbit private, fixa't què passa ficant o no ficant # al davant
		return "My name is " + this.name;
	}
}
