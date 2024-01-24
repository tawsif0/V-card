const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});

function showImageName() {
  const input = document.getElementById("image");
  const imageName = document.getElementById("image-name");

  if (input.files && input.files[0]) {
    const fileName = input.files[0].name;

    const maxLength = 40;

    const displayFileName =
      fileName.length > maxLength
        ? fileName.substring(0, maxLength) + "..."
        : fileName;

    imageName.textContent = `: ${displayFileName}`;
    imageName.style.color = "#39FF14";
  } else {
    imageName.textContent = "No image selected";
  }
}

var x = document.getElementById("loginn");
var y = document.getElementById("registerr");
var z = document.getElementById("btnn");

function registerr() {
  x.style.left = "-400px";
  y.style.left = "50px";
  z.style.left = "110px";
}

function loginn() {
  x.style.left = "50px";
  y.style.left = "450px";
  z.style.left = "0px";
}
