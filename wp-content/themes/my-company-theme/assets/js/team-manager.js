function fetchMembers() {
    fetch(wpApiSettings.url)
        .then(res => res.json())
        .then(members => {
            const list = document.getElementById('team-list');
            list.innerHTML = '';
            members.forEach(member => {
                list.innerHTML += `
                    <tr data-id="${member.id}">
                        <td>${member.title.rendered}</td>
                        <td>${member.meta.team_function}</td>
                        <td>${member.meta.team_email}</td>
                        <td>${member.meta.team_linkedin}</td>
                        <td>
                            <button class="edit-btn" data-id="${member.id}">Edit</button>
                            <button class="delete-btn" data-id="${member.id}">Delete</button>
                        </td>
                    </tr>
                `;
            });
            deleteMembers();
            editMembers();
        });
}

fetchMembers();

const form = document.getElementById('team-form');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    const data = {
        title: document.getElementById('team-title').value,
        status: 'publish',
        meta: {
            team_function: document.getElementById('team-function').value,
            team_email: document.getElementById('team-email').value,
            team_linkedin: document.getElementById('team-linkedin').value,
        }
    };

    fetch(wpApiSettings.url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': wpApiSettings.nonce
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
        .then(d => {
            document.getElementById('team-response').innerText = 'Member added!';
            fetchMembers();
        });
})

function deleteMembers() {
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch(wpApiSettings.url + '/' + id, {
                method: 'DELETE',
                headers: {
                    'X-WP-Nonce': wpApiSettings.nonce
                }
            })
                .then(res => res.json())
                .then(d => {
                    console.log(d);
                    fetchMembers();
                })
        })
    })
}

function editMembers() {
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const row = document.querySelector(`tr[data-id="${id}"]`);
            const cells = row.querySelectorAll('td');

            const currentName = cells[0].innerText;
            const currentFunction = cells[1].innerText;
            const currentEmail = cells[2].innerText;
            const currentLinkedin = cells[3].innerText;

            row.innerHTML = `
                <td><input type="text" value="${currentName}"/></td>
                <td><input type="text" value="${currentFunction}"/></td>
                <td><input type="text" value="${currentEmail}"/></td>
                <td><input type="text" value="${currentLinkedin}"/></td>
                <td>
                    <button class="save-btn" data-id="${id}">Save</button>
                </td>
            `;

            saveMembers();

        })
    })
}

function saveMembers() {
    document.querySelectorAll('.save-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const row = document.querySelector(`tr[data-id="${id}"]`);
            const inputs = row.querySelectorAll('input');

            const data = {
                title: inputs[0].value,
                meta: {
                    team_function: inputs[1].value,
                    team_email: inputs[2].value,
                    team_linkedin: inputs[3].value,
                }
            };

            fetch(wpApiSettings.url + '/' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': wpApiSettings.nonce
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(d => {
                console.log(d);
                fetchMembers();
            });
        });
    });
}