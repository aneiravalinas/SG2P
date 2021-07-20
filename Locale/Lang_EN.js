arrayEN = {
    // Database General
    '00001' : 'Successful SQL execution',
    '00002' : 'Recordset is empty',
    '00003' : 'Recordset contains data',
    '00004' : 'Error while connecting with database. Contact your administrator',
    '00005' : 'SQL execution error',

    // Acceso no autorizado
    '00006' : 'You do not have the necessary privileges to perform this action',

    // USUARIO

        // Login
        '01001' : 'You have successfully logged into the system',
        '01102' : 'The credentials entered are invalid',

        // Search
        '01002' : 'Users Search OK',
        '01109' : 'Users Search Error',

        // ADD
        '01124' : 'The Building Manager role is assigned automatically when a user is assigned to a building. Manual assignment of this role is not allowed',
        '01006' : 'The user was added successfully',
        '01131' : 'Error adding user',

        // DELETE
        '01007' : 'User deleted successfully',
        '01135' : 'You cannot delete a user who has buildings assigned',
        '01136' : 'The user cannot be deleted. There must always be at least one person in charge of the organization',
        '01137' : 'The user cannot be deleted. There must always be at least one administrator',
        '01138' : 'Failed to delete user',

        // EDIT
        '01010' : 'User edited successfully',
        '01139' : 'The role cannot be modified. The user is solely responsible for the organization',
        '01140' : 'The role cannot be modified. The user is the only administrator of the application',
        '01141' : 'Error editing user',

        // Búsqueda por Username
        '01000' : 'The username already exist',
        '01100' : 'The username entered does not exist',
        '01101' : 'Query by username failed',

        // Búsqueda por DNI
        '01003' : 'The DNI already exist',
        '01125' : 'The DNI entered does not exist',
        '01126' : 'Query by DNI failed',

        // Búsqueda por Email
        '01004' : 'The email already exist',
        '01127' : 'The email entered does not exist',
        '01128' : 'Query by email failed',

        // Búsqueda por Teléfono
        '01005' : 'The phone number already exist',
        '01129' : 'The phone number entered does not exist',
        '01130' : 'Query by phone number failed',

        // Mas de un usuario por rol
        '01008' : 'There is more than one user with the indicated role',
        '01138' : 'There is less than one user with the indicated role',

        // Validaciones

            // Nombre de Usuario
            '01103' : 'Username must exceed 3 characters',
            '01104' : 'Username cannot exceed 20 characters',
            '01105' : 'Username can only contain alphanumeric characters',

            // Password
            '01106' : 'Password security is compromised. Short encrypted password',
            '01107' : 'Password security is compromised. Long encrypted password',
            '01108' : 'Password security is compromised. Password encrypted with characters not allowed',

            // DNI
            '01110' : 'The DNI cannot be empty',
            '01111' : 'Wrong DNI format',

            // ROL
            '01112' : 'The Rol cannot be empty',
            '01113' : 'The indicated role is not contemplated',

            // Nombre
            '01114' : 'Name must exceed 3 characters',
            '01115' : 'Name cannot exceed 30 characters',
            '01116' : 'Name can only contain alphanumeric characters and spaces',

            // Apellidos
            '01117' : 'Surname must exceed 3 characters',
            '01118' : 'Surname cannot exceed 60 characters,',
            '01119' : 'Surname can only contain alphanumeric characters and spaces',

            // Email
            '01120' : 'Email cannot be empty',
            '01121' : 'Wrong Email format',

            // Telefono
            '01122' : 'Phone number cannot be empty',
            '01123' : 'Wrong phone number format',

            // Foto_Perfil
            '01132' : 'Error while uploading the profile picture',
            '01133' : 'Image extension is not allowed',
            '01134' : 'Image size is larger than allowed (100kb)',



    // INTERFACE
        // HEADER
        'i18n-idioma' : 'Language',
        'i18n-login' : 'Login',
        'i18n-admin' : 'Administration Panel',
        'i18n-logout' : 'Logout',

        // PORTAL_COUNTRIES
        'i18n-app-welcome' : '¡Welcome to SG2P!',
        'i18n-select-building' : 'Select a city to search for Buildings',
        'i18n-l-buildings' : 'Search Buildings',

        // LOGIN
        'i18n-username' : 'Username',
        'i18n-password' : 'Password',

        // MESSAGE_VIEW
        'i18n-msg-system' : 'System Message',
        'i18n-back' : 'Go Back',

        // DESHBOARD VIEW
        'i18n-select-option' : 'Select an option',
        'i18n-users': 'Users',
        'i18n-profile' : 'My Profile',

        // USER VIEWS
        'i18n-dni' : 'DNI',
        'i18n-rol' : 'Role',
        'i18n-details' : 'Details',
        'i18n-edit' : 'Edit',
        'i18n-delete' : 'Delete',
        'i18n-f-administrador' : 'Administrator',
        'i18n-f-edificio' : 'Building Manager',
        'i18n-f-organizacion' : 'Organization Manager',
        'i18n-f-registrado' : 'Registered User',
        'i18n-search-users' : 'Users Search',
        'i18n-nombre' : 'Name',
        'i18n-apellidos' : 'Surname',
        'i18n-telefono' : 'Phone',
        'i18n-email' : 'Email',
        'i18n-cancelar' : 'Cancel',
        'i18n-enviar' : 'Send',
        'i18n-todos' : 'All',
        'i18n-add-users' : 'Add User',
        'i18n-selecciona-rol' : 'Select a Role',
        'i18n-foto_perfil' : 'Profile Photo',
        'i18n-del-confirm' : 'Are you sure you want to delete this user? The action will not be reversible',
        'i18n-edit-user' : 'Editar Usuario',

        // MODAL
            // Campos Modal
            'modal-title' : '¡Warning!',
            'p-modal' : 'The field ',
            'm-username' : ' Username ',
            'm-password' : ' Password ',
            'm-dni' : ' DNI ',
            'm-nombre' : ' Name ',
            'm-telefono' : ' Phone ',
            'm-email' : ' Email ',
            'm-rol' : ' Role ',
            'm-apellidos' : ' Surname ',
            'm-foto_perfil' : ' Profile Photo ',

            // Mensajes Modal
            'i18n-max-size' : 'exceeds the maximum size',
            'i18n-only-letters-numbers' : 'can only contain letters and numbers',
            'i18n-not-empty' : 'cannot be empty',
            'i18n-generic-format' : 'has a wrong format',
            'i18n-letters-spaces-accents-format' : 'only supports letters, spaces and accents',
            'i18n-numbers-format' : 'can only contain numbers',
            'i18n-wrong-enum' : 'has a value not contemplated',
            'i18n-ext-not-allowed' : 'has a not allowed extension',
}