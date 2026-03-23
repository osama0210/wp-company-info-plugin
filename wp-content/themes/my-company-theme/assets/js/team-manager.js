fetch(wpApiSettings.url)
    .then(res => res.json())
    .then(members => {
        members.forEach(member => {
            document.getElementById('team-list').innerHTML += `
        <tr>
            <td>${member.title.rendered}</td>
            <td>${member.meta.team_function}</td>
            <td>${member.meta.team_email}</td>
            <td>${member.meta.team_linkedin}</td>
            <td>
                <button>Edit</button>
                <button>Delete</button>
            </td>
        </tr>
    `;
        });
    });