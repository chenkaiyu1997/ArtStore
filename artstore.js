var globalctrl, presentpos = 1 ,trtime="3s";

function transitioninit(trt) {
	var leftdiv = document.getElementById("leftdiv"),
        frontdiv = document.getElementById("frontdiv"),
	    rightdiv = document.getElementById("rightdiv");
	leftdiv.style.transition = trt;
	leftdiv.style.setProperty("-webkit-transition", trt);
	frontdiv.style.transition = trt;
	frontdiv.style.setProperty("-webkit-transition", trt);
	rightdiv.style.transition = trt;
	rightdiv.style.setProperty("-webkit-transition", trt);
}
function changediv(changefrom, changeto, fromdir) {

	//Changing pagedots
	document.getElementById("d"+changefrom).className = "notactive";
	document.getElementById("d"+changeto).className = "active";
	presentpos = changeto;
	
	//Changing images
    var leftdiv = document.getElementById("leftdiv"),
        frontdiv = document.getElementById("frontdiv"),
        rightdiv = document.getElementById("rightdiv");
	transitioninit("0s");
	setTimeout(function () {
		if (fromdir == 0) {
			rightdiv.innerHTML= document.getElementById("i"+changefrom).innerHTML;
			rightdiv.style.left = "0px";
			frontdiv.style.left = "-100%";
            frontdiv.innerHTML= document.getElementById("i"+changeto).innerHTML;
		} else {
            leftdiv.innerHTML= document.getElementById("i"+changefrom).innerHTML;
			leftdiv.style.left = "0px";
			frontdiv.style.left = "100%";
            frontdiv.innerHTML= document.getElementById("i"+changeto).innerHTML;
		}
		setTimeout(function () {
		    transitioninit(trtime);
		    if (fromdir == 0) {
                frontdiv.style.left = "0px";
                rightdiv.style.left = "100%";
            } else { 
                frontdiv.style.left = "0px";
                leftdiv.style.left = "-100%";
		  }
		}, 20);
	}, 20);
}

function changectrl(changefrom, changeto) {
	changediv(changefrom, changeto, 1);
    globalctrl = setTimeout(function () {changectrl(changeto, changeto % 5 + 1, 1);
        }, 5000);
}

function breakctrl(changeto) {
    window.clearTimeout(globalctrl);
    var dir;
    if (changeto > presentpos) dir = 1;
    else dir = 0;
    changediv(presentpos, changeto, dir);
    globalctrl = setTimeout(function () {changectrl(changeto, changeto % 5 + 1, 1);
    }, 5000);
}
function gotopage(changeto) {
    if(changeto==0)
        changeto=document.getElementById("pageinput").value;
    var totpage=document.getElementById("pagenum").innerHTML;
    if(changeto>=1 && changeto<=totpage) {
        var dir;
        if (changeto > presentpos) dir = 1;
        else dir = 0;
        changediv(presentpos, changeto, dir);
    }
}
function prevpage() {
    gotopage(presentpos-1);
}
function nextpage() {
    gotopage(presentpos+1);
}
function leftone() {
	if(presentpos!=1)
		breakctrl(presentpos-1);
}
function rightone() {
	if(presentpos!=5)
		breakctrl(presentpos+1);
}

//Copied function to process cookies
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}


function textonfocus()
{
    document.getElementById("textdes").style.border="2px solid rgb(108,181,217)";
}
function textnotfocus()
{
    document.getElementById("textdes").style.border="2px solid #ccc";
}
function changeheart()
{    
    document.getElementById('heart').style.backgroundImage="url('icon/red-heart.png')";
}


