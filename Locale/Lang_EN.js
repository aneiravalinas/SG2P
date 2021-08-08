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
        'BM_ADD' : 'Cannot assign building manager role if user does not have buildings assigned',
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
        'BM_WITH_BLD' : 'The building manager role cannot be disassociated if the user has buildings assigned',

        // EDIT_PROFILE
        'PRF_USR_KO' : 'You cannot edit another user\'s profile',
        'PRF_OK' : 'Profile data has been stored successfully',
        'PRF_KO' : 'Error modifying profile data',

        // SEEK
        'USR_SEEK_OK' : 'Search for user details was successful',
        'USR_SEEK_KO' : 'Failed to query user details',

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

        // ADD
        'BLD_ADD_KO' : 'Failed to add building',
        'BLD_ADD_OK' : 'The building has been added successfully',
        'BLD_ADD_OK_ROL_KO' : 'Error when modifying the registered user role to building manager. Action must be done manually',

        // DELETE
        'BLD_DEL_OK' : 'The building has been successfully removed',
        'BLD_DEL_OK_ROL_KO' : 'Error when modifying the role of the building manager to a registered user. Action must be done manually',
        'BLD_DEL_KO' : 'Failed to delete building',

        // EDIT
        'BLD_EDIT_OK_ROL_KO' : 'The building has been modified successfully, but there was an error in the assignment of roles. Please review the roles manually.',
        'BLD_EDIT_KO' : 'An error occurred while modifying the building',
        'BLD_EDIT_OK' : 'The building has been successfully modified',

        // SHOWCURRENT
        'BLD_CURRNT_MANG_KO' : 'You do not have the necessary permits to consult the details of that building',
        'BLD_CURRENT_OK' : 'The query of the building details has been executed correctly',
        'BLD_CURRNT_KO' : 'Failed to query building details',

        // Búsqueda de ciudades
        'CTY_NOT_FOUND' : 'There are currently no buildings registered in the system. Register a building to access its portal',
        'SRCH_CTY_KO' : 'An error occurred while obtaining the cities registered in the system. Contact your administrator',
        'SRCH_CTY_OK' : 'City search Ok',

        // Búsqueda por ciudad
        'CTY_NOT_EXST' : 'The entered city does not exist',
        'SRCH_BY_CTS_OK' : 'Search by city Ok',
        'SRCH_BY_CTS_KO' : 'Error searching by city',

        // Obtener candidatos a responsable de edificio
        'MANG_EMPT' : 'There are no candidates available to be building manager',
        'GT_MANG_KO' : 'Failed to obtain building manager candidates',
        'MANG_INV' : 'The specified user is not valid to be a building manager',

        // Fotos Edificio
        'BLD_PH_KO' : 'Failed to upload building photo',

        // Búsqueda por Edificio_ID
        'BLDID_NOT_EXST' : 'Building ID does not exist',
        'BLDID_KO' : 'Failed to query by Building ID',
        'BLDID_EXST' : 'Building ID exists',

        // Búsqueda por Responsable
        'MANG_NOT_EXST' : 'The building manager does not exist',
        'MANG_EXST' : 'The building manager exist',
        'MANG_KO' : 'Error when consulting the building manager',

        // Búsqueda de Plantas del Edificio
        'BLD_FLR_EXST' : 'The building cannot be deleted as long as it has associated floors',
        'BLD_SRCH_FLR_KO' : 'Error when consulting the building floors',

        // Búsqueda de Planes asignados al Edificio
        'BLD_PLN_EXST' : 'Building cannot be deleted while it has assigned plans',
        'BLD_SRCH_PLN_KO': 'Error when consulting the plans associated with the building',

    // PLANTAS

        // SEARCH
        'FLR_SRCH_NT_ALLOWED' : 'You do not have the necessary permits to search for plants in this building',
        'FLR_SRCH_OK' : 'Plant search Ok',
        'FLR_SRCH_KO' : 'Failed to query plants',

        // ADD
        'FLR_ADD_OK' : 'The floor has been added successfully',
        'FLR_ADD_KO' : 'Failed to add floor',

        // DELETE
        'FLR_DEL_OK' : 'The floor has been successfully removed',
        'FLR_DEL_KO' : 'Failed to delete the floor',

        // SEEK
        'FLR_SEEK_NOT_ALLOWED' : 'You do not have the necessary permits to consult the details of this floor',
        'FLR_SEEK_OK' : 'The consultation of the details of the floor has been carried out correctly',
        'FLR_SEEK_KO' : 'Failed to query floor details',

        // EDIT
        'FLR_EDT_OK' : 'Floor data has been successfully modified',
        'FLR_EDT_KO' : 'Error when modifying floor data',

        // Detalles de la planta del Portal
        'PRTL_FLR_SEEK_OK' : 'The consultation of the details of the portal plant has been carried out correctly',
        'PRTL_FLR_SEEK_KO' : 'Failed to query the details of the portal plant',

        // Búsqueda de Plantas del Portal
        'PRTL_FLR_SRCH_OK' : 'The portal floor search was successful',
        'PRTL_FLR_SRCH_KO' : 'Failed to find portal plants',

        // Existe numero de planta en un edificio
        'FLR_NUM_EXST' : 'There is already a floor with the floor number indicating in this building',
        'NUM_PLNT_EXST_KO' : 'Error when consulting by floor number',

        // Subir foto planta
        'FLR_PH_KO' : 'Error uploading the floor photo',

        // Consulta por Planta
        'FLRID_NOT_EXST' : 'The floor does not exist',
        'FLRID_EXST' : 'The floor exist',
        'FLRID_KO' : 'Error when consulting by Floor ID',

        // Consulta de Espacios asociados a Planta
        'FLR_SPC_EXST' : 'The floor cannot be deleted as long as it has associated Spaces',
        'FLR_SPC_KO' : 'Error when consulting the spaces associated with the floor',

        // Consutla de Implementaciones de Rutas en Plantas
        'FLR_RT_EXST' : 'Cannot delete floor while it has Route implementations',
        'FLR_RT_KO' : 'Failed to query floor route implementations',

    // ESPACIOS

        // SEARCH
        'SPC_SRCH_NOT_ALLOWED' : 'You do not have permits to search for spaces in this building',
        'SPC_SRCH_OK' : 'The search for spaces was successful',
        'SPC_SRCH_KO' : 'Error while searching for spaces',

        // ADD
        'SPC_ADD_OK' : 'The space has been added successfully',
        'SPC_ADD_KO' : 'Error adding space',

        // DELETE
        'SPC_DEL_OK' : 'The space has been successfully removed',
        'SPC_DEL_KO' : 'Failed to remove space',

        // SEEK
        'SPC_SEEK_KO' : 'Failed to check space details',
        'SPC_SEEK_OK' : 'The consultation of the details of the space has been carried out correctly',
        'SPC_SEEK_NOT_ALLOWED' : 'You do not have the necessary permissions to consult the details of this space',

        // EDIT
        'SPC_EDT_OK' : 'The space has been edited successfully',
        'SPC_EDT_KO' : 'Error editing space',

        // Detalles del espacio del portal
        'PRTL_SPC_SEEK_OK' : 'The consultation of the details of the portal space has been carried out correctly',
        'PRTL_SPC_SEEK_KO' : 'Failed to check the details of the portal space',

        // Búsqueda por ID de Espacio
        'SPCID_NOT_EXST' : 'The indicated space does not exist',
        'SPCID_EXST' : 'The indicated spaces exist',
        'SPCID_KO' : 'Failed to query by Space ID',

        // Búsqueda por nombre de espacio
        'SPC_NAM_EXST' : 'There is already a space with the name indicated on this floor',
        'SPC_NAM_KO' : 'Failed to query by space name',

        // Subir foto espacio
        'SPC_PH_KO' : 'Error uploading space photo',

        // ID DefPlan
        'DFPLAN_ID_EMPT' : 'Plan ID cannot be empty',
        'DFPLAN_ID_NOT_NUMERIC' : 'Plan ID must be numeric',

        // Nombre DefPlan
        'DFPLAN_NAM_SHRT' : 'The plan name must be longer than 3 characters',
        'DEFPLAN_NAM_LRG' : 'Plan name must not exceed 60 characters',
        'DEFPLAN_NAM_FRMT' : 'Plan name contains illegal characters',

    // DEF_PLAN

        // SEARCH
        'DFPLAN_SEARCH_OK' : 'Search for plan definitions was successful',
        'DFPLAN_SEARCH_KO' : 'Failed to search plan definitions',

        // ADD
        'DFPLAN_ADD_OK' : 'The plan definition has been added successfully',
        'DFPLAN_ADD_KO' : 'Failed to add plan definition',

        // Búsqueda por nombre de plan
        'DFPLAN_NAM_NOT_EXST': 'Plan name does not exist',
        'DFPLAN_NAM_EXST' : 'Plan name exists',
        'DFPLAN_NAM_KO' : 'Failed to query by plan name',

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
            'TLF_MAX_SIZE' : 'The phone number exceeds the maximum size',
            'TLF_WITH_LETTERS' : 'The phone number can only contain numbers',

            // Foto_Perfil
            'PRPH_KO' : 'Error while uploading the profile picture',
            'PRPH_EXT' : 'Image extension is not allowed',
            'PRPH_LRG' : 'Image size is larger than allowed (100kb)',
            'PRPH_FRMT' : 'The name of the profile picture can only contain letters, numbers and hyphens',

            // Edificio_ID
            'BLD_ID_EMPT' : 'Building ID cannot be empty',
            'BLD_ID_NOT_NUMERIC' : 'Building ID must be numeric',

            // Responsable (Usuario)
            'MANG_SHRT' : 'The name of the building manager must exceed 3 characters',
            'MANG_LRG' : 'The name of the building manager cannot exceed 20 characters',
            'MANG_ALF' : 'The name of the building manager can only contain alphanumeric characters',

            // Building Name
            'BLD_NAM_SHRT' : 'The name of the building must exceed 3 characters',
            'BLD_NAM_LRG' : 'The name of the building must not exceed 60 characters',
            'BLD_NAM_FRMT' : 'The building name can only contain alphanumeric characters, spaces, numbers and accents',

            // Calle
            'CALLE_SHRT' : 'The street must exceed 8 characters',
            'CALLE_LRG' : 'The street must not exceed 60 characters',
            'CALLE_FRMT' : 'The street can only contain alphanumeric characters, spaces and numbers',

            // Ciudad
            'CIUDAD_SHRT' : 'The city must exceed 3 characters',
            'CIUDAD_LRG' : 'The city must not exceed 40 characters',
            'CIUDAD_FRMT' : 'The city can only contain letters and spaces',

            // Provincia
            'PROV_SHRT' : 'The province must exceed 3 characters',
            'PROV_LRG' : 'The province must not exceed 40 characters',
            'PROV_FRMT' : 'The province can only contain letters and spaces',

            // Código Postal
            'CP_EMPT' : 'You need to specify a zip code',
            'CP_NUMERIC' : 'Zip code must be numeric',
            'CP_SIZE' : 'Zip code must be a 5-digit number',
            'CP_MAX_SIZE' : 'Zip code must not exceed 5 digits',

            // Foto Edificio
            'BLD_PH_EXT' : 'The extension of the building photo is not allowed',
            'BLD_PH_FRMT' : 'The building photo name can only contain letters, numbers and hyphens',

            // Nombre Planta
            'FLR_NAM_SHRT' : 'The name of the floor must exceed 3 characters',
            'FLR_NAM_LRG' : 'The name of the floor must not exceed 40 characters',
            'FLR_NAM_FRMT' : 'The floor name can only contain alphanumeric characters, spaces, numbers and accents',

            // Número de Planta
            'NUM_FLOOR_EMPT' : 'The floor number cannot be empty',
            'NUM_FLOOR_LRG': 'The floor number must be a 1 or 2 digit number',
            'NUM_FLOOR_NOT_NUMERIC' : 'The floor number must be a number',

            // Descripción
            'DESC_EMPTY' : 'The description field cannot be empty',
            'DESC_FRMT' : 'Description field contains illegal characters',

            // Foto Planta
            'FLR_PH_EXT' : 'The extension of the floor photo is not allowed',
            'FLR_PH_FRMT' : 'The name of the floor photo can only contain letters, numbers and hyphens',

            // Planta ID
            'FLR_ID_EMPT' : 'Floor ID cannot be empty',
            'FLR_ID_NOT_NUMERIC' : 'Floor ID must be numeric',

            // Espacio ID
            'SPC_ID_EMPT' : 'Space ID cannot be empty',
            'SPC_ID_NOT_NUMERIC' : 'The space ID must be numeric',

            // Nombre del Espacio
            'SPC_NAM_SHRT' : 'The name of the space must exceed 3 characters',
            'SPC_NAM_LRG' : 'The name of the space must not exceed 40 characters',
            'SPC_NAM_FRMT' : 'The space name can only contain alphanumeric characters, spaces, numbers and accents',

            // Foto Espacio
            'SPC_PH_EXT' : 'The photo extension of the space is not allowed',
            'SPC_PH_FRMT' : 'The name of the space photo can only contain letters, numbers and hyphens',



    // INTERFACE
        // HEADER
        'i18n-idioma' : 'Language',
        'i18n-login' : 'Login',
        'i18n-admin' : 'Administration Panel',
        'i18n-logout' : 'Logout',

        // PORTAL_COUNTRIES
        'i18n-app-welcome' : '¡Welcome to SG2P!',
        'i18n-select-city' : 'Select a city to search for Buildings',
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
        'i18n-admin-plans' : 'Manage Plans',

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
        'i18n-del-user-confirm' : 'Are you sure you want to delete this user? The action will not be reversible',
        'i18n-edit-user' : 'Editar Usuario',
        'i18n-user-details' : 'User Details',

        // BUILDINGS VIEWS
        'i18n-edificio_id' : 'Building ID',
        'i18n-responsable' : 'Manager',
        'i18n-ciudad' : 'City',
        'i18n-buildings-empty' : 'There is no registered building yet',
        'i18n-add-building' : 'Add Building',
        'i18n-calle' : 'Street',
        'i18n-provincia' : 'Province',
        'i18n-codigo_postal' : 'Zip Code',
        'i18n-fax' : 'Fax',
        'i18n-del-building-confirm' : 'Are you sure you want to delete this building? The action will not be reversible',
        'i18n-edit-building' : 'Edit Building',
        'i18n-search-building' : 'Search Building',
        'i18n-view-floors' : 'Show Floors',
        'i18n-building-details' : 'Building Details',
        'i18n-search-floor' : 'Search Floors',
        'i18n-foto_edificio' : 'Building Photo',

        // FlOORS VIEWS
        'i18n-floors' : 'Floors',
        'i18n-planta_id' : 'Floor ID',
        'i18n-num_planta' : 'Floor number',
        'i18n-floors-empty' : 'This building does not have registered floors yet',
        'i18n-add-floor' : 'Add Building',
        'i18n-descripcion' : 'Description',
        'i18n-details-floor' : 'Floor Details',
        'i18n-del-floor-confirm' : 'Are you sure you want to remove this floor? The action will not be reversible',
        'i18n-edit-floor' : 'Edit Floor',
        'i18n-view-spaces' : 'Show Spaces',
        'i18n-foto_planta' : 'Floor Photo',

        // SPACES VIEWS
        'i18n-spaces' : 'Spaces',
        'i18n-espacio_id' : 'Space ID',
        'i18n-spaces-empty' : 'This floor does not have registered spaces yet',
        'i18n-add-space' : 'Add Space',
        'i18n-foto_espacio' : 'Space Photo',
        'i18n-del-space-confirm' : 'Are you sure you want to delete this space? The action will not be reversible',
        'i18n-details-space' : 'Space Details',
        'i18n-search-space' : 'Search Spaces',
        'i18n-edit-space' : 'Edit Space',

        // PORTAL VIEWS
        'i18n-resp-info' : 'Consult the information regarding the building manager',
        'i18n-contact' : 'Contact',
        'i18n-address' : 'Address',
        'i18n-details-manager' : 'Manager Details',
        'i18n-floors-info' : 'Check the information on the floors and spaces of the building',
        'i18n-select-building' : 'Select a Building',
        'i18n-select-floor' : 'Select a Floor',
        'i18n-portal-floors-empty' : 'This building does not have registered floors yet',
        'i18n-piso' : 'Floor number: ',
        'i18n-floor-spaces' : 'Floor Spaces',

        // DEF_PLANS VIEW
        'i18n-def-plans' : 'Definitions of Plans',
        'i18n-def-plans-empty' : 'No plan definitions on file',
        'i18n-plan_id' : 'ID Plan',

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
            'm-codigo_postal' : ' Zip Code ',
            'm-fax' : ' Fax ',
            'm-responsable' : ' Manager ',
            'm-foto_edificio' : ' Building Photo ',
            'm-edificio_id' : ' Building ID ',
            'm-num_planta' : ' Floor Number ',
            'm-foto_planta' : ' Floor Photo ',
            'm-descripcion' : ' Description ',
            'm-planta_id' : ' Floor ID ',
            'm-espacio_id' : ' Space ID ',

            // Mensajes Modal
            'i18n-max-size' : 'exceeds the maximum size',
            'i18n-only-letters-numbers' : 'can only contain letters and numbers',
            'i18n-not-empty' : 'cannot be empty',
            'i18n-generic-format' : 'has a wrong format',
            'i18n-letters-spaces-accents-format' : 'only supports letters, spaces and accents',
            'i18n-numbers-format' : 'can only contain numbers',
            'i18n-wrong-enum' : 'has a value not contemplated',
            'i18n-ext-not-allowed' : 'has a not allowed extension',
            'i18n-cp-format' : 'must be a 5 digit number',
            'i18n-letters-numbers-accents-spaces' : 'can only contain letters, numbers, accents, and spaces',
            'i18n-chars-not_allow' : 'contains illegal characters',
}