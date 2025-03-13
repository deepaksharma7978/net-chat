// const userObj = localStorage.getItem("user");

// if (!userObj) {
//     console.log('abh');
    
//     window.location.href = "/register.php";
// }

const emojiPicker = document.getElementById("emoji-picker");
const emojiPickerBtn = document.getElementById("emoji-picker-btn");

emojiPickerBtn.addEventListener("click", function() {
    emojiPicker.style.display = "block";
});
