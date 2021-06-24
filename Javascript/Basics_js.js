/////////////////////////
//Basics
/////////////////////////


document.getElementById("demo").innerHTML = person("ahsan", "21");

function person(name1, age1) {
    return ("Your name is " + name1 + ". You're " + age1 + " years old.");
}

function current_date(el_id) {
    var target = document.getElementById(el_id);
    target.innerHTML = Date();
    target.setAttribute("style", "border: 1px solid red;");
}

//TRADITIONAL DOM EVENT HANDLERS (very old)
function current_date2() {
    var target = document.getElementById("demo3");
    target.innerHTML = Date();
    target.setAttribute("style", "border: 1px solid red;");
}
document.getElementById("btn1").onclick = current_date2;


//DOM Level 2 Event Listener (Advanced technique to call an event)
document.getElementById("btn2").addEventListener('click', function() {
    current_date('demo4')
}, false);
//our third param of DOM Level 2 Event Listener
// false = event trigger from bottom to top(bubbling phase)
// true = event trigger from top to bottom (capturing phase)

// var name = prompt("What is your name?", "Ahsan");
// document.write("<br>"+"Your name is:", name);

// var age = prompt("What is your age?");
// new_age=parseInt(age)+5;
// new_age=parseFloat(age)+5;
// new_age = Number(age) + 5;
// document.write("<br>"+"Your age is;", new_age);



var whereWeAt = window.location.href; //file:///E:/Full-Stack-JavaScript-Development/js_basics.html
document.write("<br>" + whereWeAt)

var theDomain = window.location.hostname;
document.write("<br>" + theDomain)

var thePath = window.location.pathname; // /E:/Full-Stack-JavaScript-Development/js_basics.html
document.write("<br>" + thePath)

var theAnchor = window.location.hash;
document.write("<br>" + theAnchor)




/////////////////////////
//DOM
/////////////////////////

// document.getElementById("id")

// document.getElementsByClassName("class_name")

// document.getElementsByTagName("p")

// document.getElementsByName("name")

// document.querySelector("CSS_Selector")
document.write("<br>" + "<b>Node name Query Selector:</b> ", document.querySelector(".demo_class").nodeName)

// document.querySelectorAll("CSS_Selector")





/////////////////////////
//Objects and Constructors
/////////////////////////









/////////////////////////
//Objects and Constructors
/////////////////////////



var single_person = {
    firstName: "Ahsan",
    lastName: "Ghaffar",
    id: 5566,
    fullName: function() { return this.firstName + " " + this.lastName; }
};

document.write("<br>" + "single_person", single_person)
document.write("<br>" + single_person.firstName);
document.write("<br>" + single_person["lastName"]);
document.write("<br>" + single_person.fullName());


//constuctors for multiple persons (It's also a of object)
function person_cons(firstName, lastName, id) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.id = id;
    this.fullName = function() { return this.firstName + " " + this.lastName; }
}

var person1 = new person_cons("ahsan", "ghaffar", "123")
var person2 = new person_cons("bisma", "ghaffar", "456")
var person3 = new person_cons("osama", "ghaffar", "789")

document.write("<br>" + "person_cons", person1)
document.write("<br>" + "person1", person1.fullName())



/////////////////////////
//Array
/////////////////////////

var fruits = ["Banana", "Orange", "Apple", "Mango"];
var arr2 = ["dog", "cat", "bird"];

//toString() converts array to a string of (comma separated) array values.
document.getElementById("arr1").innerHTML = fruits.toString();

//var x = fruits.pop();      // Removes the last element ("Mango") and save it in x
//var x = fruits.push("Kiwi"); // the value of x is 5

var res12 = arr2.shift();
var res12 = arr2.unshift("mice", "ostrich");

// splice(start_point, replace, val1,val2,....)
// start_point= index of array from where we want to start adding
// replace= num of elements we want to remove from start_point
arr2.splice("mice2", "ostrich2");


document.write("<br>" + "shift function remove and return first element of array:", res12)




/////////////////////////
//String functions
/////////////////////////

var txt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var str = "Please locate where 'locate' occurs!";
var str1 = "Apple, Banana, Kiwi";
var str2 = "Hello World!";

