var _asyncTime = 3000;

function reportAndRefresh(target,data,action,timeOut){
  	var _timeOut = timeOut || _asyncTime;
  	var data = data.trim(),
		data = $.parseJSON(data);
	if(action){
		showNotification(data.status,data.message,_timeOut);
		timeOutReload(_timeOut);
	}else{
		showNotification(data.status,data.message,_timeOut);
		// timeOutReload(_timeOut);
	}
}

function timeOutReload(delay){
	var timeDelay = delay || 3000;
	setTimeout(function(){
		location.reload();
	},timeDelay);
}

// this is to alternate between toastr and manual(self) notification
function showNotification(status,data,asyncTime){
	if(typeof toastr !== 'undefined'){
		showToastNotification(status,data,asyncTime);
	}else{
		showNotifications(status,data);
	}
}

// this is the toast functionality method
function showToastNotification(status,data,asyncTime){
    var i = -1;
    var toastCount = 0;
    var $toastlast;

    // console.log('got here');

    // this is the default setting for the notification
    var _showDuration = 900,
        _hideDuration = 1000,
        _timeOut = asyncTime || 10000,
        _extendedTimeOut = 1000,
        _showEasing = 'swing' || 'linear',
        _hideEasing=  'swing' || 'linear',
        _showMethod = 'show'  || 'fadeIn',
        _hideMethod = 'hide'  || 'fadeOut',
        _positionClass = 'toast-top-left' || 'toast-top-right',
        _shortCutFunction =  status  ? 'success' : 'error',
        _message = data || '',
        _title =  status ? 'Success' : 'Error';

    var getMessage = function () {
    	const _checkStatusMsg = status ? 'operation successful' : 'error in performing the operation';
        return _checkStatusMsg;
    };

    var getMessageWithClearButton = function (msg) {
        msg = msg ? msg : 'Clear itself?';
        msg += '<br /><br /><button type="button" class="btn clear">Yes</button>';
        return msg;
    };

    var shortCutFunction = _shortCutFunction;
    var msg = _message;
    var title = _title || '';
    var $showDuration = _showDuration;
    var $hideDuration = _hideDuration;
    var $timeOut = _timeOut;
    var $extendedTimeOut = _extendedTimeOut;
    var $showEasing = _showEasing;
    var $hideEasing = _hideEasing;
    var $showMethod = _showMethod;
    var $hideMethod = _hideMethod;
    var toastIndex = toastCount++;

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: _positionClass || 'toast-top-right',
        onclick: null
    };

    if (_showDuration) {
        toastr.options.showDuration = _showDuration;
    }

    if (_hideDuration) {
        toastr.options.hideDuration = _hideDuration;
    }

    if (_timeOut) {
        toastr.options.timeOut = _timeOut;
    }

    if (_extendedTimeOut) {
        toastr.options.extendedTimeOut = _extendedTimeOut;
    }

    if (_showEasing) {
        toastr.options.showEasing = _showEasing;
    }

    if (_hideEasing) {
        toastr.options.hideEasing = _hideEasing;
    }

    if (_showMethod) {
        toastr.options.showMethod = _showMethod;
    }

    if (_hideMethod) {
        toastr.options.hideMethod = _hideMethod;
    }

    if (!msg) {
        msg = getMessage();
    }

    var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
    $toastlast = $toast;

    if (typeof $toast === 'undefined') {
        return;
    }

    if ($toast.find('#okBtn').length) {
        $toast.delegate('#okBtn', 'click', function () {
            alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
            $toast.remove();
        });
    }
    if ($toast.find('#surpriseBtn').length) {
        $toast.delegate('#surpriseBtn', 'click', function () {
            alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
        });
    }
    if ($toast.find('.clear').length) {
        $toast.delegate('.clear', 'click', function () {
            toastr.clear($toast, {
                force: true
            });
        });
    }

}

//end toast notification

