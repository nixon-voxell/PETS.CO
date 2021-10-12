var id =  document.getElementsByName("id")[0];
var username =  document.getElementsByName("username")[0];
var email =  document.getElementsByName("email")[0];
var pwd =  document.getElementById("enter_pwd");
var repeatPwd =  document.getElementById("enter_repeat_pwd");

$(document).ready(
  () => {
    id.disabled = true;
    username.disabled = true;
    email.disabled = true;
    pwd.style.visibility = "hidden";
    repeatPwd.style.visibility = "hidden";
  }
);

function edit_profile(btn)
{
  id.disabled = !id.disabled;
  username.disabled = !username.disabled;
  email.disabled = !email.disabled;

  if (id.disabled)
  {
    pwd.style.visibility = "hidden";
    repeatPwd.style.visibility = "hidden";
    btn.textContent = "Edit"
  } else
  {
    pwd.style.visibility = "visible";
    repeatPwd.style.visibility = "visible";
    btn.textContent = "Done"
  }
}