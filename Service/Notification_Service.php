<?php

include_once './Model/Notification_Model.php';
include_once './Validation/Notification_Validation.php';

class Notification_Service extends Notification_Validation {
    var $notification_entity;
    var $atributos;
    var $feedback = array();

    function __construct() {
        $this->notification_entity = new Notification_Model();
        $this->atributos = array('id_notificacion','username','edificio_id','plan_id','leido','fecha','fecha_inicio','fecha_fin','mensaje');
        $this->fill_fields();
    }

    function fill_fields() {
        foreach($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }
    }

    /*
     *  - Recupera las notificaciones de un usuario.
     *      1. Valida y busca un usuario por ID, comprobando que existe.
     *      2. Valida los atributos recibidos que se usarán como condiciones de filtrado.
     *      3. Recupera las notificaciones que coincidan con las condiciones de filtrado establecidas.
     */
    function search() {
        $this->feedback = $this->seekUsername();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $user = $this->feedback['resource'];
        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->notification_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'NTF_SEARCH_OK';
            $this->feedback['user'] = array('username' => $user['username']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'NTF_SEARCH_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera la información necesaria para construir el formulario de búsqueda.
     *      1. Valida y busca un usuario por ID, comprobando que existe.
     *      2. Recupera los distintos edificios que tengan registradas notificaciones dirigidas al usuario.
     *      3. Recupera los distintos planes que tengan registradas notificaciones dirigidas al usuario.
     */
    function searchForm() {
        $this->feedback = $this->seekUsername();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $user = $this->feedback['resource'];
        $this->feedback = $this->notification_entity->searchBuildingsByUsername();
        if(!$this->feedback['ok']) {
            $this->feedback['code'] = 'NTF_BLDS_KO';
            return $this->feedback;
        }

        $buildings = $this->feedback['resource'];
        $this->feedback = $this->notification_entity->searchPlansByUsername();
        if(!$this->feedback['ok']) {
            $this->feedback['code'] = 'NTF_PLANS_KO';
            return $this->feedback;
        }

        $this->feedback['code'] = 'NTF_SEARCH_FORM_OK';
        $this->feedback['buildings'] = $buildings;
        $this->feedback['user'] = array('username' => $user['username']);
        return $this->feedback;
    }

    /*
     *  - Recupera los datos de una notificación y la marca como leída.
     *      1. Valida y busca una notificación por ID, comprobando que existe.
     *      2. Si la notificación está marcada como 'no leída', modifica su estado a 'leída'.
     */
    function seek() {
        $this->feedback = $this->seekNotification();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $notification = $this->feedback['resource'];
        if($notification['leido'] == 'no') {
            $this->notification_entity->setAttributes($notification);
            $this->notification_entity->leido = 'yes';
            $this->feedback = $this->notification_entity->EDIT();
            if(!$this->feedback['ok']) {
                $this->feedback['code'] = 'NTF_EDT_READ_KO';
                return $this->feedback;
            }
            $this->feedback['resource'] = $notification;
        }

        $this->feedback['code'] = 'NTF_SEEK_OK';
        return $this->feedback;
    }

    /*
     *  - Elimina una notificación.
     *      1. Valida y busca una notificación por ID, comprobando que existe.
     *      2. Elimina la notificación.
     */
    function delete() {
        $this->feedback = $this->seekNotification();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->notification_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'NTF_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'NTF_DEL_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Comprueba si existen nuevas notificaciones en estado 'no leído' dirigidas al usuario en sesión.
     */
    function check_unread_notifications() {
        if(isAuthenticated()) {
            $this->notification_entity->username = $_SESSION['username'];
            $this->feedback = $this->notification_entity->searchUnReadByUsername();
            if($this->feedback['ok']) {
                if($this->feedback['code'] == 'QRY_EMPT') {
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = 'NTF_UR_EMPT';
                } else {
                    $this->feedback['code'] = 'NTF_UR_FILL';
                }
            } else if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'NTF_UR_KO';
            }
        } else {
            $this->feedback['ok'] = false;
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los datos de una notificación.
     *      1. Valida y busca una notificación por ID, comprobando que existe.
     *      2. Verifica que la notificación está dirigida al usuario registrado en sesión.
     */
    function seekNotification() {
        $validation = $this->validar_ID_NOTIFICACION();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekNotificationByID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $notification = $this->feedback['resource'];
        if($notification['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'NTF_USR_FRBD';
            unset($this->feedback['resource']);
        }

        return $this->feedback;
    }

    /*
     *  - Valida y busca los datos de un usuario, comprobando que existe.
     */
    function seekUsername() {
        $validation = $this->validar_USERNAME();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByUsername();
    }

    // Recupera un usuario por ID.
    function seekByUsername() {
        include_once './Model/User_Model.php';
        $user_entity = new User_Model();
        $feedback = $user_entity->seek();

        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'USRNM_NOT_EXST';
            } else {
                $feedback['code'] = 'USRNM_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'USRNM_KO';
        }

        return $feedback;
    }

    // Recupera una notificación por ID.
    function seekNotificationByID() {
        $feedback = $this->notification_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'NTFID_NOT_EXST';
            } else {
                $feedback['code'] = 'NTFID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'NTF_SEEK_KO';
        }

        return $feedback;
    }
}