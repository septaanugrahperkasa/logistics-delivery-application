const selectBtn = document.querySelector(".select-btn"),
      items = document.querySelectorAll(".item");
selectBtn.addEventListener("click", () => {
    selectBtn.classList.toggle("open");
});

items.forEach(item => {
    item.addEventListener("click", () => {
        item.classList.toggle("checked");

        let checked = document.querySelectorAll(".checked"),
            btnText = document.querySelector(".btn-text"),
            hiddenInput = item.querySelector("input[type=hidden]"),
            itemText = item.querySelector(".item-text").innerText;

        if (item.classList.contains("checked")) {
            hiddenInput.value = itemText;
        } else {
            hiddenInput.value = "";
        }

        if (checked && checked.length > 0) {
            btnText.innerText = `${checked.length} Selected`;
        } else {
            btnText.innerText = "Select HUBS";
        }
    });
});
const form = document.querySelector("form");
const nameInput = document.querySelector("input[name=name]");
const emailInput = document.querySelector("input[name=email]");
const telephoneInput = document.querySelector("input[name=telephone]");
const hiddenInputs = document.querySelectorAll("input[type=hidden]");


form.addEventListener("submit", (event) => {
    let valid = true;
    let message = "";
    // cek apakah setidaknya satu value pada form dipilih
    let checked = document.querySelectorAll(".checked");
    if (checked.length === 0) {
        event.preventDefault();
        alert("Silahkan pilih setidaknya satu HUB");
    }

    // cek apakah nama hanya mengandung angka dan karakter
    if (!/^[a-zA-Z\s]*$/.test(nameInput.value)) {
        valid = false;
        message = "Nama hanya boleh mengandung huruf";
    }

    // cek apakah email valid
    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailInput.value)) {
        valid = false;
        message = "Email tidak valid";
    }

    // cek apakah nomor telepon valid
    if (!/^8[0-9]{9,}$/.test(telephoneInput.value)) {
        valid = false;
        message = "Nomor telepon harus diawali dengan angka 8 dan memiliki minimal 10 digit";
    }

    if (!valid) {
        event.preventDefault();
        alert(message);
    } else {
        // telephoneInput.value = "62" + telephoneInput.value;
         // tambahkan input hidden untuk menyimpan nilai telephone dengan awalan "62"
         const hiddenTelephoneInput = document.createElement("input");
         hiddenTelephoneInput.type = "hidden";
         hiddenTelephoneInput.name = "telephone";
         hiddenTelephoneInput.value = "62" + telephoneInput.value;
         form.appendChild(hiddenTelephoneInput);
    }
});