console.log(document.getElementById("swap11").outerHTML);

function popup(message) {
    alert(message);
}

function afterImg(id, path) {
    document.getElementById(id).src = path;
}

function beforeImg(id, path) {
    document.getElementById(id).src = path;
}

function fillCity() {
    var cityName;
    var zipEntered = document.getElementById("zip").value;
    switch (zipEntered) {
        case "60608":
            cityName = "Chicago";
            break;
        case "68114":
            cityName = "Omaha";
            break;
        default:
            cityName = "no city";
    }
    // set input field value using JS
    document.getElementById("city").value = cityName;
}

function fillGender() {
    var gender;
    var nameEntered = document.getElementById("name").value;

    if (nameEntered == "ahsan") {
        document.getElementById("male").setAttribute("checked", "checked");
    } else {
        document.getElementById("male").removeAttribute("checked");
    }
}

function expandLoris() {
    var listToPlace = "<ol><li>Slow loris</li><li>Fast loris</li><li>Just-right loris</li></ol>";
    document.getElementById("slowLoris").innerHTML = listToPlace;
}

function makeLarge() {
    var ugly = document.getElementById("ugly");
    ugly.className += " largeMe";
    ugly.innerHTML = "Don't Click this text to make it small";
}

function changeStyle(id) {
    var st = document.getElementById(id);

    // st.style.visibility = "hidden";
    st.style.fontSize = "20px";
    // st.style.cssFloat = "right";
    st.style.padding = "20px 20px 20px 20px";
}

function doom() {
    var parent = document.getElementById("div1");

    console.log(document.all);

    //empty spaces ki waja se div1 ke actually 5 child he; #text, p, #text, p, #text 
    // js waja se hmare 1st <p> ki positions 1 he or 2nd <p> ki position 3 he
    parent.childNodes[1].innerHTML += "<span class='cl_r'> changed</span>";
    // parent.firstChild.innerHTML += "<span class='cl_r'> changed</span>";

    // parent.childNodes[3].innerHTML += "<span class='cl_r'> changed</span>";
    // parent.lastChild.innerHTML += "<span class='cl_r'> changed</span>";

    var para = document.getElementById("p5");
    // para.nextSibling;
    // para.previousSibling;
}

function dom_attribute() {
    var target = document.getElementById("p11");
    var hasClass = target.hasAttribute("class");
    var attVal = target.getAttribute("class");
    var classesVal = attVal + " b8 size20";
    var setattr = target.setAttribute("class", classesVal);
    target.setAttribute("style", "border: 1px solid red;");
    // in the same we way, we can add almost any attribute like href, type, id, value etc
    var totalAttr = target.attributes.length;

    alert("p11 has class attribute? " + hasClass + "\np11 has total attributes: " + totalAttr + "\np11 class attribute is: " + attVal + "\np11 attribute is set as:" + classesVal)
}

function delete_attribute() {
    var target = document.getElementById("p12");
    target.removeAttribute("class");
}

function add_node() {
    var parent_div = document.getElementById("div12");

    var nodeToAdd = document.createElement("p");
    nodeToAdd.setAttribute("class", "bg_c");
    nodeToAdd.setAttribute("style", "border: 1px solid red;");
    var newTxt = document.createTextNode("new paragraph1");
    nodeToAdd.appendChild(newTxt);

    //parent_div.appendChild(nodeToAdd); // is se last position pr ek paragraph ki node ajaegi
    var target = parent_div.childNodes[3];
    parent_div.insertBefore(nodeToAdd, target.nextSibling);
}

function delete_node() {
    var parent_div = document.getElementById("div12");
    var nodeToRemove = parent_div.childNodes[2];
    parent_div.removeChild(nodeToRemove);
}


// function checkUsername(e, minlength) {
//     var target = e.target; //get target of event

//     if (target.value.length < minlength) {
//         alert("It's not enough")
//     }
// }
// var el = document.getElementById('username ');
// el.addEventListener('blur', function(e) {
//     checkUsername(e, 5);
// }, false);


function itemDone(e) {
    var target, elParent, elGrandParent;

    //Remove Item From the list
    target = e.target;
    // alert(e.target.value);
    elParent = target.parentNode;
    elGrandParent = elParent.parentNode;

    alert(target.parentNode.innerHTML + " Removed From Cart")
    elGrandParent.removeChild(elParent);

    //prevent the link from taking you elsewhere
    e.preventDefault();
}

// Set up event listeners to call itemDone() on click
document.getElementById("shoppinglist").addEventListener('click', function(e) {
    itemDone(e);

}, false);