$(document).ready(function(){
	addAsterisk();
	$('li[data-critical=1] a').click(function(event){
		event.preventDefault();
		var link = $(this).attr('href');
		var action = $(this).text();
		if (confirm("are you sure you want to "+action+" item?")) {
			sendAjax(null,link,'','get',reportAndRefresh);
		}
	});
	$(document).ajaxComplete(function() {
		$('#loading').hide();
	});
	// $('.table-action').mouseleave(function(event) {
	// 	$(this).hide('fast');
	// });
	// $('.table-action li').click(function(event) {
	// 	event.stopImmediatePropagation();
	// 	$(this).parent('.table-action').hide('fast');
	// });
	// $('.dropdownbtn').click(function(event) {
	// 	$(this).children('.table-action').show('fast');

	// });
	$(document).ajaxStart(function() {
		$('#loading').show();
	});
	setDocumentHeight();
	sidebarNavigation();
	pageStateFromCookie();
	bindDropDown('autoload');
	$('#notification').click(function(event) {
		$(this).hide('slow');
	});


//check for number fields 
if (typeof Modernizr !=="undefined") {
	//add event for fields date picker fields 
	if (!Modernizr.inputtypes.date) {
		$("input[type=date]").datepicker({
            format: "yyyy/mm/dd"
        });
	}
	if (!Modernizr.inputtypes.number || !Modernizr.formvalidation) {
	$("input[type=number]").keypress(function(event) {
		processNumberValidation($(this),event);
	});
}
}

//add toggle event
	$(".toggle-upload-field").click(function() {
		$(".bulk-upload-block").show('fast');
	});
	$('.print').click(function(){
		var divElements = $(".print-content").html();
		//Get the HTML of whole page
		var oldPage = document.body.innerHTML;

		//Reset the page's HTML with div's HTML only
		document.body.innerHTML = 
		  "<html><head><title></title></head><body>" + 
		  divElements + "</body>";

		//Print Page
		window.print();
		//Restore orignal HTML
		document.body.innerHTML = oldPage;
		location.reload();
	});
	//function for paging activities
	$('.paged-item').click(function(e){
		var path = location.href;
		var start = $(this).attr('data-start');
		var len= $('#page_size').val();
		if (start!=''&& start!=undefined && len!='' & len!=undefined) {
			path =replaceOrAdd(path,'p_start',start);
			path = replaceOrAdd(path,'p_len',len);
			location.assign(path);
		}

	});
//add function for export button
	$('#export').click(function(){
		var path = location.href.indexOf('?')==-1?location.href+'?&export=yes':location.href+'&export=yes';
		path = path.replace('#','');
		window.open(path,'_blank');
	});
	if (typeof addMoreEvent ==='function') {
		addMoreEvent();
	}
});
//function for adding asterisks to all required element
function addAsterisk(){
	var required =$('input[required],select[required],textarea[required]');
	required.each(function(ind,ele){
		var label = $(this).siblings('label');
		label.after("<i class='"+"input-required'>*</i>");
	});
}
//function to load the state of the page from cookie
function pageStateFromCookie(){
	var cookie = readCookie('openedSection');
	if (!cookie) {
		return;
	}
	expandMenu(cookie);
}
function expandMenu(indices){
		var val =parseInt(indices) + 2;
		var selector = ".treeview:nth-child("+val+")";
		var item =$(selector);
		item.addClass('active');
}
function sidebarNavigation(){
	$('.treeview').click(function(event) {
		var selectedPosition=$('.treeview').index($(this));
		console.log(selectedPosition);
		// saveSelectedToCookie();
		setCookie('openedSection',selectedPosition);
	});
	
}
function saveSelectedToCookie(){
	var values ="";
	//save all the opened index
	$(".sidemenu-items:visible").each(function() {
		var display = $(this).css('display');
		if (display!='none') {
			var parent = $(this).parent();
			var index = parent.index();
			values+=' '+index;
			}
			
		});
	setCookie('openedSection',values);
}
function setDocumentHeight(){
	var topOffset = 170;
	var height = window.innerHeight-topOffset;
	//control the height of the side bar and that of th window
	$("#main").height(height);
	$("#sidebar").height(height);
	$(window).resize(function() {
		height = window.innerHeight-topOffset;
  		$("#main").height(height);
  		$("#sidebar").height(height);
	});
}


//function to test if an item is an array
function isArray(array) {
    return Object.prototype.toString.call(array) == '[object Array]';
}

function isObject(array) {
    return Object.prototype.toString.call(array) == '[object Object]';
}

function showNotifications(status,data){//a boolean value for success or failure
	//work on this code to show toast
	var notification =$("#notification");
	if (status) {
		if (!notification.hasClass('alert-success')) {
			notification.removeClass('alert-danger');
			notification.addClass('alert-success');
		}		
	}
	else{
		if (!notification.hasClass('alert-danger')) {
			notification.removeClass('alert-success');
			notification.addClass('alert-danger');
		}
	}
	notification.html(data);
	animateTop(notification);
	//notification.show('slow');
}

