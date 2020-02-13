"use strict"

let ingredients = [];
let i = 0;
window.onload = function() {

    let tableIngredients = document.getElementById('ingredientTable');
    if(ingredients.length === 0){
        tableIngredients.style.display = 'none';
    }
};

function AddIngredient(){

    let title = document.getElementById('titleIngredient').value;
    let count = document.getElementById('countIngredient').value;
    let unit = document.getElementById('units').value;
    let error = document.getElementById('errorIngredient');

    document.getElementById('titleIngredient').value = "";
    document.getElementById('countIngredient').value = "";
    document.getElementById('units').value = "";
    //console.log(title);
    if(title === '' || count ===''){
        error.style.display = 'block';
    }
    else{
        error.style.display = 'none';
        let strIngredient = title + " - " + count + " " + unit + ";";
        ingredients.push(strIngredient);

        let sendField = document.getElementById('ingredients');
        let str = '';
        for(let i =0; i<ingredients.length; i++){
            str += ingredients[i];
        }
        sendField.value = str;

        let tableIngredients = document.getElementById('ingredientTable');

        let tbody = tableIngredients.getElementsByTagName("TBODY")[0];
        let row = document.createElement("TR");
        let td1 = document.createElement("TD");
        td1.appendChild(document.createTextNode(i+1));
        let td2 = document.createElement("TD");
        td2.appendChild(document.createTextNode(strIngredient));
        let td3 = document.createElement("TD");
        let delInput = document.createElement("input");
        delInput.type = "button";
        delInput.value = "Remove";
        delInput.dataset.index = i;
        //console.log(i);
        i = i + 1;

        delInput.onclick = function() {
            let index = this.getAttribute('index');
            console.log(this);
            console.log(this.dataset.index);
            ingredients.splice(index+1, 1);

            let sendField = document.getElementById('ingredients');
            let str = '';
            for(let i =0; i<ingredients.length; i++){
                str += ingredients[i];
            }
            sendField.value = str;

            let row = this.parentElement.parentElement;
            let tbody = tableIngredients.getElementsByTagName("TBODY")[0];
            tbody.removeChild(row);
            //console.log(sendField.value);
            if(ingredients.length === 0){
                tableIngredients.style.display = 'none';
            }
        };
        td3.appendChild(delInput);
        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        tbody.appendChild(row);

        tableIngredients.style.display='block';

    }


    //console.log(sendField.value);
}

 function AddStep () {
    let listStep = document.getElementsByClassName("btn btn-danger");
    let stepCounter = listStep.length-1;
     stepCounter++;
    console.log(stepCounter);

    let template = $("#stepTemplate").clone();
    template.css('visibility', 'visible');
    let inputList = template.find("input");
     console.log(template);
     console.log(inputList);
     inputList[0].setAttribute("name", "step["+ stepCounter +"][StepDescription]");
     inputList[1].setAttribute("name", "step["+ stepCounter +"][StepPhoto]");

     inputList[0].value = "";
     inputList[1].value = "";
    //for (let index = 0; index < inputList.length; index++) {

       // console.log(inputList[index]);

        //inputList[index].setAttribute("name", "step["+ stepCounter +"][StepDescription]"inputList[index].name.substring(0, inputList[index].name.lastIndexOf('_')+1) + stepCounter +"]");
        //inputList[index].name = inputList[index].name + visitCounter;
        //console.log(inputList[index]);
  //  }

    $("#stepPlaceholder").append(template);
};

function DeleteStep(btn) {
    console.log($(btn).closest(".create-step-short").remove());

}