function appearleftdig() {
    var curtain=$('#curtain'),dialog=$('#dialogleft');
    curtain.css("display","block");
    dialog.css("left","0%");
    return dialog;
}
function appearbottomdig(str) {
    var dialog=$('#dialogbottom');
    dialog.css("background-color","rgb(85,193,180)");
    dialog.css("bottom","0px");
    dialog.html('<p><span class="fa fa-check"></span> '+str+"</p>");
    setTimeout(function(){clearbottomdig();},4000);
    return dialog;
}
function clearbottomdig() {
    dialog=$('#dialogbottom');
    dialog.css("bottom","-80px");
}
function waitingdig(dialog,str) {
    dialog.css("background-color","rgb(108,181,217)");
    dialog.html('<p><span class="fa fa-spinner fa-spin"></span> '+str+"</p>");
    return dialog;
}
function successdig(dialog,str) {
    dialog.css("background-color","rgb(85,193,180)");
    dialog.html('<p><span class="fa fa-check"></span> '+str+"</p>");
    return dialog;
}
function warningdig(dialog,str) {
    dialog.css("background-color","rgb(250,172,61)");
    dialog.html('<p><span class="fa fa-warning"></span> '+str+"</p>");
    return dialog;
}
function appendlink(dialog,text,href) {
    dialog.append('<a href="'+href+'">'+text+'</a>');
    return dialog;
}
function appendfunc(dialog,text,funcname) {
    dialog.append('<a onclick="'+funcname+'">'+text+'</a>');
    return dialog;
}

function clearleftdig(){
    var curtain=$('#curtain'),dialog=$('#dialogleft');
    curtain.css("display","none");
    dialog.css("left","-120%");
}

function getid(){
    var str=window.location.search.substring(1);
    var id=426;
    var str2=str.split('&');
    for(i=0;i<str2.length;i++) {
        var tmp = str2[i].split('=');
        if (tmp[0] == 'id')
            id = tmp[1];
    }
    return id;
}
function homeonload() {
    document.getElementById("frontdiv").innerHTML=document.getElementById("i1").innerHTML;
    document.getElementById("d1").className="active";
    setTimeout(function(){changectrl(1,2);},500);
}
function searchonload() {
    document.getElementById("frontdiv").innerHTML=document.getElementById("i1").innerHTML;
    var totpage=document.getElementById("pagenum").innerHTML;
    document.getElementById("d1").className="active";
    var icount=0;
    for(i=1;i<=totpage;i++) {
        var jsxhr = $.get("searchdiv.php?" + "page=" + i);
        jsxhr.done(function (data) {
            icount++;
            document.getElementById("i"+icount).innerHTML=data;
        });
        jsxhr.fail(function (jsxhr) {
            console.log("searchonload status" + jsxhr.status);
        });
    }
}


function addtocart() {
    var id=getid();
    var jsxhr = $.get("addtocart.php?" + "id=" + id);
    var dialog=appearbottomdig("商品已成功加入购物车");
    //$(".workprice").html("Out of Stock!");
    //$(".addtocart").hide();

    appendlink(dialog,"去结算","cart.php");
    jsxhr.done(function (data) {
        console.log("addtocart success" + data);
    });
    jsxhr.fail(function (jsxhr) {
        console.log("addtocart status" + jsxhr.status);
    });
}
// $(document).ready(function(){
//     $('#addtocart').click(addtocart());
// });


