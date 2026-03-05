const form = document.getElementById('team-form');

form.addEventListener('submit', function (e) {
    e.preventDefault()

    const data = {
        title: document.getElementById('team-title').value,
        status: 'publish',
        meta: {
            _team_function: document.getElementById('team-function').value,
            _team_email: document.getElementById('team-email').value,
            _team_linkedin: document.getElementById('team-linkedin').value,
        }
    }
    console.log(data)
    fetch(wpApiSettings.url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': wpApiSettings.nonce
        }
    })
        .then(res => res.json())
        .then(d => {
            document.getElementById('team-response').innerHTML = 'Member added!'
            console.log(d)
        })
})