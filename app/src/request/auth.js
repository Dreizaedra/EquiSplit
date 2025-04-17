function  getAuthToken() {

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
        "email": "admin@admin.fr",
        "password": "admin"
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    fetch("http://localhost:8000/auth", requestOptions)
        .then((response) => response.json())
        .then((result) => {
            localStorage.setItem("token",result.token)
        })
        .catch((error) => console.error(error));
}

getAuthToken()