function successjump() {
    var pos=readCookie("presentpos");
    location.href=pos;
}
function submiterror(str){
    var errorp=document.getElementById("formerror");
    errorp.style.visibility="visible";
    errorp.innerHTML=str;
}
function submiterrorclear(){
    var errorp=document.getElementById("formerror");
    errorp.style.visibility="hidden";
}
function login() {
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    if (username.value == "" || password.value == "") {
        submiterror("请输入用户名和密码");
        return false;
    }
    var dialog=appearleftdig();
    waitingdig(dialog,"Processing...Please wait.");
    setTimeout(function () {
        var jsxhr = $.get("login.php?" + "username=" + username.value +"&password="+password.value);
        jsxhr.done(function (data) {
            if(data=="success") {
                successdig(dialog,"Success !");
                appendfunc(dialog,"好的","successjump()");
                setTimeout(function(){
                    successjump();
                },2000);
            }
            else {
                warningdig(dialog,"Incorrect username or password !");
                appendfunc(dialog,"好的","clearleftdig()");
                setTimeout(function(){clearleftdig();},2000);
                submiterror("用户名或密码错误");
            }
            console.log("loginsuccess" + data);
        });
        jsxhr.fail(function (jsxhr) {
            console.log("loginstatus" + jsxhr.status);
        });
    },800);
    return false;
}
function logout() {
    $.ajax({
        url : "logout.php",
        type : "GET",
        success : function(data) {
            window.location.reload();
        },
        error : function(data) {
            console.log("register status" + data.status);
        }
    });
}
function checkmail() {
    var mail = document.getElementById("username");
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(mail.value)) {
        mail.style.borderColor = "rgb(238,113,115)";
        submiterror("Please enter a valid email.");
    }
    else {
        mail.style.borderColor = "#ccc";
        submiterrorclear();
    }
}
function checklen() {
    var pass1 = document.getElementById("password");
    pass1.style.border = "2px solid #ccc";

    if (pass1.value.length < 6) {
        submiterror("Password should be at least 6 digits");
        pass1.style.borderColor = "rgb(238,113,115)";
    }
    else if ($.isNumeric(pass1.value)) {
        submiterror("Password should contain at least 1 character");
        pass1.style.borderColor = "rgb(238,113,115)";
    }
    else {
        pass1.style.borderColor = "#ccc";
        submiterrorclear();
    }
}
function checkpwd() {
    var pass1 = document.getElementById("password");
    var pass2 = document.getElementById("password2");
    if (pass1.value != pass2.value) {
        submiterror("Passwords are different !");
        pass2.style.borderColor = "rgb(238,113,115)";
    }
    else {
        pass2.style.borderColor = "#ccc";
        submiterrorclear();
    }
}
function register() {
    var dialog=appearleftdig();
    waitingdig(dialog,"Processing...Please wait.");
    setTimeout(function () {
        $.ajax({
            url : "register.php",
            type : "GET",
            data : $( '#signupform').serialize(),
            success : function(data) {
                if(data=="success") {
                    login();
                }
                else {
                    warningdig(dialog,"E-mail already registed ! Please sign in or change one");
                    appendfunc(dialog,"好的","clearleftdig()");
                    setTimeout(function(){clearleftdig();},2000);
                    submiterror("邮箱已注册 ! 请更换");
                }
                console.log("register success" + data);
            },
            error : function(data) {
                console.log("register status" + data.status);
            }
        });
    },800);
    return false;
}

function checklogin() {
    if(document.getElementById("logstate0")!=undefined) {
        var dialog=appearleftdig();
        warningdig(dialog,"Please log in first !");
        appendlink(dialog,"Log in","signin.php");
    }
}


function removeitem(index) {
    var dialog=appearleftdig();
    warningdig(dialog,"确定删除吗 ?");
    appendfunc(dialog,"删除","reallyremoveitem("+index+")");
    appendfunc(dialog,"不要","clearleftdig()");
}
function reallyremoveitem(index) {
    var dialog=appearleftdig();
    waitingdig(dialog,"Processing ... Please wait.");
    setTimeout(function () {
        var jsxhr = $.get("removeitem.php?" + "index=" + index);
        jsxhr.done(function (data) {
            successdig(dialog,"删除成功 !");
            appendfunc(dialog,"好的","reload()");
            setTimeout(function(){reload();},2000);
            console.log("removeitem success" + data);
        });
        jsxhr.fail(function (jsxhr) {
            console.log("removeitem status" + jsxhr.status);
        });
    },800);
}

function reload() {
    window.location.reload();
}
function pay() {
    var dialog=appearleftdig();
    waitingdig(dialog,"Processing ... Please wait.");
    setTimeout(function () {
        var jsxhr = $.get("pay.php");
        jsxhr.done(function (data) {
            if(data=="success") {
                successdig(dialog,"购买成功,商品将尽快送达您手中 !");
                appendfunc(dialog,"好的","reload()");
                appendlink(dialog,"查看订单","account.php");
            }
            else if(data=="nomoney"){
                warningdig(dialog,"您的余额不足 !");
                appendlink(dialog,"去充值","account.php");
                appendfunc(dialog,"我知道了","clearleftdig()");
            }
            else if(data=="noitem"){
                warningdig(dialog,"购物车是空的 !");
                appendfunc(dialog,"我知道了","clearleftdig()");
            }
            else {
                warningdig(dialog,"部分商品已失效并移除");
                appendfunc(dialog,"点击重试","reload()");
            }
            console.log("pay success" + data);
        });
        jsxhr.fail(function (jsxhr) {
            console.log("pay status" + jsxhr.status);
        });
    },800);
}


