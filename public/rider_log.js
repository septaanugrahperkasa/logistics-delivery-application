const inputs = document.querySelectorAll("input[type=number]"),
  button = document.querySelector("button");

// iterate over all inputs
inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    // This code gets the current input element and stores it in the currentInput variable
    // This code gets the next sibling element of the current input element and stores it in the nextInput variable
    // This code gets the previous sibling element of the current input element and stores it in the prevInput variable
    const currentInput = input,
      nextInput = input.nextElementSibling,
      prevInput = input.previousElementSibling;

    // if the value has more than one character then clear it
    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }
    // if the next input is disabled and the current value is not empty
    //  enable the next input and focus on it
    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }

    // if the backspace key is pressed
    if (e.key === "Backspace") {
      // iterate over all inputs again
      inputs.forEach((input, index2) => {
        // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop
        // and the previous element exists, set the disabled attribute on the input and focus on the previous element
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled", true);
          input.value = "";
          prevInput.focus();
        }
      });
    }
    //if the fourth input( which index number is 3) is not empty and has not disable attribute then
    //add active class if not then remove the active class.
    if (!inputs[3].disabled && inputs[3].value !== "") {
      button.classList.add("active");
      return;
    }
    button.classList.remove("active");
  });
});

//focus the first input which index is 0 on window load
window.addEventListener("load", () => inputs[0].focus());




// const selectBtn = document.querySelector(".container form .box .container-top .select-btn"),
//       items = document.querySelectorAll(".container form .box .container-top .list-items .item"),
//       span = document.querySelector(".container form .box .span");
// selectBtn.addEventListener("click", () => {
//     selectBtn.classList.toggle("open");
// });
// items.forEach(item => {
//     item.addEventListener("click", () => {
//         // hapus kelas 'checked' dari semua item
//         items.forEach(i => i.classList.remove('checked'));
//         // tambahkan kelas 'checked' ke item yang diklik
//         item.classList.add('checked');

//         let btnText = document.querySelector(".container form .box .container-top .select-btn .btn-text"),
//             hiddenInput = item.querySelector(".container form .box .container-top .list-items .item input[type=hidden]"),
//             itemText = item.querySelector(".container form .box .container-top .list-items .item label .item-text").innerText;

//         // kosongkan nilai dari input 'hub'
//         const hubInput = document.querySelector('.container form .box .container-top .list-items .item input[name="hub"]');
//         hubInput.value = '';
//         const selectedHub = item.querySelector('.container form .box .container-top .list-items .item label .item-text').textContent;
//         item.querySelector('.container form .box .container-top .list-items .item input[name="hub"]').value = selectedHub;


//         // set nilai dari input hidden menjadi teks dari item yang diklik
//         hiddenInput.value = itemText;
//         span.value = itemText;

//         // ubah teks pada tombol select
//         btnText.innerText = `${itemText}`;
//         span.innerText = `${itemText}`;

//     });
// });

const selectBtn = document.querySelector(".select-btn"),
      items = document.querySelectorAll(".item"),
      hubsInput = document.querySelector(".hubs");

selectBtn.addEventListener("click", () => {
    selectBtn.classList.toggle("open");
});

items.forEach(item => {
    item.addEventListener("click", () => {
        // hapus kelas 'checked' dari semua item
        items.forEach(i => {
            i.classList.remove('checked');
            // sembunyikan checklist pada semua item
            i.querySelector('.check-icon').style.display = 'none';
        });
        // tambahkan kelas 'checked' ke item yang diklik
        item.classList.add('checked');
        // tampilkan checklist pada item yang diklik
        item.querySelector('.check-icon').style.display = 'block';

        let btnText = document.querySelector(".btn-text"),
            hiddenInput = item.querySelectorAll("input[type=hidden]"),
            itemText = item.querySelector(".item-text").innerText;

        // kosongkan nilai dari input 'hub'
        const hubInput = document.querySelectorAll('input[name="hub"]');
        hubInput.forEach(input => input.value = '');
        
        const selectedHub = item.querySelector('.item-text').textContent;
        hubsInput.value = selectedHub;

        // set nilai dari input hidden menjadi teks dari item yang diklik
        hiddenInput.value = itemText;

        // ubah teks pada tombol select
        btnText.innerText = `${itemText}`;
    });
});
