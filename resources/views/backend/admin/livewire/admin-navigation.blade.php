<x-sections.vertical-nav>
    <x-forms.list-item route="/admin/dashboard" title="Dashboard" pageName="dashboard" icon="home" />
    <x-forms.list-item route="/admin/file-management" title="Dateiverwaltung" pageName="file-management" icon="circle-stack" />

    @section('special_title')
        Administrativ
    @endsection

    @section('special_slots')

        <x-forms.list-item route="/admin/right-management" title="Rechteverwaltung" pageName="right-management" icon="lock-closed" />
        <x-forms.list-item route="/admin/user-management" title="Benutzerverwaltung" pageName="user-management" icon="users" />

    @endsection

</x-sections.vertical-nav>