var len = txt.length;

var ind1 = str.indexOf("locate"); // return location of first value which founded
var ind2 = str.lastIndexOf("locate"); // return location of last value which founded
var ind3 = str.indexOf("locate", 15); // start search from location 15 and then take first value which founded
var ind4 = str.search("locate");
//The search() method cannot take a second start position argument. 
//The indexOf() method cannot take powerful search values (regular expressions).

var res1 = str1.slice(7, 13);
var res2 = str1.slice(-12, -6);
var res3 = str1.slice(7);
var res4 = str1.slice(-12);
var res5 = str1.substring(7, 13); //substring() cannot accept negative indexes like slice.
var res6 = str1.substr(7, 9); // substr(start, length) is similar to slice(). second parameter of substr is length of string

var res7 = str.replace("locate", "W3Schools"); //replace only replace first match from string
var res8 = str.replace(/LOCATE/i, "W3Schools"); // i makes it case insensitive
var res9 = str.replace(/LOCATE/g, "W3Schools"); // g replace all matches from string rather than replacing only first

var res10 = str2.toUpperCase();
var res11 = str2.toLowerCase();


document.write("<br>" + "Length of string:", len);
document.write("<br>" + "indexOf:", ind1);
document.write("<br>" + "index of last:", ind2);
document.write("<br>" + "indexOf with start point:", ind3);
document.write("<br>" + "search:", ind4);
document.write("<br>" + "slice:", res1);
document.write("<br>" + "slice -ve pos:", res2);
document.write("<br>" + "slice with only start pos:", res3);
document.write("<br>" + "slice with only -ve start pos", res4);
document.write("<br>" + "substring:", res5);
document.write("<br>" + "substr:", res6);
document.write("<br>" + "replace:", res7);
document.write("<br>" + "replace with case insensitive:", res8);
document.write("<br>" + "replace all:", res9);
document.write("<br>" + "to upper case:", res10);
document.write("<br>" + "to lower case:", res11);



/////////////////////////
//Math Functions
/////////////////////////

var num1 = 23.45647283;

document.write("<br>" + "ceil() function:", Math.ceil(num1));
document.write("<br>" + "floor() function:", Math.floor(num1));
document.write("<br>" + "round() function:", Math.round(num1));
document.write("<br>" + "fixed() function:", num1.toFixed(2));
document.write("<br>" + "round() function:", Math.round(num1));



/////////////////////////
//EcmaScript6 (ES6)
/////////////////////////


///////
//JavaScript Function Declarations
///////

//1st (simple function)
function hello1() {
    return "Hello simple function";
}

//2nd (functino expression)
hello2 = function() {
    return "Hello functino expression";
}

// 3rd ( IMMEDIATELY INVOKED FUNCTION EXPRESSIONS (llFE))
hello3 = (function() {
    return "Hello IMMEDIATELY INVOKED FUNCTION EXPRESSIONS (llFE)";
}())

//4th (arrow function)
hello4 = (name) => { return ("Hello " + name); }
    //OR
hello5 = (name) => { return (`Hello new ${name}`) }



document.getElementById("arrow").innerHTML = hello4("arrow function");

document.write("<br>" + hello5("arrow function"));


///////
// Promises
///////

// let myPromise = new Promise(function(myResolve, myReject) {
//     // "Producing Code" (May take some time)
//     myResolve(); // when successful
//     myReject(); // when error
// });

// // "Consuming Code" (Must wait for a fulfilled Promise).

// myPromise.then(
//     function(value) { /* code if successful */ },
//     function(error) { /* code if some error */ }
// );


// let myPromise = new Promise(function(myResolve, myReject) {
//     setTimeout(function() { myResolve("I love You !!"); }, 3000);
// });

// myPromise.then(function(value) {
//     document.getElementById("demo").innerHTML = value;
// });



/////////////////////////
//Class
/////////////////////////

class Car {
    constructor(name, year) {
        this.name = name;
        this.year = year;
    }
    age(x) {
        return x - this.year;
    }
}

let date = new Date();
let year = date.getFullYear();

let myCar = new Car("Ford", 2014);
document.getElementById("class1").innerHTML = "My car is " + myCar.age(year) + " years old.";