// Function to fetch actors born on the same day using IMDb API
function getActorsBornToday() {
    // Get the value of the birthdate input field
    var birthdateValue = document.getElementById("birthdate").value;

    // Split the date value into components (year, month, and day)
    var dateComponents = birthdateValue.split("-");
    var month = dateComponents[1];
    var day = dateComponents[2];
    const data = null;

    const xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener('readystatechange', function () {
        if (this.readyState === this.DONE) {
            console.log(this.response);
        }
    });

    xhr.open('GET', `https://online-movie-database.p.rapidapi.com/actors/v2/get-born-today?today=${day}-${month}&first=20`);
    xhr.setRequestHeader('X-RapidAPI-Key', '4a282da450mshb4996e19c8edd67p1e3360jsn8b782ea05fc6');
    xhr.setRequestHeader('X-RapidAPI-Host', 'online-movie-database.p.rapidapi.com');

    xhr.send(data);
}

// Function to fetch actor details by passing an actor ID using IMDb API
function getActorBio(actor_id) {
    $.ajax({
        url: "API_Ops.php",
        type: "GET",
        data: { action: "getActorBio", actor_id: actor_id },
        success: function(response) {
            // Handle successful response
            console.log(response);
            // Parse and display the actor's biography
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
        }
    });
}
