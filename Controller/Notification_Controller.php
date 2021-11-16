<?php

include_once 'Abstract_Controller.php';

class Notification extends Abstract_Controller {

    function __construct() {
        include './View/Page/Message_View.php';
        include './Service/Notification_Service.php';
    }

    function show() {
        $notification_service = new Notification_Service();
        $feedback = $notification_service->search();
        if($feedback['ok']) {
            $this->update_stack_post();
            include_once './View/Notifications/Show_Notifications_View.php';
            new Show_Notifications($feedback['resource'], $feedback['user']);
        } else {
            new Message($feedback['code']);
        }
    }

    function searchForm() {
        $notification_service = new Notification_Service();
        $feedback = $notification_service->searchForm();
        if($feedback['ok']) {
            include_once './View/Notifications/Search_Notification_View.php';
            new Search_Notification($feedback['resource'], $feedback['buildings'], $feedback['user']);
        } else {
            new Message($feedback['code']);
        }
    }

    function showCurrent() {
        $notification_service = new Notification_Service();
        $feedback = $notification_service->seek();
        if($feedback['ok']) {
            $this->update_stack_post();
            include_once './View/Notifications/ShowCurrent_Notification_View.php';
            new ShowCurrent_Notification($feedback['resource']);
        } else {
            new Message($feedback['code']);
        }
    }

    function deleteForm() {
        $notification_service = new Notification_Service();
        $feedback = $notification_service->seekNotification();
        if($feedback['ok']) {
            include_once './View/Notifications/Delete_Notification_View.php';
            new Delete_Notification($feedback['resource']);
        } else {
            new Message($feedback['code']);
        }
    }

    function delete() {
        $notification_service = new Notification_Service();
        $feedback = $notification_service->delete();
        new Message($feedback['code']);
    }
}