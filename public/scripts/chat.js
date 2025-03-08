const userObj = localStorage.getItem("user");

if (!userObj) {
    console.log('abh');
    
    window.location.href = "/register.php";
}
