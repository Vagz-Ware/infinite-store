function displaySearchContainer() {
    let searchContainer = document.querySelector(".search-container");
    searchContainer.style.visibility = 'visible';
    searchContainer.classList.add('visible');
}

function hideSearchContainer() {
    let searchContainer = document.querySelector(".search-container");
    searchContainer.style.visibility = 'visible'; // Ensure it's visible to start the transition
    searchContainer.classList.remove('visible');

    function handleTransitionEnd() {
        if (!searchContainer.classList.contains('visible')) {
            searchContainer.style.visibility = 'hidden';
        }
        // Remove the event listener after it has been executed
        searchContainer.removeEventListener('transitionend', handleTransitionEnd);
    }

    // Wait for the transition to complete
    searchContainer.addEventListener('transitionend', handleTransitionEnd);
}

function changeToCheckout(){
    window.location.href='checkout.php';
}

function changeToRegister() {
    window.location.href='user_reg.php';
}


function changeToLogin() {
    window.location.href='user_login.php';
}

function changeToUserUpdate() {
    window.location.href='update_user_profile.php';
}

function changeToAdminUpdate() {
    window.location.href='update_admin_profile.php';
}

function changeToUserProfile(){
    window.location.href='user_profile.php';
}