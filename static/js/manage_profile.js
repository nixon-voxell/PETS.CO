var id =  document.getElementsByName("id")[0];
var username =  document.getElementsByName("username")[0];
var email =  document.getElementsByName("email")[0];
var pwd =  document.getElementById("enter_pwd");
var repeatPwd =  document.getElementById("enter_repeat_pwd");
var submitBtn = document.getElementById("update_account");

var id_card = $('#id_card');
var id_card_parent = $('#id_card_parent');


$(document).ready(
  () => {
    id.disabled = true;
    username.disabled = true;
    email.disabled = true;
    pwd.style.visibility = "hidden";
    repeatPwd.style.visibility = "hidden";
    submitBtn.style.visibility = "hidden";
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
    submitBtn.style.visibility = "hidden";
    btn.textContent = "Edit"

    id_card.animate({height: 350}, "slow");
  } else
  {
    pwd.style.visibility = "visible";
    repeatPwd.style.visibility = "visible";
    submitBtn.style.visibility = "visible";
    btn.textContent = "Done"

    id_card.animate({height: 700}, "slow");
  }
}