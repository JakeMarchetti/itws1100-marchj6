/* Lab 5 JavaScript File 
   Place variables and functions in this file */

function validate(formObj) {
   // put your validation code here
   // it will be a series of if statements

   if (formObj.firstName.value == "") {
      alert("You must enter a first name");
      formObj.firstName.focus();
      return false;
   }

   if (formObj.lastName.value == "") { 
      alert("You must enter a last name");
      formObj.lastName.focus();
      return false;
   }

   if (formObj.title.value == ""){
      alert("You must enter a title");
      formObj.title.focus();
      return false;
   }

   if (formObj.org.value == ""){
      alert("You must enter an organization");
      formObj.org.focus();
      return false;
   }

   if (formObj.pseudonym.value == "" ){
      alert("Enter a nickname or N/A");
      formObj.pseudonym.focus();
      return false;
   }

   if(formObj.comments.value == "" || formObj.comments.value == "Please enter your comments"){
      alert("Please enter comments or N/A");
      formObj.comments.focus();
      return false;
   }

   alert("Function Validated. Success!");

   return true;
}

function clickAtt (textarea) {
   if(textarea.value == "Please enter your comments"){
      textarea.value = "";
   }
}

function clickOut (textarea) {
   if(textarea.value == ""){
      textarea.value = "Please enter your comments";
   }
}

function showName (first, last, nick){
   alert(first.value + " " + last.value + " is " + nick.value);
}