function animateTop(element){
	element.show();
	element.animate({
		top: '10%',
		opacity: 1},
		"slow", function() {
		fadeTimer(element);
	});
}
function fadeTimer(element){
	setTimeout(function() {reverseAnimateTop(element)}, 3000);
	
}
function reverseAnimateTop(element){
	element.animate({
		top: -50,
		opacity: 0
	},
		"slow",function() {
		element.hide();
	});
}
function clearNotification() {
    var notification = $("#notification");
    notification.text("");
}
function moveToNextPage(){
	var loc =$('.continue-btn a').attr('href');
	location.assign(loc);
}
//function for ajax form submission success
// function ajaxFormSubmissionSuccess(target,data) {
// 	try{
// 		var data = data.trim();
// 		data = $.parseJSON(data);
// 		if (typeof(ajaxFormSuccess) ==='function') {
// 			if(isObject(data)){
// 				data = JSON.stringify(data);
// 				reportAndRefresh(target,data);
// 			}else{
// 				ajaxFormSuccess(target.attr("name"),data);return;
// 				// reportAndRefresh(target,data,'flagAction',3000);
// 				// showNotification(data.status,data.message);
// 			}
// 		}
// 		else{
// 			showNotification(data.status,data.message);
// 			if (data.status && target!==null ) {
// 				//if the insert is an insert command just clear the form else leave the form u
// 				if (target.attr('action').indexOf('add')!==-1) {
// 					clearForm(target);
// 				}
// 			}
// 		}
// 	}
// 	catch(err){
// 		showNotification(false,data);
// 	}
// }
function ajaxFormSubmissionSuccess(target,data) {
	try{
		data = data.trim();
		data = $.parseJSON(data);
		if (typeof(ajaxFormSuccess) ==='function') {
			ajaxFormSuccess(target.attr("name"),data);return;
		}
		else{
			showNotification(data.status,data.message);
			if (data.status && target!==null ) {
				//if the insert is an insert command just clear the form else leave the form u
				if (target.attr('action').indexOf('add')!==-1) {
					clearForm(target);
				}
			}
			
		}
	}
	catch(err){
		showNotification(false,data);
	}
}
function ajaxFormSubmissionFailure(target,xhr,data,exception){
	data = data==null?"an error occur while processing the request":data.toString() + ": an error occur while processing the request";
	if (typeof ajaxFormFail =='function') {
		ajaxFormFail(form.attr("name"),data,Exception);
	}
	else{
		showNotification(false,data);
		// clearForm(form);
	}
}
//function to submit ajax call
//let the data be added using formdata when it is supported by the browser
function submitAjaxForm(form){
	//the submitted form is passed
	clearNotification();
	var message = "";
	if (typeof (message =validateFormData(form)!="string")) {
		var data = loadFormData(form);
		var url = form.attr('action');
		sendAjax(form,url,data,'post',ajaxFormSubmissionSuccess,ajaxFormSubmissionFailure);
	}
	else{
		showNotification(false,message);
	}
}

// this function helps send ajax request to the server.
// the first parameter is the target. not always needed can therefore be null,
// then the link , the data(already encode) ,
// the function to call on success and the function to call on failure.
function sendAjax(target,url,data,type,success, failure){
    $.ajax({
        url: url,
        type: type,
        processData:typeof data==='string'?true:false,
        data: data,
        cache: false,
        contentType:typeof data==='string'?'application/x-www-form-urlencoded':false,
        success: function(data){
        	// console.log(data);
        	var _parseData = data,
        		$parse = jQuery.parseJSON(_parseData);

        	if((typeof $parse.flagAction !== 'undefined')){
        		reportAndRefresh(target,data,$parse.flagAction);
        		return true;
        	}

        	if (typeof(success)==='undefined') {
        		ajaxFormSubmissionSuccess(target,data);return;
        	}

        	var len=success.length;
        	if (len ==1) {
        		success(data);
        	}else{
            success(target,data);
        	}
        },
        error:function(xhr,data,exception){
        	if (failure==undefined) {
        		ajaxFormSubmissionFailure(target,xhr,data,exception);return;
        	}
        	var param = failure.length;
        	if (param ==1) {
        		failure(exception);
        	}
        	else if (param=2) {
        		failure(exception,data);
        	}
        	else if (param==3) {
        		failure(exception,data,target)
        	}
        	else{
          	 	failure(target,xhr,data,exception);
       		}
        }
    }
    );
}

