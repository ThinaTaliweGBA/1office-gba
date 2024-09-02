<?php

use BabDev\Breadcrumbs\Contracts\BreadcrumbsGenerator;
use BabDev\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function (BreadcrumbsGenerator $trail) {
    $trail->push(__('breadcrumbs.Home'), route('home'));
});

Breadcrumbs::for('testingview', function ($trail) {
    $trail->push(__('breadcrumbs.Testing View'), route('testingview'));
});

Breadcrumbs::for('memberships', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Memberships'), route('memberships'));
});

Breadcrumbs::for('customize', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Customize'), route('customize'));
});

Breadcrumbs::for('add-member', function ($trail) {
    $trail->parent('memberships');
    $trail->push(__('breadcrumbs.Add Member'), route('add-member'));
});

Breadcrumbs::for('dependants', function ($trail) {
    $trail->parent('memberships');
    $trail->push(__('breadcrumbs.Dependants'), route('dependants'));
});

Breadcrumbs::for('user-settings', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Contacts'), route('user-settings'));
});

Breadcrumbs::for('admin.account.info', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Account Information'), route('admin.account.info'));
});

Breadcrumbs::for('view-member', function ($trail, $id) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.View Member'), route('view-member', $id));
});


Breadcrumbs::for('edit-member', function ($trail, $id) {
    $trail->parent('memberships');
    $trail->push(__('breadcrumbs.Edit Member'), route('edit-member', $id));
});

Breadcrumbs::for('admin.home', function ($trail) {
    $trail->push(__('breadcrumbs.Home'), route('admin.home'));
});

Breadcrumbs::for('user.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.User'), route('user.index'));
});

Breadcrumbs::for('user.edit', function ($trail, $user) {
    $trail->parent('user.index');
    $trail->push(__('breadcrumbs.Edit User: :name', ['name' => $user->name]), route('user.edit', $user));
});

Breadcrumbs::for('user.create', function ($trail) {
    $trail->parent('user.index');
    $trail->push(__('breadcrumbs.Create User'), route('user.create'));
});

Breadcrumbs::for('role.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Roles'), route('role.index'));
});

Breadcrumbs::for('role.edit', function ($trail, $role) {
    $trail->parent('role.index');
    $trail->push(__('breadcrumbs.Edit Role'), route('role.edit', $role->id));
});

Breadcrumbs::for('role.create', function ($trail) {
    $trail->parent('role.index');
    $trail->push(__('breadcrumbs.Create Role'), route('role.create'));
});

Breadcrumbs::for('permission.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Permissions'), route('permission.index'));
});

Breadcrumbs::for('permission.create', function ($trail) {
    $trail->parent('permission.index');
    $trail->push(__('breadcrumbs.Create'), route('permission.create'));
});

Breadcrumbs::for('permission.edit', function ($trail, $id) {
    $trail->parent('permission.index');
    $trail->push(__('breadcrumbs.Edit'), route('permission.edit', $id));
});

Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Settings'), route('settings'));
});

Breadcrumbs::for('home2', function (BreadcrumbsGenerator $trail) {
    $trail->push(__('breadcrumbs.Home2'), route('home2'));
});

// Reports Index
Breadcrumbs::for('reports.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Reports'), route('reports.index'));
});

// Reports Show
Breadcrumbs::for('reports.show', function ($trail, $id) {
    $trail->parent('reports.index');
    $trail->push(__('breadcrumbs.Show Report'), route('reports.show', $id));
});

// Chart
Breadcrumbs::for('chart', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Show Chart'), route('chart'));
});

// Report Index
Breadcrumbs::for('report.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Reports'), route('report.index'));
});

// Report Person
Breadcrumbs::for('report.person', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Person'), route('report.person'));
});

// Fixer Index
Breadcrumbs::for('fixer.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Fixer'), route('fixer.index'));
});

// Mapper Index
Breadcrumbs::for('mapper.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Mapper'), route('mapper.index'));
});

// Reporting
Breadcrumbs::for('reporting', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Reporting'), route('reporting'));
});

// Landing
Breadcrumbs::for('landing', function ($trail) {
    $trail->push(__('breadcrumbs.Landing'), route('landing'));
});

// Commission Create
Breadcrumbs::for('commission.create', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Commissions'), route('commission.create'));
});

// Sales Index
Breadcrumbs::for('sales.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('breadcrumbs.Sales'), route('sales.index'));
});

// Sales Create
Breadcrumbs::for('sales.create', function ($trail) {
    $trail->parent('sales.index');
    $trail->push(__('breadcrumbs.Create'), route('sales.create'));
});

// Logs Show
Breadcrumbs::for('logs.show', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Logs'), route('logs.show'));
});

// Logs Show
Breadcrumbs::for('logs.showtable', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Logs-table'), route('logs.showtable'));
});

// Logs Show
Breadcrumbs::for('whatsapp', function ($trail) {
    $trail->parent('home');
    $trail->push(__('WhatsApp'), route('whatsapp'));
});

