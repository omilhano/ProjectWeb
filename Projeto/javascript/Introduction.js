const copyButton1 = document.getElementById('copy-button1');

copyButton1.addEventListener('click', (event) => {
  const content = document.getElementById('email-copy1').textContent;
  navigator.clipboard.writeText(content);
})

const copyButton2 = document.getElementById('copy-button2');

copyButton2.addEventListener('click', (event) => {
const content = document.getElementById('email-copy2').textContent;
navigator.clipboard.writeText(content);
})

const copyButton3 = document.getElementById('copy-button3');

copyButton3.addEventListener('click', (event) => {
const content = document.getElementById('email-copy3').textContent;
navigator.clipboard.writeText(content);
})

const copyButton4 = document.getElementById('copy-button4');

copyButton4.addEventListener('click', (event) => {
const content = document.getElementById('email-copy4').textContent;
navigator.clipboard.writeText(content);
})
