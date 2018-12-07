<script>
function updatecategoryButton ( current_category){
var mycatarr = current_category.split(":");
window.alert("current_category" + current_category);
var mycaturl = document.getElementById("goLink").innerHTML;
var myregurl = document.getElementById("filterLink").innerHTML;
window.alert("mycaturl.indexOf " + mycaturl.indexOf("&amp;"))
	 if(mycaturl.indexOf("&") > 0 || mycaturl.indexOf("&amp;") > 0 ){
	    var origcaturl = mycaturl.split("&amp;");
var leftside = origcaturl[0];
var rightside = origcaturl[1];
window.alert("origcaturl left side = " + leftside.indexOf("q="));
window.alert("origcaturl right side = " + rightside.indexOf("q="));
		//we need to find which side of the & that the q (or category) var is on
		if(leftside.indexOf("q=") > -1){
		window.alert("In updateURLButton  the q= was detected on the left side");
		var insertcaturl = '<a href="?q=' + mycatarr[1] + '&' + rightside;
		window.alert("In updateURLButton  the q= was detected on the left side new insertcaturl = " + insertcaturl);
document.getElementById("goLink").innerHTML=insertcaturl;
document.getElementById("filterLink").innerHTML=insertcaturl;
		}
		else if(rightside.indexOf("q=") > -1){ 
		window.alert("In updateURLButton  the q= was detected on the right side");
		var insertcaturl = leftside + '&q=' + mycatarr[1] + '"><h1>GO</h1></a>';
		window.alert("In updateURLButton  the q= was detected on the right side new insertcaturl = " + insertcaturl);
document.getElementById("goLink").innerHTML=insertcaturl;
document.getElementById("filterLink").innerHTML=insertcaturl;
		}

	}
	else if(mycaturl.indexOf("?") > 0 ){
	var wholecaturl = mycaturl.split("?");
	window.alert("In updateURLButton  the ? was detected  mycatarr[1] > 1 " +mycatarr[1]);
	var insertcaturl = '<a href="?q=' + mycatarr[1] + '"><h1>GO</h1></a>';
	document.getElementById("goLink").innerHTML=insertcaturl; 
	}
	else
	{
	window.alert("In updateURLButton  in else no ? or & was detected IN CATEGORIES LINK mycatarr[1] > 1 " +mycatarr[1]);
		if(myregurl.indexOf("?") > 0 ){
			window.alert("In updateURLButton  in else no ? or & was detected IN CATEGORIES BUT the ? was detected in FILTER <br> SO WE HAVE TO CREATE BUTTON WITH REGIONAL NUMBER INTACT AND INSERT THE NEW CATGEORY IN THE MIDDLE OF THE URL HERE AND UPDATE THE FILTER BUTTON TOO");
			//we already retrieved the filter url with var myregurl = document.getElementById("filterLink").innerHTML;	
			var origregurl = myregurl.split('"><h1>');
			var leftside = origregurl[0];
			var rightside = origregurl[1];
			window.alert("origregurl left side = " + leftside.indexOf("regional_num="));
			window.alert("origregurl right side = " + rightside.indexOf("regional_num="));
			//we KNOW the regional_num var is on the left side
			var insertcaturl = leftside + '&q=' + mycatarr[1] + '"><h1>GO</h1></a>';
			window.alert("In updateURLButton  the q= was detected on the right side new insertcaturl = " + insertcaturl);
			document.getElementById("goLink").innerHTML=insertcaturl;
			document.getElementById("filterLink").innerHTML=insertcaturl;
		}
		else
		{		
			var checkForFilters = document.getElementById("filterLink").innerHTML;
			window.alert("before if");
			if(checkForFilters.indexOf("href") > 0){
			window.alert("after if");
			//we need to add regional_num to the url
			var afterQMFilterLink = checkForFilters.split("=");
			var TempFilterLink = afterQMFilterLink[1].split('"><h1>');
			var insertcaturl = '<a href="?q=' + mycatarr[1] + '&regional_num='+TempFilterLink[0] +'"><h1>GO</h1></a>';
			window.alert("New URL to be inserted with both " + insertcaturl);
			} 
			else
			{
			var insertcaturl = '<a href="?q=' + mycatarr[1] + '"><h1>GO</h1></a>';
			window.alert("New URL to be inserted " + insertcaturl);
			document.getElementById("goLink").innerHTML=insertcaturl; 
			}
		}
	}//close else
}