/**
 * @param  {form}  the form whose data is to be processed
 * @return {[mixed]} form data object or a serialised string format.
 */
function loadFormData(form){
	var submit = form.find("input[type='submit']");
	var subName = submit.attr('name');
	var subValue = submit.val();
	if (window.FormData === undefined ) {
		var data = form.serialize();
		data+= "&"+encodeURIComponent(subName)+"="+encodeURIComponent(subValue);
		return data;
	}
	var data = new FormData(form[0]);
	data.append(subName,subValue);
	return data;
}
// this function is to preview a single image and not a multiple image
function filePreview(form){
  if(form && form[0]){
    var preview;
    var formId = form.attr('id'),
       preview = document.querySelector("input[type='file'] ~ img"),
       file    = document.querySelector('input[type=file]').files[0];
       if(preview == null){
        var tempPreview = document.querySelector("input[type='file']").previousElementSibling;
         if(tempPreview.tagName.toLowerCase() == 'img'){
          preview = tempPreview;
         }else{
         	$("input[type='file']").after("<img src='' alt='image' width ='80%' height='50%' style='margin-top:10px;' />");
          	preview = document.querySelector("input[type='file'] ~ img");
         }
       }
       // console.log(preview);return;

    if(preview !== null){
      var reader = new FileReader();
      reader.onload = function (e){
        preview.src = reader.result;
      }
      // reader.addEventListener("load", function () {
      //   preview.src = reader.result;
      // }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  }
}
//function to clear the content of a form
function clearForm(form){
	formItems = form.find("input, select, textarea");
	formItems.each(function() {
		var  attribute =$(this).attr("type");
		if (!(attribute=="hidden" || attribute=="submit" || attribute=="reset")) {
			$(this).val("");
		}

	});
}
//function to validate the form submitted
function validateFormData(form){
	form.find('input[required], select[required], textarea[required]').each(function() {
		if ($(this).val().trim()=="") {
 			var name = $(this).attr('name');
 			return name+" is required";
		}
	});;
	return true;//means the form is validated.
}

//set of functions for working with cookie
function setCookie(name, value){
	document.cookie  = name+'='+value;
}
function readCookie(name){
	var cookie = document.cookie;
	var values = cookie.split(';');
	for (var i = values.length - 1; i >= 0; i--) {
		if (values[i]=='') {
			continue;
		}
		var temp = values[i].split('=');
		if (temp.length !=2) {
			return;
		}
		if(temp[0]==name){
			return temp[1];
		}
	}
	return null;
}

//a utility function for loading  select option

/**
 * This function load data form url and pass a function to be called to afer the work is done
 * @param  {[type]}   url      [description]
 * @param  {Function} callback [description]
 * @return {[type]}            [description]
 */
function loadSelectFromUrl(url,select){
	$.get(url, function(data) {
		/*optional stuff to do after success */
		var obj = '';
		if (data.trim()!='') {
			var obj = jQuery.parseJSON(data);
		} 
		
		loadSelect(select,obj);
	});
}
/**
 * This method help load data to any select element specified
 * @param  html select element [description]
 * @param  array[object] data   the object must have an id and value as the field
 * @return none.
 */
function loadSelect(select,data){
	var options = buildOption(data);
	select.html(options);
}
function buildOption(data){
	var result = "<option value=''>..choose..</option>";
	if (data==null) {
		return result;
	}
	for (var i = 0; i < data.length; i++) {
		var current =data[i];
		result+="<option value='"+current.id+"'>"+current.value+"</option>";
	}
	return result;
}
//function for building ajax link based on a relative address
function buildLink(link){
	return $("#base_link").val()+link;
}

//function to show comfirm dialog for delete operation
function processDelete(event,target){
	
}
//function to convert a tabele into a csv format
function convertTableToCsv(table){
	var content = '';
	//check if the table heade paramete is present.
	//just get all the row item on the table and process it into csv
	var rows = table[0].rows;
	for (var i = 0; i < rows.length; i++) {
		content+=extractRow(rows[i]);
	}

	return content;
}
function extractRow(element){
	//load all the data
	var result='';
	var columns=element.cells;
	for(var i=0;i < columns.length; i++) {
		var separator= ',';
		if (i==0) {
			separator='';
		}
		if (columns[i].innerHTML.indexOf('ul')!==-1) {continue;}
		result+=separator+columns[i].textContent;
	}
	result+="\n";
	return result;
}

function bindDropDown(className){
	$('div').on('change',"."+className, function(event) {
		event.stopImmediatePropagation();
		var path = $(this).attr('data-load');
		var child =  $(this).attr('data-child');
		var depend =$(this).attr('data-depend');
		//check if this has a form parent
		var selector = '#'+child;
		var par = $(this).parents('form');
		var currentChild = par?par.find(selector):$(selector);
		var val = $(this).val();
		if (val=="" || val=="..choose..") {
			currentChild.html("<option value='"+"'>..choose..</option>");
			return;
		}
		var data='';
		var dp = '';
		if (depend) {
			var temp = depend.split(',');
			for (var i = 0; i < temp.length; i++) {
				var val1= $("#"+temp[i]).val();
				temp[i]=val1;
			}
			dp = temp.join('/');
		}
		var target =currentChild;
		url = $('#baseurl').val()+'ajaxData/'+path+'/'+val+'/'+dp;
		sendAjax(target,url,data,'get',childLoad);
	});
}

function childLoad(target,data){
	if (target[0].tagName.toLowerCase()=='select') {
		if (data.trim()=="") {target.html('');return;}
		var fromServer = jQuery.parseJSON(data);
		loadSelect(target,fromServer);
		return;
	}
	// if not select just
	target.html(data);
}
function toggleCheckBox(element){
	element[0].checked=!element[0].checked;
}

function successFunction(target,data){
	var message = jQuery.parseJSON(data.trim());
	// message.message = message.status?'Operation Succesful':'Operation failed';
	if (!message.status) {
		toggleCheckBox(target);
	}
	showNotification(message.status,message.message);
}
function failedFunction(exception,data,target){
	target[0].checked =true;
	showNotification(false,'Operation failed');
	toggleCheckBox(target);
}

function saveJsFile(table,anchor){
	var csv = convertTableToCsv(table);
	var outputFile = window.prompt("What do you want to name your output file (Note: This won't have any effect on Safari)") || 'export';
    outputFile = outputFile.replace('.csv','') + '.csv'
    var csvLink = 'data:application/csv;charset=UTF-8,' + encodeURIComponent(csv);
	if (window.navigator.msSaveOrOpenBlob) {
        var blob = new Blob([decodeURIComponent(encodeURI(csv))], {
            type: "text/csv;charset=utf-8;"
        });
        navigator.msSaveBlob(blob, outputFile);
    } else {
        anchor
            .attr({
                'download': outputFile
                ,'href': csvLink
        });
    }
// location.assign(csvLink);
}

//function to add check box to the begining of every an table rows
function addCheckBox(table){
	var rows = table.find('tbody tr');
	for (var i = 0; i < rows.length; i++) {
		var current = rows[i];
		var temp = "<td><input type='checkbox' class='selection' /></td>";
		var html =  current.innerHTML+temp;
		rows[i].innerHTML = html;
	}
}

//function to get the index of a string after a particular position
function getPosition(str,start,needle){
	var index = str.substr(start).indexOf(needle);
	if (index==-1) {
		return index;
	}
	return index+start;
}
function replaceOrAdd(str,variable,value){
	value = encodeURIComponent(value);
	var path = str;
	var ind = path.indexOf(variable+'=');
	if (ind==-1) {
		path += path.indexOf('?')==-1?'?'+variable+'='+value:'&'+variable+'='+value;
		return path;
	}
	else{
		var next = getPosition(path,ind,'&');
		path =next==-1?replaceSubstr(path,ind,next,variable+'='+value):
		path= replaceSubstr(path,ind,next,variable+'='+value);
		return path;
		}
}
function replaceSubstr(str,start,end,replace){
	var temp = end==-1?str.substr(start):str.substr(start,end-start);
	return str.replace(temp,replace);
}

//function to get base url
function getBase(){
	return $('#baseurl').val();
}

//function to presces date dispaly
function processDateDisplay(item,event) {
	//embed the timer loader here
	item.datepicker(
		{
            format: "yyyy/mm/dd"
        });
}

function processNumberValidation(item,event){
	// alert(event.keyCode);
	// if (event.keyCode) {}
}

