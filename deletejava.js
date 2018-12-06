function deleteshift(shiftid)
{
	  var de=confirm("do you want to delete shift");
	  
	  if(de===true)
	  { 


          var xhr = new XMLHttpRequest();
           xhr.onreadystatechange=function()
		   
		   {
			if(xhr.readyState === 4 && xhr.status === 200)
			    {
					 location.reload();
				}
				
		  
	       } ;
	  
	      xhr.open("GET","Deletedata.php?del"+shiftid,true);
		  xhr.send();
	  else{
					alert("connection was undefined");
				}
	  }
}