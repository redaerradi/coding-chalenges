/*************************************************************************navigation (login page)*/
let cursorNav = 0;
function moveNav(index) {
    const itemsContainer = document.querySelector('.navigation .navigation-content .items');
    const itemsCount = itemsContainer.childElementCount;
    const items = document.querySelectorAll('.navigation .navigation-content .items .item');
    if (cursorNav > (itemsCount - 2)) {
        cursorNav = -1;
    } else if (cursorNav < -1) {
        cursorNav = itemsCount - 2;
    }
    for (let i = 0; i < itemsCount; i++) {
        if (i == (cursorNav + 1)) {
            items[i].className += " active";
        } else {
            items[i].className = items[i].className.replace(' active', '');
        }
    }
    itemsContainer.style.transform = "translateY(" + (-(cursorNav * 33.33)) + "%)";
}

/*************************************************************************select itemNav*/
function activeItemNav(id) {
    document.querySelector('#' + id).className += " active";
}
/*************************************************************************show translate*/
/*show translate add*/
let verifShowTranslateAdd = false;
function showTranslateAdd(e) {
    verifShowTranslateAdd = !verifShowTranslateAdd;
    if (verifShowTranslateAdd) {
        document.querySelector('#translate_add').style.display = "block";
        e.target.className = e.target.className.replace('fa-plus', 'fa-minus');
    } else {
        document.querySelector('#translate_add').style.display = "none";
        e.target.className = e.target.className.replace('fa-minus', 'fa-plus');
    }
}
/*show translate update*/
let verifShowTranslateUpdate = false;
function showTranslateUpdate(e) {
    verifShowTranslateUpdate = !verifShowTranslateUpdate;
    if (verifShowTranslateUpdate) {
        document.querySelector('#translate_update').style.display = "block";
        e.target.className = e.target.className.replace('fa-plus', 'fa-minus');
    } else {
        document.querySelector('#translate_update').style.display = "none";
        e.target.className = e.target.className.replace('fa-minus', 'fa-plus');
    }
}

/*************************************************************************show filtre (custom input)*/
let verifShowFilter = true;
function showFilter() {
    verifShowFilter = !verifShowFilter;
    const filterIcont = document.querySelector("#filter-icon");
    const filtreContainer = document.querySelector("#filter-container");
    if (verifShowFilter) {
        filterContainer.style.display = "block";
        filterIcont.className = filterIcont.className.replace('fa-plus', 'fa-minus');
        return;
    }
    filterContainer.style.display = "none";
    filterIcont.className = filterIcont.className.replace('fa-minus', 'fa-plus');
}
function addItemFilter(e) {
    if (e.keyCode == 13) {
        const value = e.target.value.trim();
        helpAddItemFilter(value);
        e.target.value = "";
    }
    return false;
}
function helpAddItemFilter(value) {
    if (value != "") {
        const itemsFilter = document.getElementById("items-filter");
        //
        const div = document.createElement("div");
        div.className = "item";
        //
        const span = document.createElement("span");
        span.appendChild(document.createTextNode(value));
        div.appendChild(span);
        //
        const i = document.createElement("i");
        i.className = "fas fa-times fa-sm fa-fw";
        i.setAttribute('onclick', "deleteItemFilter(event)");
        div.appendChild(i);
        //
        itemsFilter.insertBefore(div, document.querySelector('#items-filter .input'));
        //
    }
}
function deleteItemFilter(e) {
    e.target.parentElement.remove();
}
/*************************************************************************add new line*/
let lineIds = [1];
function addNewLine() {
    //
    const linesContainer = document.querySelector("#lines-container");
    if (linesContainer != undefined) {
        const newId = lineIds[lineIds.length - 1] + 1
        lineIds[lineIds.length] = newId;
        //
        let newLine = '<div class="p-2 border border-sirail mb-3" id="line-' + newId + '">';
        newLine += '<div class="row mb-2"><div class="col">';
        //
        newLine += '<select class="custom-select custom-select-sm" id="default-' + newId + '">';
        newLine += 'options';
        newLine += '</select>';
        newLine += '</div><div class="col">';
        //
        newLine += '<input type="number" class="form-control form-control-sm" placeholder="Qantity" id="quantity-' + newId + '">';
        newLine += '</div>';
        //
        newLine += '<button class="btn btn-sm bg-sirail text-white" style="margin-right: 12px;" type="button" onclick="deleteLine(' + newId + ')"><i class="fa fa-trash-alt"></i></button>';
        newLine += '</div><div class="row"><div class="col">';
        //
        newLine += '<textarea type="number" class="form-control form-control-sm" placeholder="Comment" id="comment-' + newId + '" style="max-height: 100px;min-height: 100px;"></textarea>';
        newLine += '</div></div></div>';
        //
        linesContainer.innerHTML += newLine;
    }
}
function deleteLine(id) {
    for (let i = 0; i < lineIds.length; i++) {
        if (id == lineIds[i]) {
            //
            const line = document.querySelector("#line-" + id);
            if (line != undefined) {
                //
                for (let j = i; j < lineIds.length - 1; j++) {
                    lineIds[j] = lineIds[j + 1];
                }
                lineIds.length--;
                //
                line.remove();
                break;
            }
        }
    }
}