function updateregionalButton (current_regional_num){
var myregarr = current_regional_num.split(":");
var myregurl = document.getElementById("filterLink").innerHTML;
var mycaturl = document.getElementById("goLink").innerHTML;
window.alert("category url = " + mycaturl);
window.alert("regional url = " + myregurl);
window.alert("current_regional_num" + current_regional_num);
window.alert("myregurl.indexOf " + myregurl.indexOf("&amp;"))
window.alert("myregurl.indexOf " + myregurl.indexOf("?"))

	 if(myregurl.indexOf("&") > 0 || myregurl.indexOf("&amp;") > 0 ){
	    var origregurl = myregurl.split("&amp;");
 		var rightside = origregurl[1];
		window.alert("origregurl left side = " + leftside.indexOf("regional_num="));
		window.alert("origregurl right side = " + rightside.indexOf("regional_num="));
		//we need to find which side of the & that the q (or category) var is on
		if(leftside.indexOf("regional_num=") > -1){
		window.alert("In updateURLButton  the regional_num= was detected on the left side");
		var insertregurl = '<a href="?q=' + myregarr[1] + '&' + rightside;
		window.alert("In updateURLButton  the regional_num= was detected on the left side new insertregurl = " + insertregurl);
document.getElementById("goLink").innerHTML=insertregurl;
document.getElementById("filterLink").innerHTML=insertregurl;
		}
		else if(rightside.indexOf("regional_num=") > -1){ 
	window.alert("In updateURLButton  the q= was detected on the right side");
		var insertregurl = leftside + '&q=' + myregarr[1] + '"><h1>GO</h1></a>';
		window.alert("In updateURLButton  the q= was detected on the right side new insertregurl = " + insertregurl);
document.getElementById("goLink").innerHTML=insertregurl;
document.getElementById("filterLink").innerHTML=insertregurl;
		}  
	}








	else if(myregurl.indexOf("?") > 0 ){
var wholeregurl = myregurl.split("?");
	window.alert("In updateURLButton  the ? was detected  myregarr[1] > 1 " +myregarr[1]);
	var insertregurl = '<a href="?regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
	document.getElementById("filterLink").innerHTML=insertregurl; 

	}
	else
	{
		window.alert("In updateURLButton  in else no ? or & was detected  myregarr[1] > 1 " +myregarr[1]);
		var insertfilterurl = '<a href="?regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
		document.getElementById("filterLink").innerHTML=insertfilterurl; 
		var checkForFilters = document.getElementById("goLink").innerHTML;
		window.alert("before if");
		if(checkForFilters.indexOf("href") > 0){
		window.alert("after if");
		//we need to add regional_num to the url
		var afterQMFilterLink = checkForFilters.split("=");
		var TempFilterLink = afterQMFilterLink[2].split('"><h1>');		
		window.alert("TempFilterLink =" + afterQMFilterLink );
		var insertfilterurl = '<a href="?regional_num=' + myregarr[1] + '&q=' + TempFilterLink[0] + '"><h1>GO</h1></a>';
		window.alert("New URL to be inserted with both " + insertfilterurl);
		document.getElementById("goLink").innerHTML=insertfilterurl;
		document.getElementById("filterLink").innerHTML=insertfilterurl;
		} 
		else
		{
		var insertfilterurl = '<a href="?regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
		window.alert("New URL to be inserted " + insertfilterurl);
		document.getElementById("filterLink").innerHTML=insertfilterurl; 
		}

	  }
}






