const photoProfile = document.getElementById('photo');
const document = document.getElementById('document');
const role = document.getElementById('role');
console.log(role);
if(role.value == 1){
    photoProfile.classList.remove("hidden");
}else{
    document.classList.remove("hidden");
}