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
