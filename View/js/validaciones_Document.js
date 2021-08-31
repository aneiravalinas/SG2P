
function check_NOMBRE_DOC() {
    if(not_empty('nombre_doc')) {
        return check_name_file('nombre_doc');
    } else {
        return true;
    }
}