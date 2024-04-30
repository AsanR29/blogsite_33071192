var openRequests = new Array();
var thisPage = null;
var subPages = {};
var pagePopups = {};

var popup_id = "popup_element";

document.documentElement.style.setProperty('--areacolour', 'transparent');

class callbackObject {
    constructor(callbackMethod){
        this.callback = callbackMethod;
    }
}

class imageCallbackChain {
    constructor(file){
        this.file = file;
        this.fileName = "";
        this.index = -1;
        this.stage = 1;
    }

    callback(responseText){
        if(this.stage == 1){
            this.stage += 1;
            this.index = responseText;
            console.log("Index: " + this.index);
            this.fileName = (parseInt(this.index) + 1) + ".jpeg";
            trySendFile(this.file, this.fileName, this);
            return;

            var formData = new FormData();
            formData.append("imageSubmission", this.file);
            var Request = new XMLHttpRequest();
            Request.open("POST", "php/receive_file.php", false);
            var result = Request.send(formData);
            console.log(result);
            return;
        }
        else if(this.stage == 2){
            let success = "";
            console.log("FINISHING");
            if(responseText){
                success = responseText;
            }
            else{
                success = "Error occured."
            }
            document.getElementById("response").innerHTML = success;
            return;
        }
    }
}

function imageReact() {
    console.log("Changed!!");
    console.log(this);
    var thisFile = this.files[0];
    if(thisFile.size > 5*1024*1024){
        document.getElementById("response").innerHTML = "The file size is too big, try compressing it first. " + thisFile.size;
    }
    else{
        var imageReceiver = new imageCallbackChain(thisFile);
        var post_vars = "file=lastFile";
        fetchFile(null, post_vars, imageReceiver);
    }
}

function imageListen(){
    var fileSender = document.getElementById("imageSubmission");
    fileSender.addEventListener("change", imageReact);
}


function updateCssSize(){
    var height = window.innerHeight;
    var width = window.innerWidth;
    document.documentElement.style.setProperty('--height', height + "px");
    document.documentElement.style.setProperty('--width', width + "px");
}
updateCssSize();

function measureTextarea(){
    var element = document.getElementById("testsubject");
    var w = element.offsetWidth;
    var h = element.offsetHeight;
    var x = element.offsetLeft;
    var y = element.offsetTop;

    var letterWidth = window.getComputedStyle(element).getPropertyValue("font-size");
    letterWidth = parseInt(letterWidth.replace("px", ""));
    var text = element.value;
    //console.log("EAEE");
    //console.log(boxWidth.toString(), letterWidth, text.length*letterWidth, text);
    //aint that something!
    document.documentElement.style.setProperty('--textarea-width', w);
    document.documentElement.style.setProperty('--textarea-height', h);
    document.documentElement.style.setProperty('--textarea-x', x);
    document.documentElement.style.setProperty('--textarea-y', y);

    document.getElementById("shadowArea").innerText = text;
    element = document.getElementById("shadowArea");
    console.log(element.offsetHeight, h);
    if(element.offsetHeight != h){
        var newRows = Number.parseInt(element.offsetHeight / 19);
        element = document.getElementById("testsubject");
        element.rows = newRows.toString();
        //document.documentElement.style.setProperty('--textarea-input-height', element.offsetHeight);
    }
    
}
setInterval(measureTextarea, 10);

function bodyLoad(one, two, three, four, five){
    thisPage = new MyLoadable(one, two, three, four, five);
    thisPage.loadPhp();
}

function popupLoad(one, two, three){
    if(pagePopups[one]){
        pagePopups[one].loadMe();
    }
    else{
        pagePopups[one] = new Popup(one, two, three);
    }
}

function popupUnload(name){
    if(pagePopups[name]){
        pagePopups[name].unloadMe();
        pagePopups[name] = null;
        delete pagePopups[name];
    }
}

function dropdownLoad(one, element_id, three, four, five){
    if(subPages[element_id]){
        document.getElementById(element_id).innerHTML = "";
        document.getElementById(element_id).style.height = "2px";
        delete subPages[element_id];
    }
    else{
        subPages[element_id] = new MyLoadable(one, element_id, three, four, five);
        subPages[element_id].loadPhp();
        document.getElementById(element_id).style.height = "auto";
    }
}

function goPage(direction){
    thisPage.page += direction;
    if(thisPage.page < 1){
        thisPage.page = 1;
    }
    thisPage.loadPhp();
}

function updatePage(fileName, target){
    var url = "options.php?category=" + fileName;
    if(openRequests.length > 0){
        let Request = openRequests[0];
        var targetDiv = document.getElementById(target);
        Request.open("GET", url, true);
        Request.onreadystatechange = function(){
            if(Request.readyState == 4 && Request.status == 200){
                targetDiv.innerHTML = Request.responseText;
            }
        }
        Request.send(null);
    }
}