function updateURLButton ( current_category, current_regional_num){




window.alert("In updateURLButton  mycaturl"+ mycaturl);

window.alert("In updateURLButton  myregurl"+ myregurl);
/*window.alert('is frontcaturl.indexOf("q") > 0 ?' + frontcaturl.indexOf("q"));
window.alert('is frontcaturl.indexOf("regional_num") > 0?' + frontcaturl.indexOf("regional_num"));
window.alert('is backcaturl.indexOf("q") > 0' + backcaturl.indexOf("q"));
window.alert('is backcaturl.indexOf("regional_num") > 0 ? ' + backcaturl.indexOf("regional_num"));
*/
   if(mycaturl.indexOf("&") > 0 || mycaturl.indexOf("&amp;") > 0 || myregurl.indexOf("&") > 0 || myregurl.indexOf("&amp;") > 0){
         //since there is an & we know it has both catid and regional number already - we will replace just the cat id
window.alert('in if has & or amp' + mycaturl.indexOf("&"));
	var wholecaturl = mycaturl.split("&amp;");
window.alert('in if has & or amp whole ' + wholecaturl);

if(wholecaturl[0].indexOf("q") > 0 && mycatarr[1] > 0){
		var newfrontcaturl = '<a href="?q=' + mycatarr[1];
		var newwholecaturl = newfrontcaturl + "&" + wholecaturl[1];
window.alert('in first if newwholecaturl =  ' + newwholecaturl);

		}
            else if(wholecaturl[0].indexOf("regional_num") > 0 && myregarr[1] > 0){
		var newfrontcaturl = '<a href="?regional_num=' + myregarr[1];
		var newwholecaturl = newfrontcaturl + "&" +  wholecaturl[1];
window.alert('in 2nd if newwholecaturl =  ' + newwholecaturl);
		}
	   var split_second_half = wholecaturl[1].indexOf("><h1>");  

 if(split_second_half[0].indexOf("q") == 0 && mycatarr[1] > 0){



		var newbackcaturl = "q=" + mycatarr[1] + '"><h1>GO</h1></a>';
		var newwholecaturl = wholecaturl[0] + "&" + newbackcaturl   ;
window.alert('in third if newwholecaturl =  ' + newwholecaturl);
		}
             else if(split_second_half[0].indexOf("regional_num") == 0 && myregarr[1] > 0){
		var newbackcaturl = "regional_num=" + myregarr[1] + '"><h1>GO</h1></a>';
		var newwholecaturl = wholecaturl[0] + "&" + newbackcaturl  ;
window.alert('in fourth if newwholecaturl =  ' + newwholecaturl);
		}
else
{
window.alert('in fifth if newwholecaturl =  ' + newwholecaturl);
}



	   //example FRONT cat url = <a href="?q=568 OR <a href="?regional_num=1
/*	var frontcaturl = wholecaturl[0].split("?");
window.alert('in if has & or amp  fron ' + frontcaturl);
	//example BACK cat url = amp;regional_num=2568"><h1>GO</h1></a> OR amp;q=1"><h1>GO</h1></a>
	var backcaturl = wholecaturl[1].split('"><h1>');
window.alert('in if has & or amp  back ' + backcaturl);
	   //now we can replace front or back of the url by reconstructing with the new vars in either mycatarr or myregarr
	   //but (if we are doing the cat url) we must find whether the q part is in first half or second half of link.  We look for q in the front of link. If not then it must be in the last half of link
window.alert('in if has & or amp  mycatarr[1] ' + mycatarr[1]);
window.alert('in if has & or amp  myregarr[1] ' + myregarr[1]);


	  	if(frontcaturl.indexOf("q") > 0 && mycatarr[1] > 0){
		var newfrontcaturl = '<a href="?q=' + mycatarr[1];
		var newwholecaturl = newfrontcaturl + "&" + backcaturl;
window.alert('in first if newwholecaturl =  ' + newwholecaturl);

		}
            else if(frontcaturl.indexOf("regional_num") > 0 && myregarr[1] > 0){
		var newfrontcaturl = '<a href="?regional_num=' + myregarr[1];
		var newwholecaturl = newfrontcaturl + "&" +  backcaturl;
window.alert('in 2nd if newwholecaturl =  ' + newwholecaturl);
		}
	      if(backcaturl.indexOf("q") > 0 && mycatarr[1] > 0){
		var newbackcaturl = "q=" + mycatarr[1] + '"><h1>GO</h1></a>';
		var newwholecaturl = wholecaturl[0] + "&" + newbackcaturl   ;
window.alert('in third if newwholecaturl =  ' + newwholecaturl);
		}
             else if(backcaturl.indexOf("regional_num") > 0 && myregarr[1] > 0){
		var newbackcaturl = "regional_num=" + myregarr[1] + '"><h1>GO</h1></a>';
		var newwholecaturl = wholecaturl[0] + "&" + newbackcaturl  ;
window.alert('in fourth if newwholecaturl =  ' + newwholecaturl);
		}
else
{
window.alert('in fifth if newwholecaturl =  ' + newwholecaturl);
}

if(mycatarr[1] > 0){ */
document.getElementById("goLink").innerHTML = newwholecaturl;
document.getElementById("filterLink").innerHTML = newwholecaturl; 

	} 

else if(mycaturl.indexOf("?") > 0 || myregurl.indexOf("?") > 0){
//since there is no & it is either a completely cat_id link or completely a regional number link
//if it is a cat id link we replace the id # otherwise we ignore and make an addition to the link
window.alert("In updateURLButton  ? was detected  in cat or filter button");
window.alert("mycaturl - The whole link?  " + mycaturl);
window.alert("myregurl - The whole link?  " + myregurl);
var wholecaturl = mycaturl.split('"><h1>');
var wholeregurl = myregurl.split('"><h1>');
window.alert("FRONT cat url = Does it have <a href= ? " + wholecaturl[0]);
window.alert("FRONT filter url = Does it have <a href= ? " + wholeregurl[0]);
// Either or situation - let's detect and make the first part of the new link everything from before the "><h1>
var frontwholecaturl = wholecaturl[0];
var frontwholeregurl = wholeregurl[0];
window.alert("FRONT cat url = Does it have <a href= ? non array " + frontwholecaturl);
window.alert("FRONT filter url = Does it have <a href= ? non array " + frontwholeregurl);
window.alert(frontwholecaturl.indexOf('q'));
//window.alert("in if href in url 1 " + frontwholecaturl);
//}
window.alert(frontwholeregurl.indexOf('q'));


if(frontwholecaturl.indexOf('q=') > 0 && myregarr[1] > 0){
	window.alert("front of new link is = " + frontwholecaturl);
	
	var newwholecombourl = frontwholecaturl + "&regional_num=" + myregarr[1] + '"><h1>GO</h1></a>';
	window.alert("HAS A? newwholecombourl with a cat selected first = " + newwholecombourl);
	
}
else if(frontwholeregurl.indexOf('regional_num') > 0 && mycatarr[1] > 0){
window.alert("front of new link is =  Does it have <a href= ? " + frontwholeregurl);
	var newwholecombourl = frontwholeregurl + "&q="+ mycatarr[1] +'"><h1>GO</h1></a>';
	window.alert("HAS A? newwholecombourl with a region selected first = " + newwholecombourl);
  }
else if(frontwholecaturl.indexOf('q=') > 0 && mycatarr[1] > 0){
	window.alert("front of new link is = " + frontwholecaturl);
var middlecaturl = wholecaturl.split('?');//replace the cat id in middlecaturl[1] and recombine for new first half
window.alert("original middlecaturl is =  it have the cat is number ? " + middlecaturl[1]);
middlecaturl[1] = "q="+mycatarr[1];

var newwholecombourl = middlecaturl[0] + '&'+middlecaturl[1] +'"><h1>GO</h1></a>';
	window.alert("HAS A? newwholecombourl with a cat selected first = " + newwholecombourl);
}
else if(frontwholeregurl.indexOf('regional_num') > 0 && myregarr[1] > 0){
//now split on ? 
var middleregurl = wholeregurl.split('?');//replace the cat id in middlecaturl[1] and recombine for new first half
window.alert("original middleregurl is =  it have the cat is number ? " + middleregurl[1]);
middleregurl[1] = "regional_num="+myregarr[1];
var newwholecombourl = middleregurl[0] + '&'+middleregurl[1] +'"><h1>GO</h1></a>';
window.alert("HAS A? newwholecombourl with a cat selected first = " + newwholecombourl);
  }
document.getElementById("goLink").innerHTML = newwholecombourl;
document.getElementById("filterLink").innerHTML = newwholecombourl; 
}





else
{
window.alert("In updateURLButton  in else no ? or & was detected ");
//it the placeholder is the original default default value - insert the input as the only parameter


if(mycatarr[1] > 0){
window.alert("In updateURLButton  in else no ? or & was detected  mycatarr[1] > 1 " +mycatarr[1]);
var insertcaturl = '<a href="?q=' + mycatarr[1] + '"><h1>GO</h1></a>';
window.alert("In updateURLButton  in else no ? or & was detected  var insertcaturl = " + insertcaturl );
window.alert("In updateURLButton  in else no ? or & was detected  document.getElementById(goLink).innerHTML =  " + document.getElementById("goLink").innerHTML  );
document.getElementById("goLink").innerHTML=insertcaturl; 
document.getElementById("filterLink").innerHTML=insertcaturl; 
}
else if(myregarr[1] > 0){
window.alert("In updateURLButton  in else no ? or & was detected  myregarr[1] > 1 " +myregarr[1]);
var insertcaturl = '<a href="?regional_num=' + myregarr[1] + '"><h1>GO</h1></a>';
window.alert("In updateURLButton  in else no ? or & was detected  var insertcaturl = " + insertcaturl );
window.alert("In updateURLButton  in else no ? or & was detected  document.getElementById(filterLink).innerHTML =  " + document.getElementById("filterLink").innerHTML  );
document.getElementById("goLink").innerHTML = newwholecombourl;
document.getElementById("filterLink").innerHTML=insertcaturl; 
}
}

}

 function select_main_category ( selected_category )
{
  document.main_category_form.category_id.value = selected_category ;
  document.main_category_form.submit() ;
}

