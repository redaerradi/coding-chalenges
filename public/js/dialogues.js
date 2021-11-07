/* **************************************************************************************************************** ajax (get data showing in update dialogue) */
function ajaxPost(url, callback) {
    let xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send('_token=' + document.querySelector("[name='csrf-token']").content);
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                const obj = JSON.parse(this.responseText);
                callback(obj);
            } catch (e) {
                document.querySelector("#dialogue-wait").style.display = "none";
                alert(e);
            }
        }
    };
}
/* ******************************* helper */
function visibleDialogue(id, visible) {
    const dialogue = document.querySelector('#' + id);
    if (dialogue != undefined) {
        if (visible) {
            dialogue.style.display = "block";
            dialogue.className += " show";
        } else {
            dialogue.style.display = "none";
            dialogue.className = dialogue.className.replace(" show", "");
        }
    }
}
/* ******************************* logout */
let verifShowDialogueLogOut = false;
function showDialogueLogOut() {
    verifShowDialogueLogOut = !verifShowDialogueLogOut;
    if (verifShowDialogueLogOut) {
        visibleDialogue('logoutModal', true);
    } else {
        visibleDialogue('logoutModal', false);
    }
}
/* ******************************* filter */
let verifShowDialogueFilter = false;
function showDialogueFilter() {
    verifShowDialogueFilter = !verifShowDialogueFilter;
    if (verifShowDialogueFilter) {
        visibleDialogue('filterModal', true);
    } else {
        visibleDialogue('filterModal', false);
    }
}
/* **** */
function submitFilter() {
    const items = document.querySelectorAll('.cutsom-input .items .item>span');
    let values = "";
    for (let i = 0; i < items.length; i++) {
        values += items[i].innerHTML + (i < items.length - 1 ? "," : "");
    }
    document.querySelector("#values_filter").value = values;
    document.querySelector('#form_filter').submit();
}
/* ******************************* add */
let verifShowDialogueAdd = false;
function showDialogueAdd() {
    verifShowDialogueAdd = !verifShowDialogueAdd;
    if (verifShowDialogueAdd) {
        visibleDialogue('addModal', true);
    } else {
        visibleDialogue('addModal', false);
    }
}
/* ******************************* delete */
let verifShowDialogueDelete = false;
function showDialogueDelete(url) {
    verifShowDialogueDelete = !verifShowDialogueDelete;
    const dialogue = document.querySelector('#deleteModal');
    if (verifShowDialogueDelete) {
        visibleDialogue('deleteModal', true);
        document.querySelector('#form_delete').setAttribute('action', url);
    } else {
        visibleDialogue('deleteModal', false);
        document.querySelector('#form_delete').removeAttribute('action');
    }
}
/* ******************************* update */
let verifShowDialogueUpdate = false;
function showDialogueUpdate(url, url2, callback, callback2 = () => { }) {
    verifShowDialogueUpdate = !verifShowDialogueUpdate;
    if (verifShowDialogueUpdate) {
        document.querySelector("#dialogue-wait").style.display = "flex";
        ajaxPost(url, callback);
    } else {
        //
        callback2();
        document.querySelector('#form_update').removeAttribute('action');
        const inputs = document.querySelectorAll("#form_update input");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].className = inputs[i].className.replace('is-invalid', '');
        }
        //
        visibleDialogue('updateModal', false);
    }
}
/* **** language*/
function showDialogueUpdateLanguage(url, url2, change = true) {
    showDialogueUpdate(
        //urls
        url,
        url2,
        //show
        (obj) => {
            if (change) {
                document.querySelector("#name_update").value = obj.language.name;
                const keys = Object.keys(obj.rows);
                for (let i = 0; i < keys.length; i++) {
                    const in_tr = document.getElementById(keys[i] + "_translate_update");
                    if (in_tr != undefined) {
                        in_tr.value = obj.rows[keys[i]];
                    }
                }
            }
            document.querySelector('#form_update').setAttribute('action', url2);
            document.querySelector("#dialogue-wait").style.display = "none";
            visibleDialogue('updateModal', true);
        },
        //hide
        () => {
            const ins_translate_update = document.querySelectorAll('.in_translate_update');
            for (let i = 0; i < ins_translate_update.length; i++) {
                ins_translate_update[i].value = "";
            }
        }
    );
}
/* **** site*/
function showDialogueUpdateSite(url, url2, change = true) {
    showDialogueUpdate(
        //urls
        url,
        url2,
        //show
        (obj) => {
            if (change) {
                document.querySelector("#name_update").value = obj.site.name;
                document.querySelector("#hello_update").value = obj.site.hello;
                document.querySelector("#language_update").value = obj.site.language_id;
                document.querySelector("#server_url_update").value = obj.site.server_url_odoo;
                document.querySelector("#db_name_update").value = obj.site.db_name_odoo;
                document.querySelector("#user_update").value = obj.site.user_odoo;
                document.querySelector("#password_update").value = obj.site.password_odoo;
            }
            document.querySelector('#form_update').setAttribute('action', url2);
            document.querySelector("#dialogue-wait").style.display = "none";
            visibleDialogue('updateModal', true);
        }
        //hide
    );
}
/* **** */
function showDialogueUpdateRetoucheDefault(url, url2, change = true) {
    showDialogueUpdate(
        //urls
        url,
        url2,
        //show
        (obj) => {
            if (change) {
                document.querySelector("#name_update").value = obj.retoucheDefault.name;
                document.querySelector("#number_update").value = obj.retoucheDefault.number;
            }
            document.querySelector('#form_update').setAttribute('action', url2);
            document.querySelector("#dialogue-wait").style.display = "none";
            visibleDialogue('updateModal', true);
        }
        //hide
    );
}
/* **** */
function showDialogueUpdateUser(url, url2, change = true) {
    showDialogueUpdate(
        //urls
        url,
        url2,
        //show
        (obj) => {
            if (change) {
                document.querySelector("#first_name_update").value = obj.user.first_name;
                document.querySelector("#last_name_update").value = obj.user.last_name;
                document.querySelector("#matricule_update").value = obj.user.matricule;
                document.querySelector("#username_update").value = obj.user.username;
                document.querySelector("#role_update").value = obj.user.role;
                document.querySelector("#site_update").value = obj.user.site_id;
            }
            document.querySelector('#form_update').setAttribute('action', url2);
            document.querySelector("#dialogue-wait").style.display = "none";
            visibleDialogue('updateModal', true);
        }
        //hide
    );
}
/* **** */
function showDialogueUpdateRetouche(url, url2, change = true) {
    showDialogueUpdate(
        //urls
        url,
        url2,
        //show
        (obj) => {
            if (change) {
                document.querySelector("#of_update").value = obj.retouche.of;
                document.querySelector("#serie_update").value = obj.retouche.serie;
                document.querySelector("#product_update").value = obj.retouche.product;
                document.querySelector("#designation_update").value = obj.retouche.designation;
                document.querySelector("#project_update").value = obj.retouche.project;
                document.querySelector("#detection_step_update").value = obj.retouche.detection_step;
            }
            document.querySelector('#form_update').setAttribute('action', url2);
            document.querySelector("#dialogue-wait").style.display = "none";
            visibleDialogue('updateModal', true);
        }
        //hide
    );
}