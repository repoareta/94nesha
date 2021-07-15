<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Home', '/admin');
});

// Profile
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Profil', route('admin.profil'));
});
Breadcrumbs::for('profile-password', function ($trail) {
    $trail->parent('profile');
    $trail->push('Password', route('admin.profil.password'));
});

// Report
Breadcrumbs::for('report', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Report', '#');
});
// Formulir
Breadcrumbs::for('formulir', function ($trail) {
    $trail->parent('report');
    $trail->push('Formulir', '#');
});
    // Pasien Covid
    Breadcrumbs::for('pasien-covid', function ($trail) {
        $trail->parent('formulir');
        $trail->push('Pasien Covid', route('admin.report.formulir.pasien_covid.'));
    });
    // Penyintas Covid
    Breadcrumbs::for('penyintas-covid', function ($trail) {
        $trail->parent('formulir');
        $trail->push('Penyintas Covid', route('admin.report.formulir.penyintas_covid.'));
    });
    // Penyintas Pasien Covid
    Breadcrumbs::for('penyintas-pasien-covid', function ($trail) {
        $trail->parent('formulir');
        $trail->push('Penyintas & Pasien Covid', route('admin.report.formulir.penyintas_pasien_covid.'));
    });
// Master Data
// Report
Breadcrumbs::for('master', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Master', '#');
});
    // Users
    Breadcrumbs::for('users', function ($trail) {
        $trail->parent('master');
        $trail->push('Users', route('admin.master.users.'));
    });
    Breadcrumbs::for('users-create', function ($trail) {
        $trail->parent('users');
        $trail->push('Create', route('admin.master.users.create'));
    });
    Breadcrumbs::for('users-edit', function ($trail, $data) {
        $trail->parent('users');
        $trail->push('Edit', route('admin.master.users.edit', $data->id));
    });
    Breadcrumbs::for('users-edit-pass', function ($trail, $data) {
        $trail->parent('users-edit', $data);
        $trail->push('Edit Pass', route('admin.master.users_pass.edit', $data->id));
    });