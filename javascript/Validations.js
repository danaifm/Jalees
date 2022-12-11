function notEmptyRadio(input){
  var ischecked = false;
  for(var i = 0; i < input.length; i++){
      if(input[i].checked)
      ischecked = true
  }
  return ischecked;
}
function validFirstName(name){
  return  /^[A-Za-z ]{1,30}$/.test(name);
}
//name:
function commaSeparatedName(name){
if( /^[a-zA-Z]+(,\s*[a-zA-Z ]+)*$/.test(name)){
  var names = Array.from(name.split(","))
  for (var i = 0 ; i <= names.length ; ++i){
    if(names[i].length <= 1 )
    return false
  }
  return true
}
else{return false}
}

function numberOfCommas(name, age){
  if(commaSeparatedAge(age) && commaSeparatedName(name)){
  var names = Array.from(name.split(","));
  var ages = Array.from(age.split(','));
  if(names.length != ages.length)
  return false;
  else return true;
    }
    return false;
  }
//age:
function commaSeparatedAge(name){
if(/^[0-9]+(,[0-9]+)*$/.test(name)){
  var ages= Array.from(name.split(","))
  for (var i = 0 ; i <= ages.length ; ++i){
    if(ages[i] >= 18)
    return false ; 
  }
  return true ; 
}
else{return false}
} 

function validLastName(name){
  return /^[A-Za-z]{1,30}$/.test(name);
}
function validEmail(email){
var pattern =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
return pattern.test(email);
}
function validPass(pass){
  var eight = true;
  var specialChar = false;
  if(pass.length < 8)
    valid = false;
  var sc = '!”#$%&’()*+,-./:;<=>?@[\]^_{|}~`';
  for(var i = 0; i < sc.length; i++){
    if(pass.includes(sc[i],0)){
      specialChar = true;
      break;
    }
  }
  return eight === true && specialChar === true;
}
function validPhone(phone){
   return /05+[0-9]{8}/.test(phone)
}

function validDates(start, end){
  if(end.getTime() < start.getTime())
  return false;
  else
  return true;
}

function validTimes(start, end){
  if(end <= start)
  return false;
  else
  return true;
}
