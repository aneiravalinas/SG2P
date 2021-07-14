arrayEN = {
    // Database General
    '00001' : 'Successful SQL execution',
    '00002' : 'Recordset is empty',
    '00003' : 'Recordset contains data',
    '00101' : 'Error while connecting with database. Contact your administrator',
    '00102' : 'SQL execution error',

    // CALENDAR
        // Insertion errors
        '01001' : 'Successful calendar insertion',
        '01101' : 'Calendar insertion error',
        '01102' : 'Calendar insertion error. Calendar exists',

        // Edition errors
        '01011' : 'Successful calendar edition',
        '01111' : 'Calendar edition error',

        // Deletion errors
        '01021' : 'Successful calendar deletion',
        '01121' : 'Calendar deletion error',

        // Search errors
        '01031' : 'Successful calendar search',
        '01131' : 'Calendar search error',

        // Obtaining errors
        '01041' : 'Successful obtaining calendar. Is empty',
        '01042' : 'Successful obtaining calendar. Contains data',    
        '01141' : 'Calendar obtaining error',

        // Format errors
            // Id
            '01051' : 'Calendar id validation successful',
            '01151' : 'Calendar id cannot be empty',
            '01152' : 'Calendar id must be a number',
            '01153' : 'Calendar id must be greater than or equal to 0',
            '01154' : 'Calendar id must be less than 100',

            // Name
            '01052' : 'Calendar name validation successful',
            '01155' : 'Calendar name cannot be empty',
            '01156' : 'Calendar name must consist only of alphabetic characters and spaces',
            '01157' : 'Calendar name size must be less than or equal to 40',

            // Description
            '01053' : 'Calendar description validation successful',
            '01158' : 'Calendar description cannot be empty',
            '01159' : 'Calendar description must consist only of alphabetic characters and spaces',
            '01160' : 'Calendar description size must be less than or equal to 100',

            // Dates
            '01054' : 'Calendar date validation successful',
            '01161' : 'Calendar date cannot be empty',
            '01162' : 'Calendar date must follow the date format',

            // Times
            '01055' : 'Calendar time validation successful',
            '01163' : 'Calendar time cannot be empty',
            '01164' : 'Calendar time must follow the time format',

    // USER
        // Insertion errors
        '02001' : 'Successful user insertion',
        '02101' : 'User insertion error',
        '02102' : 'User insertion error. User login exists',
        '02103' : 'User insertion error. User email exists',

        // Edition errors
        '02011' : 'Successful user edition',
        '02111' : 'User edition error',

        // Deletion errors
        '02021' : 'Successful user deletion',
        '02121' : 'User deletion error',
        '02122' : 'User deletion error. Is in charge of resource',

        // Search errors
        '02031' : 'Successful user search',
        '02131' : 'User search error',

        // Login obtaining errors
        '02041' : 'Successful obtaining user by login. Is empty',
        '02042' : 'Successful obtaining user by login. Contains data',    
        '02141' : 'User obtaining error',

        // Email obtaining errors
        '02051' : 'Successful obtaining user by email. Is empty',
        '02052' : 'Successful obtaining user by email. Contains data',    
        '02151' : 'User obtaining error',

        // Register errors
        '02061' : 'Successful user register',
        '02161' : 'User register error. User email is alredy registered',
        '02162' : 'User register error. User name is alredy registeres',

        // Login errors
        '02071' : 'Successful user login',
        '02171' : 'User login error. User does not exist',
        '02172' : 'User login error. Password is invalid',
        '02173' : 'User login error. User is inactive. Contact Adminitrator',

        // Format errors
            // Login
            '02081' : 'User login validation successful',
            '02181' : 'User login cannot be empty',
            '02182' : 'User login must be formed by alphanumeric characters or slashes only',
            '02183' : 'User login length must be less than or equal to 15',
            '02184' : 'User login lentth must be greater than or equal to 3',

            // Name
            '02082' : 'User name validation successful',
            '02185' : 'User name cannot be empty',
            '02186' : 'User name must be formed by alphanumeric characters, standard slashes or spaces only',
            '02187' : 'User name length must be less than or equal to 60',

            // Email
            '02083' : 'User email validation successful',
            '02188' : 'User email cannot be empty',
            '02189' : 'User email length must be less than or equal to 40',
            '02190' : 'User email must follow the email format',

            // Is_admin
            '02084' : 'Is_admin validation successful',
            '02191' : 'Is_admin fiel cannot be empty',
            '02192' : 'Is_admin can only be [YES/NO]',

            // Is_activo
            '02085' : 'Is_active validation successful',
            '02193' : 'Is_active fiel cannot be empty',
            '02194' : 'Is_active can only be [YES/NO]',

    // PERSON IN CHARGE OF RESOURCE
        // Insertion errors
        '03001' : 'Successful person in charge insertion',
        '03101' : 'Person in charge insertion error',
        '03102' : 'Person in charge insertion error. Person in charge alredy exists',
        '03103' : 'Person in charge insertion error. User does not exist',

        // Edition errors
        '03011' : 'Successful person in charge edition',
        '03111' : 'Person in charge edition error',

        // Deletion errors
        '03021' : 'Successgul person in charge deletion',
        '03121' : 'Person in charge deletion error',
        '03122' : 'Person in charge deletion error. Has assigned resources',

        // Search errors
        '03031' : 'Successful person in charge search',
        '03131' : 'Person in charge search error',

        // Obtainig errors
        '03041' : 'Obtainig person in charge successful. Is empty',
        '03042' : 'Obtainig person in charge successful. Contains data',    
        '03141' : 'Person in charge obtaining error',

        // Format errors
            // Address
            '03051' : 'Person in charge address validation successful',
            '03151' : 'Person in charge address cannot be empty',
            '03152' : 'Person in charge address must be formed by alfanumeric characters, /, &, ª, º or spaces only',
            '03153' : 'Person in charge address must be less than or equal to 60',

            // Phone
            '03052' : 'Person in charge phone validation successful',
            '03154' : 'Person in charge phone cannot be empty',
            '03155' : 'Person in charge phone must follow phone format',

    // RECURSO
        // Insertion errors
        '04001' : 'Successful resource insertion',
        '04101' : 'Resource insertion error',
        '04102' : 'Error inserting resource. Resource alredy exists',
        '04103' : 'Error inserting resource. Person in chare of resource does not exist',

        // Edition errors
        '04011' : 'Successful resource edition',
        '04111' : 'Resource edition error',

        // Deletion errors
        '04021' : 'Successful resource deletion',
        '04121' : 'Resource deletion error',

        // Search errors
        '04031' : 'Successful resource search',
        '04131' : 'Resource search error',

        // Obtaining errors
        '04041' : 'Successful obtaining resource. Is empty',
        '04042' : 'Successful obtaining resource. Contains data',    
        '04141' : 'Resource obtaining error',

        // Format errors
            // Id
            '04051' : 'Resource id validation successful',
            '04151' : 'Resource id cannot be empty',
            '04152' : 'Resource id must be a number',
            '04153' : 'Resource id must be greater than or equal to 999',
            '04154' : 'Resource id must be less than or equal to 999',

            // Name
            '04052' : 'Resource name validation successful',
            '04155' : 'Resource name cannot be empty',
            '04156' : 'Resource name must be formed by alfabetic characters or spaces only',
            '04157' : 'Resource name length must be less than or equal to 40',

            // Description
            '04053' : 'Resource description validation successful',
            '04158' : 'Resource description cannot be empty',
            '04159' : 'Resource description must be formed by alfabetic characters or spaces only',
            '04160' : 'Resource description length must be less than or equal to 100',

            // Person in charge login
            '04054' : 'Resource person in charge login validation successful',
            '04161' : 'Resource person in charge login cannot be empty',
            '04162' : 'Resource person in charge login must be formed by alfanumeric characters or slashes only',
            '04163' : 'Resource person in charge login length must be less than or equal to 15',
            '04164' : 'Resource person in charge login length must be greater than or equal to 3',

            // Rate
            '04055' : 'Resource rate validation successful',
            '04165' : 'Resource rate cannot be empty',
            '04166' : 'Resource rate must be a number',
            '04167' : 'Resource rate must be greater than or equal to 0',
            '04168' : 'Resource rate must be less than or equal to 999',

            // Rate range
            '04056' : 'Resource rate range validation successful',
            '04169' : 'Resource rate range cannot be empty',
            '04170' : 'Resource rate range must be HOUR / DAY / WEEK / MONTH',

            // Logical deletion
            '04057' : 'Resource logical deletion validation successful',
            '04171' : 'Resource logical deletion field cannot be empty',
            '04172' : 'Resource logical deletion field musy be YES / NO',

    // SCHEDULE
        // Insertion errors
        '05001' : 'Successful schedule insertion',
        '05101' : 'Schedule insertion error ',
        '05102' : 'Schedule insertion error. Schedule alredy exists',
        '05103' : 'Schedule insertion error. Calendar does not exist',
        '05104' : 'Schedule insertion error. Reserve out of specified calendar range',
        '05105' : 'Schedule insertion error. Resource does not exist',
        '05106' : 'Schedule insertion error. Reserves alredy exist within specified schedule',
        '05107' : 'Schedule insertion error. Requesting user does not exist',

        // Edition errors
        '05011' : 'Successful schedule edition',
        '05111' : 'Schedule edition error',

        // Deletion errors
        '05021' : 'Successful schedule deletion',
        '05121' : 'Schedule deletion error',

        // Search errors
        '05031' : 'Successful schedule search',
        '05131' : 'Schedule search error',

        // Obtaining errors
        '05041' : 'Successful obtaining schedule. Is empty',
        '05042' : 'Successful obtaining schedule. Contains data',    
        '05141' : 'Schedule obtaining error',

        // Format errors
            // Schedule id
            '05051' : 'Schedule id validation successful',
            '05151' : 'Schedule id cannot be empty',
            '05152' : 'Schedule id must be a number',
            '05153' : 'Schedule id must be greater than or equal to 0',
            '05154' : 'Schedule id must be less than or equal to 99999',

            // Calendar id
            '05052' : 'Calendar id validation successful',
            '05155' : 'Calendar id cannot be empty',
            '05156' : 'Calendar id must be a number',
            '05157' : 'Calendar id must be greater than or equal to 0',
            '05158' : 'Calendar id must be less than or equal to 100',

            // Resource id
            '05053' : 'Resource id validation successful',
            '05159' : 'Resource id cannot be empty',
            '05160' : 'Resource id must be a number',
            '05161' : 'Resource id must be greater than or equal to 0',
            '05162' : 'Resource id must be less than or equal to 999',

            // Schedule date
            '05054' : 'Schedule date validation successful',
            '05163' : 'Schedule date cannot be empty',
            '05164' : 'Schedule date must follow the date format',

            // Schedule start time
            '05055' : 'Schedule start time validation successful',
            '05165' : 'Schedule start time cannot be empty',
            '05166' : 'Schedule start time must follow the time format',

            // Schedule end time
            '05056' : 'Schedule end time validation successful',
            '05167' : 'Schedule end time cannot be empty',
            '05168' : 'Schedule end time must follow the time format',

            // Schedule motivation
            '05057' : 'Schedule motivation validation successful',
            '05169' : 'Schedule motivation cannot be empty',
            '05170' : 'Schedule motivation must be formed by alfabetic characters or spaces only',
            '05171' : 'Schedule motivation length must be less than or equal to 100',
            
            // Resource request date
            '05058' : 'Schedule resource request date validation successful',
            '05172' : 'Schedule resource request date cannot be empty',
            '05173' : 'Schedule resource request date must follow the date format',

            // User login
            '05059' : 'Schedule user login validation successful',
            '05174' : 'Schedule user login cannot be empty',
            '05175' : 'Schedule user login length must be less than or equal to 15',
            '05176' : 'Schedule user login length must be greater than or equal to 3',

            // Is request
            '05060' : 'Schedule is request field validation successful',
            '05177' : 'Schedule is request field cannot be empty',
            '05178' : 'Schedule is request field musy be YES / NO',

            // Is rejected
            '05061' : 'Schedule is rejected field validation successful',
            '05179' : 'Schedule is rejected cannot be empty',
            '05180' : 'Schedule is rejected field musy be YES / NO',

            // Request response date
            '05062' : 'Schedule request response date validation successful',
            '05181' : 'Schedule request response date cannot be empty',
            '05182' : 'Schedule request response date must follow the date format',

            // Schedule rejection motivation
            '05063' : 'Schedule rejection motivation validation successful',
            '05183' : 'Schedule rejection motivation cannot be empty',
            '05184' : 'Schedule rejection motivation must be formed by alfabetic characters or spaces only',
            '05185' : 'Schedule rejection motivation length must be less than or equal to 100',

            // Was used
            '05064' : 'Schedule was used field validation successful',
            '05186' : 'Schedule was used field cannot be empty',
            '05187' : 'Schedule was used field musy be YES / NO',

            // Request cost
            '05065' : 'Schedule request cost validation successful',
            '05188' : 'Schedule request cost cannot be empty',
            '05189' : 'Schedule request cost must be a decimal',
            '05190' : 'Schedule request cost must be greater than or equal to 0',
            '05191' : 'Schedule request cost must be less than or equal to 99999.99',

            // Start date
            '05066' : 'Schedule start date validation successful',
            '05192' : 'Schedule start date cannot be empty',
            '05193' : 'Schedule start date must follow the date format',

            // End date
            '05067' : 'Schedule end date validation successful',
            '05194' : 'Schedule end date cannot be empty',
            '05195' : 'Schedule end date must follow the date format',

    // INTERFACE
        // General
        'SI' : 'Yes',
        'NO' : 'No',
        'hora' : 'Hour',
        'dia' : 'Day',
        'semana' : 'Week',
        'mes' : 'Month',
        'lunes' : 'Monday',
        'martes' : 'Tuesday',
        'miercoles' : 'Wednesday',
        'jueves' : 'Thursday',
        'viernes' : 'Friday',
        'sabado' : 'Saturday',
        'domingo' : 'Sunday',

        // Modal
        'no-vacio' : ' cannot be empty.',
        'min-size' : ' is below minimum size.',
        'max-size' : ' is over maximum size.',
        'solo-numeros' : ' can only contain numeric characters',
        'solo-letras' : ' can only contain letters.',
        'solo-letras-numeros' : ' can only contain letters and numbers.',
        'solo-letras-espacios' : ' can only contain letters and spaces.',
        'solo-letras-guines' : ' can only contain letters and slashes.',
        'solo-letras-espacios-guiones' : ' can only contain letters, spaces and slashes.',
        'solo-letras-espacios-especiales' : ' can only contain letters, spaces and special characters.',
        'formato-email' : ' doesn\'t have a correct email format.',
        'formato-telefono' : ' doesn\'t have a correct phone format.',
        'formato-hora' : ' doesn\'t have a correct time format.',
        'fecha-posterior' : ' must be latter.',
        'hora-posterior' : ' must be latter.',

        // Navbar
        'navbar-btn-inicio' : 'Home',
        'navbar-btn-recursos' : 'Resources',
        'navbar-btn-calendarios' : 'Calendars',
        'navbar-btn-solicitudes' : 'Requests',
        'navbar-btn-usuarios' : 'Users',

        // Message
        'system-error-msg' : 'System Notice',

        // Login
        'login-header' : 'Log In', 
        'login_usuario' : 'User login',
        'pass_usuario' : 'Password',
        'register-link' : 'Don\'t have an account? Register here',

        // Register
        'register-header' : 'Register',
        'login_usuario' : 'User login',
        'pass_usuario' : 'Password',
        'nombre_usuario' : 'User name',
        'email_usuario' : 'Email', 
        'login-link' : 'Alredy have an account? Log in here',

        // Dashboard
        'admin-login-disclaimer' : 'You have logged in as Administrator',
        'admin-login-msg' : 'You can access all needed functionality as Administrator from navigation.',
        'responsable-login-disclaimer' : 'You have logged in as Personnel in charge of Resource',
        'responsable-login-msg' : 'You can access all needed functionality as Personnel in charge of Resource from navigation.',
        'user-login-disclaimer' : 'You have logged in as User',
        'user-login-msg' : 'You can access all needed User functionality from navigation.',
        'discharge-msg' : 'Further implementation could consist in a rapid disclaimer of the resources. Not required by assignment specification.',

        // Resources
        'nombre_recurso' : 'Resource name',
        'resources-disclaimer' : 'Available resources',
        'resources-search-disclaimer' : 'Search result',
        'resources-header-name' : 'Resource name',
        'resources-header-incharge' : 'Person in charge',
        'resources-header-occupation' : 'Occupation',
        'resources-header-tarifation' : 'Rate',
        'resource-deletion-msg' : 'Are you sure you want to permanently delete de resource ',
        'resource' : 'Resource: ',
        'resource-new' : 'New resource',
        'resource-search' : 'Advanced search',
        'search-warning' : '*If you choose rate, only resources of lower or equal coste in specified rate range will be shown.',
        'descripcion_recurso' : 'Description',
        'login_responsable' : 'Person in charge',
        'tarifa_recurso' : 'Rate',
        'max_tarifa_recurso' : 'Max rate',

        // Calendars
        'nombre_calendario' : 'Calendar name',
        'calendars-disclaimer' : 'Available calendars',
        'calendars-search-disclaimer' : 'Search result',
        'calendars-header-name' : 'Calendar name',
        'calendars-header-description' : 'Calendar description',
        'calendars-header-start-date' : 'Start date',
        'calendars-header-end-date' : 'End date',
        'calendars-header-start-time' : 'Start time',
        'calendars-header-end-time' : 'End time',
        'calendar-deletion-msg' : 'Are you sure you permanently want to delete de calendar ',
        'includes-date' : 'incluye fecha',
        'calendar' : 'Calendario: ',
        'calendar-new' : 'Nuevo calendario',
        'descripcion_calendario' : 'Descripción',
        'fecha_inicio_calendario' : 'Fecha inicio',
        'fecha_fin_calendario' : 'Fecha fin',
        'hora_inicio_calendario' : 'Hora inicio',
        'hora_fin_calendario' : 'Hora fin',

        // Users
        'nombre_usuario' : 'User name',
        'users-disclaimer' : 'Registered users',
        'users-search-disclaimer' : 'Search result',
        'users-header-login' : 'User login',
        'users-header-name' : 'User name',
        'users-header-email' : 'Email',
        'users-header-address' : 'Address',
        'users-header-phone' : 'Phone',
        'users-header-admin' : 'Admin',
        'users-header-active' : 'Active',
        'user-deletion-msg' : 'Are you sure you permanently want to delete the user ',
        'responsable-downgrade-msg' : 'Are you sure you want to downgrade the user ',
        'user' : 'User: ',
        'user-new' : 'New user',
        'login_usuario' : 'User login',
        'email_usuario' : 'Email',
        'es_admin' : 'is admin',
        'es_activo' : 'is active',
        'direccion_responsable' : 'Address',
        'telefono_responsable' : 'Phone',

        // Schedules
        'own-schedule-disclaimer' : 'My requests',
        'assigned-schedule-disclaimer' : 'Requests asigned to me',
        'all-schedule-disclaimer' : 'All requests',
        'watch-all' : 'See all',
        'watch-asigned' : 'See asigned',
        'schedule-header-resource' : 'Resource',
        'schedule-header-date' : 'Date',
        'schedule-header-start-time' : 'Start time',
        'schedule-header-end-time' : 'End time',
        'schedule-header-request-motivation' : 'Motivation',
        'schedule-header-cost' : 'Cost',
        'schedule-header-rejected' : 'Status',
        'schedule-header-used' : 'Used',
        'schedule-header-rejection-motivation' : 'Reason for rejection',
        'schedule' : 'Solicitud: ',
        'schedule-aproving-msg' : 'Are you sure you want to accept de request of ',
        'schedule-rejection-msg' : 'Are you sure you want to reject de request of ',
        'schedule-using-msg' : 'Are you sure you want to set as used ',
        'rejected' : 'Rejected',
        'accepted' : 'Accepted',
        'description' : 'Description: ',
        'tarifa' : 'Rate: ',
        'no-calendar-error-msg' : 'Error. No calendar created. Contact Administrator.',
        'issue-book' : 'Book',
        'schedule-new' : 'New request',
        'select-calendario' : 'Calendar',
        'fecha_horario' : 'Request date',
        'hora_inicio_horario' : 'Requested start time',
        'hora_fin_horario' : 'Requested end time',
        'motivo_horario' : 'Motivation',
        'cost-amount-disclaimer' : 'Cost',
        'usage-report' : 'Usage report',
        'report-date-range' : 'Date range:',
        'report-date-separator' : 'to',
        'report-num-solicitudes' : 'Request number',
        'report-num-reservas' : 'Reservation number',
        'report-num-reservas-usadas' : 'Used reservation number',
        'report-aproval-percentage' : 'Accepted requests percentage',
        'report-usage-percentage' : 'Used bookings percentage',
        'report-usage-time' : 'Occupied time',
        'report-unusage-time' : 'Unoccupied time',
        'no-calendar' : 'A calendar must be created',
        'horas' : 'hours'
}