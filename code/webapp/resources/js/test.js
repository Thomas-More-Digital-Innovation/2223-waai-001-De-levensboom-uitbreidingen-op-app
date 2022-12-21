import "./bootstrap"

axios.get('/api/department')
    .then(response => {
        console.log(response)
        document.getElementById("afdelingen").innerText = response.data.departments[0].length
    });