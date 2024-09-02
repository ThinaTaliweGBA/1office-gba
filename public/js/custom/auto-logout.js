var timeout;

document.onmousemove = resetTimer;
document.onkeypress = resetTimer;

function logout() {
    // replace "/logout" with your logout page URL
    window.location.href = '/logout'; 
}

function resetTimer() {
    clearTimeout(timeout);
    timeout = setTimeout(logout, 1800000); // 300000 ms = 5 minutes , 1800000 = 30 minutes
}