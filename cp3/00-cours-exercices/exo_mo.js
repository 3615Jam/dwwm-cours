let counter = 0;

document.getElementById("btnincrement").addEventListener("click", (e) => {
  counter++;
  display();
});

document.getElementById("btndecrement").addEventListener("click", (e) => {
  counter--;
  display();
});

document.getElementById("btnReset").addEventListener("click", (e) => {
  counter = 0;
  display();
});

const display = () => {
  document.getElementById(
    "pcontainer"
  ).innerText = `The value of counter : ${counter}`;
};

display();