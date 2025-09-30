function getQueryString() {
    const url =
        'http://localhost:8080/isra/Frameworks/graphql/';
    const resp =
        document.getElementById('resp');
    const query =
        document.getElementById('send').value;
    const vars =
        document.getElementById('vars').value;
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ query, vars })
    })
        .then(result => result.json())
        .then(json => {
            resp.value =
                JSON.stringify(json, null, ' ');
        })
        .catch(error => {
            resp.value = error.stack;
        });
}