function getSummaryReport(catid){
//if there is a catid then it came in from the category dropdown so set its myarr value to the catid session var
//if there isn't a cat id its because I sent in an empty value from the toggle report links
var myarr = catid.split(":");
//var catid = sessionStorage.getItem("catid");

 if (catid=="") {
window.alert("In getSummaryReport  catid is empty"+ myarr[1] + "    " + myarr[2]);
    document.getElementById("summary").innerHTML="";
    return;
  }


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
document.getElementById("summary_header").value = wording_ajax_summary_header;
      document.getElementById("summary").innerHTML=this.responseText;
    }
  }

document.getElementById("summary_header").value = wording_ajax_summary_header;
document.getElementById("summary").value = myarr[1];
  xmlhttp.open("GET","getsummaryreport.php?q="+myarr[1],true);
  xmlhttp.send();

}

function getLocationReport(catid, regionalid){
//if there is a catid then it came in from the category dropdown so set its myarr value to the catid session var
//if there isn't a cat id its because I sent in an empty value from the toggle report links
var myarr = catid.split(":");

 if (catid=="") {
    document.getElementById("summary2").innerHTML="";
    return;
  }
}


function deleteAllLevels(form_num) {		
if(form_num == 2){
document.getElementById("location_id").value = '';
document.getElementById("location_name").value = '';
document.getElementById('locHint1').innerHTML= '';
document.getElementById('locHint2').innerHTML= '';
document.getElementById('locHint3').innerHTML= '';
document.getElementById('locHint4').innerHTML= '';
document.getElementById('summary').innerHTML= '';
document.getElementById('expanded').innerHTML= '';
document.getElementById('filterLink').innerHTML= '';
document.getElementById('goLink').innerHTML= '';
 return;
}
else
{
if(form_num == 1){

document.getElementById('category_id').value = '';
document.getElementById('category_name').value = '';
document.getElementById('txtHint1').innerHTML= '';
document.getElementById('txtHint2').innerHTML= '';
document.getElementById('txtHint3').innerHTML= '';
document.getElementById('txtHint4').innerHTML= '';
document.getElementById('summary').innerHTML= '';
document.getElementById('expanded').innerHTML= '';
document.getElementById('filterLink').innerHTML= '';
document.getElementById('goLink').innerHTML= '';
 return;
}
else
{
 return;
}
}		
}
//

