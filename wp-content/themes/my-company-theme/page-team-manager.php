<?php

if (!defined('ABSPATH')){
    exit;
}

get_header(); ?>

<div class="team-manager">
    <h1><?php _e( 'Team Manager', 'my-company-theme' ); ?></h1>

    <!-- Create -->
    <section id="create-section">
        <h2>Add Team Member</h2>
        <form id="team-form">
            <input type="text" id="team-title" placeholder="Name"/>
            <input type="text" id="team-function" placeholder="Function"/>
            <input type="text" id="team-email" placeholder="Email"/>
            <input type="text" id="team-linkedin" placeholder="LinkedIn"/>
            <button type="submit">Add Member</button>
        </form>
        <div id="team-response"></div>
    </section>

    <!-- Read -->
    <section id="read-section">
        <h2>Team Members</h2>
        <table id="team-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Function</th>
                    <th>Email</th>
                    <th>LinkedIn</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="team-list"></tbody>
        </table>
    </section>

</div>

<?php get_footer(); ?>


