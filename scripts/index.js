let allCookies = document.cookie.split("; ");
let cookie_username = allCookies[0].split("=");
if(cookie_username[0] === 'user' && cookie_username[0]) {
    console.log(cookie_username[1]);
    document.getElementById('user').innerText = cookie_username[1];
} else {
    window.location.href = '403.php';
}

function follow(user) {
    $.ajax({
        method: "POST",
        url: "index.php",
        data: {user_id: user}
    })
        .done(function(result) {
            document.getElementById('follow_user_'+user).innerText = result.trim();
            document.getElementById('follow_btn_'+user).innerHTML = "" +
                "<button type='button' class='btn following'>" +
                "<span>Following</span>" +
                "</button>";
        });
}

function unfollow(user) {
    $.ajax({
        method: "POST",
        url: "index.php",
        data: {user_id: user, unfollow: true}
    })
        .done(function() {
            document.getElementById('follow_user_'+user).innerText--;
            document.getElementById('follow_btn_'+user).innerHTML =
                "<button type='button' onclick='follow("+user+")' class='btn follow'>" +
                "Follow" +
                "</button>";
        });
}