function showSubLoc1(str) {
var myarr = str.split(":");

 if (str=="") {
    document.getElementById("locHint1").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
      document.getElementById("locHint1").innerHTML=this.responseText;
 document.getElementById("locHint2").innerHTML=still_more_locs_cont;

    }
  }
document.getElementById("regional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
  xmlhttp.open("GET","getsubloc1.php?regional_num="+myarr[1],true);
  xmlhttp.send();
}



function showSubLoc2(str) {

var myarr = str.split(":");
 if (str=="") {
    document.getElementById("locHint2").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
      document.getElementById("locHint2").innerHTML=this.responseText;
 document.getElementById("locHint3").innerHTML=still_more_locs_coun;
    }
  }
document.getElementById("regional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
  xmlhttp.open("GET","getsubloc2.php?regional_num="+myarr[1],true);
  xmlhttp.send();
}


function showSubLoc3(str) {
var myarr = str.split(":");
 if (str=="") {
    document.getElementById("locHint3").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
      document.getElementById("locHint3").innerHTML=this.responseText;
 document.getElementById("locHint4").innerHTML=still_more_locs_stat;
    }
  }
document.getElementById("regional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];

  xmlhttp.open("GET","getsubloc3.php?regional_num="+myarr[1],true);
  xmlhttp.send();
}

