// JavaScript Document
// Submit form with name function.
//alert("I'm in the plugin/carousel folder!");

function addboxes() {
	//$('#addboxes').click(function() {
	//alert("I'm in the addboxes function!");
	
	var it = document.getElementById("imagetotal").value;
	//document.write("got image value: " + it + "<br>");
	var vt = document.getElementById("videototal").value;
	//window.alert("Image total " + it) ;
 	//x[0].submit() ;
	//
	
	//find div wrap
	wrap = document.getElementById("wrap") ;

	//create images urls p
	p_imgsurls = document.createElement("p") ;
	p_imgsurls.setAttribute("id", "images_urls") ;
	p_imgsurls.innerHTML = "<strong>Add Image URLs</strong><br>" ; 
	
	//create images vids p
	p_vidsurls = document.createElement("p") ;
	p_vidsurls.setAttribute("id", "videos_urls") ;
	p_vidsurls.innerHTML = "<strong>Add Video URLs</strong><br>" ;
	
	//create form
	var f = document.createElement("form");
	//alert("form created!");
	f.setAttribute('method',"post") ;
	f.setAttribute('action'," ") ;
	f.setAttribute("id", "urlform") ;
	
	//document.getElementById("wrap").append(f);
	//document.getElementsByTagName('div')[0].appendChild(f) ;
	
	//add image textboxes
		if(it > 0){
	//document.getElementById("images_urls").innerHTML = "<strong>Add Image URLs</strong><br>" ;
	for( n=0; n<it; n++ ){
		var box = document.createElement("input") ;
		box.type = "text" ;
		box.id = "img" + n ;
		box.name = "img" + n ;
		p_imgsurls.appendChild(box) ;
		//document.getElementById(box.id).innerHTML = "Image" ;
		//document.getElementById("images_urls").innerHTML = "<br>" ;	
	}
}
	
	
	//add video textboxes	
	if(vt > 0){
	//document.getElementById("video_urls").innerHTML = "<strong>Add Video URLs</strong><br>" ;
	for(m=0; m<vt; m++){
		box = document.createElement("input") ;
		box.type = "text" ;
		box.id = "vid" + n ;
		box.name = "vid" + n ;
		p_vidsurls.appendChild(box) ;
	}
	}
	
	var hid_submitcheck = document.createElement("input") ;
		hid_submitcheck.setAttribute("type", "hidden") ;
		hid_submitcheck.setAttribute("id", "submit_check") ;
		hid_submitcheck.setAttribute("value", "Y") ;
		hid_submitcheck.setAttribute("name", "submit_check") ;
		f.appendChild(hid_submitcheck) ;
		//document.getElementById(hid.id).innerHTML = "Image" ;
		//document.getElementById("images_urls").innerHTML = "<br>" ;
	
	var hid_imagetotal = document.createElement('input');
		hid_imagetotal.setAttribute("type", "hidden") ;
		hid_imagetotal.setAttribute("id", "imagetotal") ;
		hid_imagetotal.setAttribute("name", "imagetotal") ;
		hid_imagetotal.setAttribute("value", it) ;
		f.appendChild(hid_imagetotal) ;
	
	var hid_videototal = document.createElement('input');
		hid_videototal.setAttribute("type", "hidden") ;
		hid_videototal.setAttribute("id", "videototal") ;
		hid_videototal.setAttribute("name", "videototal") ;
		hid_videototal.setAttribute("value", vt) ;
		f.appendChild(hid_videototal) ;
	
	var s = document.createElement("input") ;
	/*s.type = "submit" ;
	s.value = "Update Carousel" ;*/
	s.setAttribute("type", "submit") ;
	s.setAttribute("value", "Update Carousel") ;
	s.setAttribute("id", "subby") ;
	s.setAttribute("name","subby") ;	
	p_imgsurls.appendChild(s) ;
	
	f.appendChild(p_imgsurls);
	f.appendChild(p_vidsurls);
	f.appendChild(s) ;
	//para.appendChild(f);
	wrap.appendChild(f) ;
	
	
}


/*function submit(){
	var x = document.getElementsByName('added_form') ;
	x[0].submit() ;
}*/