function uploadFile (dialog,filepath) {
    var formData = new FormData();
    formData.append("file",document.getElementById("pubfile").files[0]);
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("load", transferComplete, false);
    xhr.addEventListener("error", transferFailed, false);
    xhr.open('POST', 'uploadfile.php?id='+filepath, true);
    xhr.send(formData); // actually send the form data
    function transferComplete(evt) { // stylized upload complete
        console.log("upload "+xhr.responseText);
        if(xhr.responseText=="success") {
            successdig(dialog,"Upload success !");
            appendlink(dialog,"去看看","account.php");
            setTimeout(function(){clearleftdig();},2000);
            return true;
        }
        else {
            warningdig(dialog,"Upload failed !");
            appendfunc(dialog,"Okay","clearleftdig()");
            console.log("upload done but failed "+xhr.responseText);
            return false;
        }
    }
    function transferFailed(evt) {
        console.log("upload transfer failed "+evt);
        return false;
    }
}


function publish() {
    var dialog=appearleftdig();
    waitingdig(dialog,"Uploading...Please wait...");
    setTimeout(function () {
        var list= document.forms["tf"];
        for (var i = 0; i < list.length; i++) {
            if (list[i].value == null || list[i].value == "") {
                warningdig(dialog, "Please fill in all blanks");
                appendfunc(dialog, "Okay", "clearleftdig()");
                return false;
            }
        }

        var idstr=document.getElementById("filepath").innerHTML;
        if(idstr!=""){
            idstr="&filepath="+idstr;
        }
        $.ajax({
            url : "publishtextdata.php",
            type : "GET",
            data : $('#publishtextform').serialize()+idstr,
            success : function(data) {
                console.log("publishsuccess" + data);

                if(document.getElementById('pubfile').value!="")
                    uploadFile(dialog,data);
                else {
                    successdig(dialog,"Upload success !");
                    appendlink(dialog,"去看看","account.php");
                    setTimeout(function(){clearleftdig();},2000);
                }
            },
            error : function(data) {
                console.log("publish status" + data.status);
            }
        });
    },800);
    return false;
}
function publishonload() {
    document.getElementById("pubfile").onchange = function () {
        document.getElementById("pubimg").style.display = "block";
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("pubimg").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
}

function charge() {
    var money=document.getElementById("chargemoney").value;
    var dialog=appearleftdig();
    waitingdig(dialog,"Processing ... Please wait.");
    setTimeout(function () {
        var jsxhr = $.get("charge.php?money="+money);
        jsxhr.done(function (data) {
            if(data=="success") {
                successdig(dialog, "已为您的账户充值了  $ "+money);
                appendfunc(dialog, "好的", "reload()");
                setTimeout(function(){reload();},2000);
            }
            console.log("charge success" + data);
        });
        jsxhr.fail(function (jsxhr) {
            console.log("charge status" + jsxhr.status);
        });
    },800);
    return false;
}

function reallyremovework(id) {
    var dialog=appearleftdig();
    waitingdig(dialog,"Processing ... Please wait.");
    setTimeout(function () {
        var jsxhr = $.get("publish.php?" + "id=" + id + "&delete=1&mode=1");
        jsxhr.done(function (data) {
            successdig(dialog,"删除成功 !");
            appendfunc(dialog,"好的","reload()");
            setTimeout(function(){reload();},2000);
            console.log("removework success" + data);
        });
        jsxhr.fail(function (jsxhr) {
            console.log("removework status" + jsxhr.status);
        });
    },800);
}

function removework(id) {
    var dialog=appearleftdig();
    warningdig(dialog,"确定删除吗 ?");
    appendfunc(dialog,"删除","reallyremovework("+id+")");
    appendfunc(dialog,"不要","clearleftdig()");
}