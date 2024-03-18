export function crearElement(tipus, atributs, contingut) {
    var element = document.createElement(tipus);
    let text = document.createTextNode(contingut);
   
    for (var key in atributs) {
        // if (key == "class") {
        //     element.classList.add.apply(element.classList, atributs[key]);
        // } else {
        //     element[key] = atributs[key];
        // }
        element.setAttribute(key, atributs[key]);
    }
    if (text != null) {
        element.appendChild(text);
    }
    if(text == undefined){
        element.innerHTML = "";
    }
    return element;
}

const svgNS = "http://www.w3.org/2000/svg";
export function createElementNS(tipus, atributs) {
    var element = document.createElementNS(svgNS, tipus);
    for (var key in atributs) {
        element.setAttribute(key, atributs[key]);
    }
    return element;
}

export function shuffleArray(array) {
    let currentIndex = array.length;
    let temporaryValue;
    let randomIndex;
    // While there remain elements to shuffle...
    while (currentIndex !== 0) {
        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;
        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }
    return array;
}