// // Logs Show
// Breadcrumbs::for('messages', function ($trail) {
//     $trail->parent('home');
//     $trail->push(__('Messages'), route('whatsappMessages2'));
// });

// Home > WhatsApp Messages
Breadcrumbs::for('whatsappMessages', function ($trail) {
    $trail->parent('home');
    $trail->push('WhatsApp Messages', route('whatsappMessages'));
});

//--------------------------- Start Lededata Breadcrumbs --------------------------------------
Breadcrumbs::for('lededata.audit', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Audit'), route('lededata.audit'));
});
Breadcrumbs::for('lededata.communication', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Communication'), route('lededata.communication'));
});
Breadcrumbs::for('lededata.insurance', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Insurance Claims'), route('lededata.insurance'));
});

Breadcrumbs::for('lededata.lifecycle', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Life Cycle'), route('lededata.lifecycle'));
});
Breadcrumbs::for('lededata.financial', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Finance'), route('lededata.financial'));
});
Breadcrumbs::for('lededata.geographic', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Geographic'), route('lededata.geographic'));
});

Breadcrumbs::for('lededata.demographic', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Demographic'), route('lededata.demographic'));
});
Breadcrumbs::for('lededata.profile', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Profile'), route('lededata.profile'));
});
Breadcrumbs::for('lededata.growth', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Growth Retention'), route('lededata.growth'));
});
//--------------------------- Start Lededata Breadcrumbs --------------------------------------

Breadcrumbs::for('resolutionhub', function ($trail) {
    $trail->parent('home'); // Set 'home' as the parent breadcrumb, or choose another appropriate parent
    $trail->push('resolutionhub', route('resolutionhub')); // Assuming you have a named route 'duplicates'
});

Breadcrumbs::for('resolutionhub2', function ($trail) {
    $trail->parent('home'); // Set 'home' as the parent breadcrumb, or choose another appropriate parent
    $trail->push('resolutionhub2', route('resolutionhub2')); // Assuming you have a named route 'duplicates'
});

Breadcrumbs::for('payments', function ($trail) {
    $trail->parent('home'); // Set 'home' as the parent breadcrumb, or choose another appropriate parent
    $trail->push('payments', route('payments')); // Assuming you have a named route 'duplicates'
});

Breadcrumbs::for('saveBankDetails', function ($trail) {
    $trail->parent('home'); // Set 'home' as the parent breadcrumb, or choose another appropriate parent
    $trail->push('saveBankDetails', route('saveBankDetails')); // Assuming you have a named route 'duplicates'
});

//------------------------ Start Death Breadcrums  -------------------------------------

// Home > Deaths
Breadcrumbs::for('deaths.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Deaths'), route('deaths.index'));
});

// Home > Deaths > Create Death
Breadcrumbs::for('deaths.create', function ($trail) {
    $trail->parent('deaths.index');
    $trail->push(__('Create Death'), route('deaths.create'));
});

// Home > Deaths > [Death Name]
Breadcrumbs::for('deaths.show', function ($trail, $death) {
    $trail->parent('deaths.index');
    $trail->push($death->name, route('deaths.show', $death));
});

// Home > Deaths > [Death Name] > Edit
Breadcrumbs::for('deaths.edit', function ($trail, $death) {
    $trail->parent('deaths.show', $death);
    $trail->push(__('Edit'), route('deaths.edit', $death));
});

//------------------------ Start Funeral Breadcrums  -------------------------------------

// Home > funerals
Breadcrumbs::for('funerals.index', function ($trail) {
    $trail->parent('home');
    $trail->push(__('Funerals'), route('funerals.index'));
});

// Home > funerals > funeral Death
Breadcrumbs::for('funerals.create', function ($trail) {
    $trail->parent('funerals.index');
    $trail->push(__('Create Funeral'), route('funerals.create'));
});

// Home > funerals > [funeral Name]
Breadcrumbs::for('funerals.show', function ($trail, $death) {
    $trail->parent('funerals.index');
    $trail->push($death->name, route('funerals.show', $death));
});

// Home > funerals > [funeral Name] > Edit
Breadcrumbs::for('funerals.edit', function ($trail, $death) {
    $trail->parent('funerals.show', $death);
    $trail->push(__('Edit'), route('funerals.edit', $death));
});


Breadcrumbs::for('pivotGrid', function ($trail) {
    $trail->parent('home');  // Make sure 'home' is defined as a breadcrumb somewhere in this file
    $trail->push('Pivot Grid', route('pivotGrid'));  // Ensure that 'pivotGrid' is a named route in your routes file
});

Breadcrumbs::for('dependantsGrid', function ($trail) {
    $trail->parent('home');  // Make sure 'home' is defined as a breadcrumb somewhere in this file
    $trail->push('Dependants Grid', route('dependantsGrid'));  // Ensure that 'pivotGrid' is a named route in your routes file
});

Breadcrumbs::for('api.rowdetails', function ($trail) {
    $trail->parent('home');  // Assuming 'home' is a defined breadcrumb
    $trail->push('API Details', route('api.rowdetails'));
});
