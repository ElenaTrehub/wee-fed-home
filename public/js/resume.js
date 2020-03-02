"use strict"

let services = [];
let i = 0;
window.onload = function() {

    let tableServices = document.getElementById('servicesTable');
    if(services.length === 0){
        tableServices.style.display = 'none';
    }
};

function AddService(){

    let servicesSelect = document.getElementById('service');
    let selectedOption = servicesSelect.options[servicesSelect.selectedIndex];
    let title = selectedOption.text;
    let count = document.getElementById('count').value;

    let error = document.getElementById('errorService');
    let errorTitle = document.getElementById('errorTitleService');
    document.getElementById('service').value = "";
    document.getElementById('count').value = "";

    //console.log(title);
    if(title === '' || count ===''){
        error.style.display = 'block';
        return;
    }
    else{
        error.style.display = 'none';
        let strService = title + " - " + count  + ";";

        for(let i=0; i<services.length; i++){
            if(services[i].indexOf(title, 0)!==-1){
                errorTitle.style.display = 'block';
                return;
            }
        }

        errorTitle.style.display = 'none';


        services.push(strService);

        let sendField = document.getElementById('services');
        let str = '';
        for(let i =0; i<services.length; i++){
            str += services[i];
        }
        sendField.value = str;

        let tableServices = document.getElementById('servicesTable');

        let tbody = tableServices.getElementsByTagName("TBODY")[0];
        let row = document.createElement("TR");
        //let td1 = document.createElement("TD");
       // td1.appendChild(document.createTextNode(i+1));
        let td2 = document.createElement("TD");
        td2.appendChild(document.createTextNode(strService));
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
            services.splice(index+1, 1);

            let sendField = document.getElementById('services');
            let str = '';
            for(let i =0; i<services.length; i++){
                str += services[i];
            }
            sendField.value = str;

            let row = this.parentElement.parentElement;
            let tbody = tableServices.getElementsByTagName("TBODY")[0];
            tbody.removeChild(row);
            //console.log(sendField.value);
            if(services.length === 0){
                tableServices.style.display = 'none';
            }
        };
        td3.appendChild(delInput);
        //row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        tbody.appendChild(row);

        tableServices.style.display='block';

    }


    //console.log(sendField.value);
}

function AddDiplom () {
    let listDiplom = document.getElementsByClassName("btn btn-danger");
    let diplomCounter = listDiplom.length-1;
    diplomCounter++;
    //console.log(stepCounter);

    let template = $("#diplomTemplate").clone();
    template.css('visibility', 'visible');
    let inputList = template.find("input");
    //console.log(template);
    //console.log(inputList);
    inputList[0].setAttribute("name", "diplom["+ diplomCounter +"][diplomSpecialty]");
    inputList[1].setAttribute("name", "diplom["+ diplomCounter +"][DiplomPhoto]");

    inputList[0].value = "";
    inputList[1].value = "";
    //for (let index = 0; index < inputList.length; index++) {

    // console.log(inputList[index]);

    //inputList[index].setAttribute("name", "step["+ stepCounter +"][StepDescription]"inputList[index].name.substring(0, inputList[index].name.lastIndexOf('_')+1) + stepCounter +"]");
    //inputList[index].name = inputList[index].name + visitCounter;
    //console.log(inputList[index]);
    //  }

    $("#diplomPlaceholder").append(template);
};

function DeleteDiplom(btn) {
    console.log($(btn).closest(".create-diplom-short").remove());

}