function showSubLoc4(str) {
var myarr = str.split(":");

  if (str=="") {
    document.getElementById("locHint4").innerHTML="";
   return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {

    }
  }

 document.getElementById("locHint4").innerHTML=still_more_locs_city;
  document.getElementById("regional_num").value = myarr[1];
document.getElementById("regional_name").value = myarr[2];
}


function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML =
            this.responseText;
       }
    };
    xhttp.open("GET", "ajax_info.txt", true);
    xhttp.send();
}


function showSubCat1(str) {
var myarr = str.split(":");

sessionStorage.setItem('catid', myarr[1]);
 if (str=="") {
    document.getElementById("txtHint1").innerHTML="";
    return;
  }


  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint1").innerHTML=this.responseText;
 document.getElementById("txtHint2").innerHTML=still_more_cats;

    }
  }
document.getElementById("category_id").value = myarr[1];
document.getElementById("category_name").value = myarr[2];

  xmlhttp.open("GET","getsubcat1.php?q="+myarr[1],true);
  xmlhttp.send();
}

function showSubCat2(str) {
var myarr = str.split(":");
  if (str=="") {
    document.getElementById("txtHint2").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint2").innerHTML=this.responseText;
 document.getElementById("txtHint3").innerHTML=still_more_cats;

    }
  }
  if (myarr[0]=="y") {
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
  xmlhttp.open("GET","getsubcat2.php?q="+myarr[1],true);
  xmlhttp.send();
  }else{

document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
 document.getElementById("txtHint2").innerHTML=no_more_subs;
 document.getElementById("txtHint3").innerHTML="";
    xmlhttp.send();
}
}


function showSubCat3(str) {
window.alert("In showSubCat3  - str =  " + str);
var myarr = str.split(":");
  if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
    return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint2").innerHTML=this.responseText;
 document.getElementById("txtHint3").innerHTML=still_more_cats;
    }
  }
   if (myarr[0]=="y") {
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];


  xmlhttp.open("GET","getsubcat3.php?q="+myarr[1],true);
  xmlhttp.send();
  }else{

document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
document.getElementById("txtHint3").innerHTML=no_more_subs;
 document.getElementById("txtHint4").innerHTML="";
}
}

function showSubCat4(str) {
var myarr = str.split(":");

 if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
   return;
  }

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint3").innerHTML=this.responseText;
    }
  }
   if (myarr[0]=="y") {
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
  xmlhttp.open("GET","getsubcat4.php?q="+myarr[1],true);
  xmlhttp.send();
  }else{
document.getElementById("category_name").value = myarr[2];
document.getElementById("category_id").value = myarr[1];
document.getElementById("txtHint4").innerHTML=no_more_subs;
  
}
}
</script>