function fetchFile(location, post_vars, callback = null){//, id){
    var url = "php/loop.php";
    let Request = null;
    for(let i = 0; i < openRequests.length; i++){
        if(openRequests[i].status == 200){
            if(Request == null){
                Request = openRequests[i];
            }
            else{
                openRequests.splice(i,1);
            }
        }
    }
    if(Request == null){
        if(window.XMLHttpRequest){
            Request = new XMLHttpRequest();
        }
        else if(window.ActiveXObject){
            Request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        openRequests.push(Request);
    }
    Request.open("POST",url);
    Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    Request.onreadystatechange = function(){
        if(Request.readyState == 4 && Request.status == 200){
            console.log(location != null, post_vars);
            if(location != null){
                document.getElementById(location).innerHTML = Request.responseText;
            }
            else if(callback != null){
                console.log(Request.responseText);
                callback.callback(Request.responseText);
            }
        }
    }
    Request.send(post_vars);
}

function trySendFile(theFile, fileName, callback = null){
    console.log(fileName);
    var image = new FormData( document.getElementById("blog_form") );
    //image.append("imageSubmission", theFile, fileName);
    for(var value of image.values()){
        console.log(value);
    }
    let Request = null;
    for(let i = 0; i < openRequests.length; i++){
        if(openRequests[i].status == 200){
            if(Request == null){
                Request = openRequests[i];
            }
            else{
                openRequests.splice(i,1);
            }
        }
    }
    if(Request == null){
        if(window.XMLHttpRequest){
            Request = new XMLHttpRequest();
        }
        else if(window.ActiveXObject){
            Request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        openRequests.push(Request);
    }
    Request.open("POST","php/receive_file.php");
    Request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    Request.onreadystatechange = function(){
        if(Request.readyState == 4 && Request.status == 200){
            if(callback != null){
                callback.callback(Request.responseText);
            }
        }
    }
    Request.send(image);
}

class MyLoadable{
    constructor(type, element_id, sql_id, page, total){
        this.type = type;
        this.element_id = element_id;
        this.sql_id = sql_id;
        this.page = page;
        this.total = total;
    }
    loadPhp(){
        var post_vars = "";
        post_vars += "file=" + this.type;
        if(this.page != -1){
            post_vars += "&page=" + this.page;
        }

        if(this.type == "comments"){
            post_vars += "&id=" + this.sql_id;
            post_vars += "&total=" + "10";
        }
        else if(this.type == "comment_reports"){
            if(this.sql_id != -1){
                post_vars += "&comment_id=" + this.sql_id;
            }
            post_vars += "&total=" + "5";
        }
        else if(this.type == "reported_comments"){
            if(this.sql_id != -1){
                post_vars += "&account_id=" + this.sql_id;
            }
            post_vars += "&total=" + "10";
        }
        else if(this.type == "blog"){
            if(this.sql_id != -1){
                post_vars += "&account_id=" + this.sql_id;
            }
            post_vars += "&total=" + "10";
        }
        fetchFile(this.element_id, post_vars);
        return;
    }
    unLoad(){
        document.getElementById(this.element_id).innerHTML = "";
        return;
    }
}

class Popup{
    constructor(type, value, save_value){
        this.type = type;
        this.element_id = popup_id;
        this.value = value;
        this.save_value = save_value;
    }
    unloadMe(){
        document.getElementById(popup_id).style.height = "0%";
        document.getElementById(this.element_id).innerHTML = "";
        document.getElementById(this.element_id).style.height = "0%;";
    }
    loadMe(){
        document.getElementById(popup_id).style.height = "100%";
        document.getElementById(this.element_id).style.height = "100%;";
        this.loadPhp();
    }
    loadPhp(){
        var post_vars = "";
        post_vars += "file=" + this.type;
        if(this.value != null){
            post_vars += "&value=" + this.value;
        }
        if(this.save_value != null){
            post_vars += "&save_value=" + this.save_value;
        }

        fetchFile(this.element_id, post_vars);
        return;
    }
}

function createAccount(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    var post_vars = "file=create_account" + "&username=" + username + "&password=" + password;
    fetchFile(null, post_vars, new callbackObject(callbackCreateAccount));
}

function loginAccount(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    var post_vars = "file=login_account" + "&username=" + username + "&password=" + password;
    fetchFile(null, post_vars, new callbackObject(callbackCreateAccount));
}

function callbackCreateAccount(result){
    if(result){
        history.go(-1);
    }
    else{
        document.getElementById("response").innerHTML = "Invalid details.";
    }
}

function create_comment(account_id, blog_post_id, element_id, date){
    var contents = document.getElementById(element_id).value;
    if(contents == ""){
        return;
    }
    if(account_id == -1){
        console.log(contents);
        popupLoad("popup_login", "leave%20comments", contents);
        popupLoad("popup_login");
        return;
    }
    
    var post_vars = "file=create_comment" + "&account_id=" + account_id + "&blog_post_id=" + blog_post_id + "&contents=" + contents + "&date=" + date;
    fetchFile(null, post_vars);
}

function signupButton(){
    var post_vars = "file=signup";
    fetchFile(null, post_vars);
    return;
}

function loginButton(){
    return;
}

function cleanURL(url){

}