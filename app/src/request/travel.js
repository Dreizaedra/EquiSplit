export async function getAllTravel(){

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    myHeaders.append("Authorization", "Bearer "+localStorage.getItem("token"));


    const requestOptions = {
        method: "GET",
        headers: myHeaders,
        redirect: "follow"
    };

    fetch("http://localhost:8000/api/travel", requestOptions)
        .then((response) => response.json())
        .then((result) => {
            console.log(result)
        })
        .catch((error) => console.error(error));
}