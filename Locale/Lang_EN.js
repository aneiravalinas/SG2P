arrayEN = {
    // Database General
    'QRY_OK' : 'Successful SQL execution',
    'QRY_EMPT' : 'Recordset is empty',
    'QRY_DATA' : 'Recordset contains data',
    'DB_ERR' : 'Error while connecting with database. Contact your administrator',
    'QRY_KO' : 'SQL execution error',

    // Acceso no autorizado
    'FRB_ACCS' : 'You do not have the necessary privileges to perform this action',

    // USUARIO

        // Login
        'LOG_OK' : 'You have successfully logged into the system',
        'LOG_KO' : 'The credentials entered are invalid',

        // Search
        'USR_SRCH_OK' : 'Users Search OK',
        'USR_SRCH_KO' : 'Users Search Error',

        // ADD
        'BM_ADD' : 'The Building Manager role is assigned automatically when a user is assigned to a building. Manual assignment of this role is not allowed',
        'USR_ADD_OK' : 'The user was added successfully',
        'USR_ADD_KO' : 'Error adding user',

        // DELETE
        'USR_DEL_OK' : 'User deleted successfully',
        'BM_DEL' : 'You cannot delete a user who has buildings assigned',
        'OM_UNQ_DEL' : 'The user cannot be deleted. There must always be at least one person in charge of the organization',
        'ADM_UNQ_DEL' : 'The user cannot be deleted. There must always be at least one administrator',
        'USR_DEL_KO' : 'Failed to delete user',

        // EDIT
        'USR_EDT_OK' : 'User edited successfully',
        'OM_UNQ_EDT' : 'The role cannot be modified. The user is solely responsible for the organization',
        'ADM_UNQ_EDT' : 'The role cannot be modified. The user is the only administrator of the application',
        'USR_EDT_KO' : 'Error editing user',

        // EDIT_PROFILE
        'PRF_USR_KO' : 'You cannot edit another user\'s profile',
        'PRF_OK' : 'Profile data has been stored successfully',
        'PRF_KO' : 'Error modifying profile data',

        // Búsqueda por Username
        'USRNM_EXST' : 'The username already exist',
        'USRNM_NOT_EXST' : 'The username entered does not exist',
        'USRNM_KO' : 'Query by username failed',

        // Búsqueda por DNI
        'DNI_EXST' : 'The DNI already exist',
        'DNI_NOT_EXST' : 'The DNI entered does not exist',
        'DNI_KO' : 'Query by DNI failed',

        // Búsqueda por Email
        'EML_EXST' : 'The email already exist',
        'EML_NOT_EXST' : 'The email entered does not exist',
        'EML_KO' : 'Query by email failed',

        // Búsqueda por Teléfono
        'TLF_EXST' : 'The phone number already exist',
        'TLF_NOT_EXST' : 'The phone number entered does not exist',
        'TLF_KO' : 'Query by phone number failed',

        // Mas de un usuario por rol
        'ROL_MTO' : 'There is more than one user with the indicated role',
        'ROL_LTO' : 'There is less than one user with the indicated role',
        'ROL_KO' : 'Query by rol failed',

    // EDIFICIOS

        // SEARCH
        'BLD_SRCH_OK' : 'Building Search Ok',
        'BLD_SRCH_KO' : 'Building Search KO',

        // Obtener candidatos a responsable de edificio
        'BLD_RESP_EMPT' : 'There are no candidates available to be building manager',
        'GT_MANG_KO' : 'Failed to obtain building manager candidates',

        // Validaciones

            // Nombre de Usuario
            'USRNM_SHRT' : 'Username must exceed 3 characters',
            'USRNM_LRG' : 'Username cannot exceed 20 characters',
            'USRNM_ALF' : 'Username can only contain alphanumeric characters',

            // Password
            'PSW_SHRT' : 'Password security is compromised. Short encrypted password',
            'PSW_LRG' : 'Password security is compromised. Long encrypted password',
            'PSW_FRMT' : 'Password security is compromised. Password encrypted with characters not allowed',

            // DNI
            'DNI_EMPT' : 'The DNI cannot be empty',
            'DNI_FRMT' : 'Wrong DNI format',

            // ROL
            'ROL_EMPT' : 'The Rol cannot be empty',
            'ROL_FRMT' : 'The indicated role is not contemplated',

            // Nombre
            'NAM_SHRT' : 'Name must exceed 3 characters',
            'NAM_LRG' : 'Name cannot exceed 30 characters',
            'NAM_LT_SPC' : 'Name can only contain alphanumeric characters and spaces',

            // Apellidos
            'SRNM_SHRT' : 'Surname must exceed 3 characters',
            'SRNM_LRG' : 'Surname cannot exceed 60 characters,',
            'SRNM_LT_SPC' : 'Surname can only contain alphanumeric characters and spaces',

            // Email
            'EML_EMPT' : 'Email cannot be empty',
            'EML_FRMT' : 'Wrong Email format',

            // Telefono
            'TLF_EMPT' : 'Phone number cannot be empty',
            'TLF_FRMT' : 'Wrong phone number format',

            // Foto_Perfil
            'PRPH_KO' : 'Error while uploading the profile picture',
            'PRPH_EXT' : 'Image extension is not allowed',
            'PRPH_LRG' : 'Image size is larger than allowed (100kb)',
            'PRPH_FRMT' : 'The name of the profile picture can only contain letters, numbers and hyphens',



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
        'i18n-buildings' : 'Buildings',

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
        'i18n-user-details' : 'User Details',

        // BUILDINGS VIEWS
        'i18n-responsable' : 'Manager',
        'i18n-ciudad' : 'City',
        'i18n-buildings-empty' : 'There is no registered building yet',
        'i18n-add-building' : 'Add Building',
        'i18n-ciudad' : 'City',
        'i18n-calle' : 'Street',
        'i18n-provincia' : 'Province',
        'i18n-codigo_postal' : 'Postal Code',
        'i18n-fax' : 'Fax',


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
            'm-calle' : ' Street ',
            'm-ciudad' : ' City ',
            'm-provincia' : ' Province ',
            'm-codigo_postal' : ' Postal Code ',
            'm-fax' : ' Fax ',
            'm-responsable' : ' Manager ',
            'm-foto_edificio' : ' Building Photo ',

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